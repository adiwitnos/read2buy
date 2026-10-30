[CmdletBinding()]
param(
    [Alias('m')]
    [string]$Message,
    [string]$Branch = 'main',
    [switch]$VPSOnly,
    [switch]$DryRun,
    [switch]$Migrate,
    [switch]$Seed
)

$ErrorActionPreference = 'Stop'
$rootDir = Split-Path -Parent $MyInvocation.MyCommand.Path
$deployDir = Join-Path $rootDir '.deploy'
$keyPath = Join-Path $deployDir 'id_ed25519'
$sshConfig = Join-Path $deployDir 'ssh_config'
$vpsHost = 'read2buy-vps'
$remoteRoot = '/var/www/read2buy'
$healthUrl = 'https://read2buy.com/up'
$siteName = 'read2buy'

$systemGit = 'C:\Program Files\Git\cmd\git.exe'
if (Test-Path $systemGit) {
    $gitExe = $systemGit
} else {
    $foundGit = (Get-Command git -ErrorAction SilentlyContinue)
    if ($foundGit) { $gitExe = $foundGit.Source }
    else { $gitExe = 'H:\laragon\bin\git\cmd\git.exe' }
}
$phpDir = 'H:\laragon\bin\php\php-8.4.24-Win32-vs17-x64'
if (Test-Path $phpDir) { $env:PATH = "$phpDir;$env:PATH" }

if (-not (Test-Path $keyPath)) { throw "Kunci SSH khusus proyek tidak ditemukan di $keyPath." }

if (-not (Test-Path $deployDir)) { New-Item -ItemType Directory -Path $deployDir -Force | Out-Null }

if (-not (Test-Path $sshConfig)) {
    @"
Host $vpsHost
    HostName 43.173.12.136
    User ubuntu
    IdentityFile $keyPath
    IdentitiesOnly yes
    StrictHostKeyChecking accept-new
    BatchMode yes
    ConnectTimeout 15
    ServerAliveInterval 30
    ServerAliveCountMax 3
"@ | Set-Content $sshConfig -Encoding ASCII
}

$identityLine = Get-Content $sshConfig | Where-Object { $_ -match '^\s*IdentityFile\s+' } | Select-Object -First 1
$configuredIdentity = if ($identityLine -match '^\s*IdentityFile\s+(.+?)\s*$') { $Matches[1] } else { '' }
if (-not $configuredIdentity -or [System.IO.Path]::GetFullPath($configuredIdentity) -ne [System.IO.Path]::GetFullPath($keyPath)) {
    throw "Konfigurasi SSH harus menunjuk ke kunci khusus proyek: $keyPath. Periksa $sshConfig."
}
$sshExe = 'C:\Windows\System32\OpenSSH\ssh.exe'
$scpExe = 'C:\Windows\System32\OpenSSH\scp.exe'
if (-not (Test-Path $sshExe)) { $sshExe = (Get-Command ssh -ErrorAction Stop).Source }
if (-not (Test-Path $scpExe)) { $scpExe = (Get-Command scp -ErrorAction Stop).Source }

Write-Output "$siteName deployment: $rootDir -> ${vpsHost}:$remoteRoot"
Write-Output "Branch: $Branch | Mode: $(if ($DryRun) { 'DRY RUN' } elseif ($VPSOnly) { 'VPS ONLY' } else { 'COMMIT/PUSH + VPS' })"

if ($DryRun) {
    Write-Output '[DRY RUN] Perintah yang akan dijalankan:'
    if (-not $VPSOnly -and $Message) { Write-Output "  commit hanya perubahan yang sudah di-stage, lalu push ke origin/$Branch" }
    Write-Output '  validasi file sumber dan build aset Vite lokal sebelum commit/push'
    Write-Output '  tolak branch yang tidak cocok, perubahan unstaged/untracked, dan working tree kotor pada -VPSOnly'
    Write-Output '  fetch origin dan pastikan HEAD sama dengan origin/<branch> sebelum membuat arsip'
    Write-Output '  buat arsip aplikasi tanpa .git/.deploy/vendor/node_modules/.env'
    Write-Output "  upload arsip ke $remoteRoot melalui SSH sebagai release baru"
    Write-Output '  composer install, validasi, atomic symlink switch, rollback otomatis, health check'
    exit 0
}

Push-Location $rootDir
try {
    $currentBranch = (& $gitExe rev-parse --abbrev-ref HEAD).Trim()
    if ($LASTEXITCODE -ne 0) { throw 'Gagal membaca branch Git saat ini.' }
    if ($currentBranch -ne $Branch) { throw "Deploy dibatalkan: branch aktif '$currentBranch' berbeda dari target '$Branch'." }
    $status = @(& $gitExe status --porcelain)
    if ($LASTEXITCODE -ne 0) { throw 'Gagal membaca status Git.' }
    if ($VPSOnly -and $status.Count -gt 0) { throw 'Deploy dibatalkan: -VPSOnly mensyaratkan working tree bersih.' }
    if ((-not $Message -or $VPSOnly) -and $status.Count -gt 0) { throw 'Deploy dibatalkan: working tree harus bersih sebelum build.' }
    if (-not $VPSOnly -and $Message) {
        $initialNotStaged = @($status | Where-Object { $_.StartsWith('??') -or $_.Substring(1, 1) -ne ' ' })
        if ($initialNotStaged.Count -gt 0) { throw 'Deploy dibatalkan: stage hanya perubahan yang memang ingin dirilis; ada perubahan unstaged atau file untracked.' }
    }

    Write-Output 'Membangun aset frontend Read2Buy (Vite)...'
    & npm.cmd run build
    if ($LASTEXITCODE -ne 0) { throw 'Build frontend gagal; commit, push, dan deploy dibatalkan.' }
    $status = @(& $gitExe status --porcelain)
    if ($LASTEXITCODE -ne 0) { throw 'Gagal memeriksa working tree setelah build.' }

    if (-not $VPSOnly -and $Message) {
        & $gitExe fetch origin ('refs/heads/{0}:refs/remotes/origin/{0}' -f $Branch)
        if ($LASTEXITCODE -ne 0) { throw 'git fetch gagal; commit/push dibatalkan.' }
        $baseCommit = (& $gitExe rev-parse HEAD).Trim()
        $baseRemoteCommit = (& $gitExe rev-parse "origin/$Branch").Trim()
        if ($LASTEXITCODE -ne 0 -or $baseCommit -ne $baseRemoteCommit) { throw "Commit/push dibatalkan: sinkronkan HEAD dengan origin/$Branch terlebih dahulu." }
        $notStagedOnly = @($status | Where-Object { $_.StartsWith('??') -or $_.Substring(1, 1) -ne ' ' })
        if ($notStagedOnly.Count -gt 0) { throw 'Deploy dibatalkan: stage hanya file yang memang ingin dirilis; ada perubahan unstaged atau file untracked.' }
        $staged = @(& $gitExe diff --cached --name-only)
        if ($LASTEXITCODE -ne 0) { throw 'Gagal memeriksa perubahan staged.' }
        if ($staged.Count -gt 0) {
            & $gitExe commit -m $Message
            if ($LASTEXITCODE -ne 0) { throw 'git commit gagal.' }
        } else { Write-Output 'Tidak ada perubahan staged untuk di-commit.' }
        Write-Output "Mendorong commit ke GitHub ($Branch)..."
        & $gitExe push origin $Branch
        if ($LASTEXITCODE -ne 0) { throw 'git push gagal.' }
    } elseif ($status.Count -gt 0) { throw 'Deploy dibatalkan: working tree harus bersih. Stage dan commit perubahan terlebih dahulu.' }

    & $gitExe fetch origin ('refs/heads/{0}:refs/remotes/origin/{0}' -f $Branch)
    if ($LASTEXITCODE -ne 0) { throw 'git fetch gagal; deploy dibatalkan.' }
    $localCommit = (& $gitExe rev-parse HEAD).Trim()
    $remoteCommit = (& $gitExe rev-parse "origin/$Branch").Trim()
    if ($LASTEXITCODE -ne 0 -or $localCommit -ne $remoteCommit) { throw "Deploy dibatalkan: HEAD lokal tidak sama dengan origin/$Branch." }

    $preArchiveStatus = @(& $gitExe status --porcelain)
    if ($LASTEXITCODE -ne 0) { throw 'Gagal memeriksa working tree sebelum arsip.' }
    if ($preArchiveStatus.Count -gt 0) { throw 'Deploy dibatalkan: perubahan lokal terdeteksi setelah preflight/build. Tinjau dan commit secara eksplisit.' }
    $preArchiveCommit = (& $gitExe rev-parse HEAD).Trim()
    if ($LASTEXITCODE -ne 0 -or $preArchiveCommit -ne $localCommit) { throw 'Deploy dibatalkan: HEAD berubah selama preflight/build.' }
    $archive = Join-Path ([System.IO.Path]::GetTempPath()) ("$siteName-deploy-{0}.tar.gz" -f [guid]::NewGuid().ToString('N'))
    try {
        Write-Output 'Membuat arsip deployment...'
        & tar.exe --exclude=.git --exclude=.deploy --exclude=.agents --exclude=.claude --exclude=vendor --exclude=node_modules --exclude=.env --exclude='database/*.sqlite*' --exclude='database/*.db' -czf $archive -C $rootDir .
        if ($LASTEXITCODE -ne 0) { throw 'Pembuatan arsip gagal.' }
        Write-Output "Mengunggah arsip ke VPS ($vpsHost)..."
        & $scpExe -F $sshConfig $archive "${vpsHost}:/tmp/$siteName-deploy.tar.gz"
        if ($LASTEXITCODE -ne 0) { throw 'Upload arsip gagal.' }

        $migrateFlag = if ($Migrate) { '--migrate' } else { '' }
        $seedFlag = if ($Seed) { '--seed' } else { '' }
        $remoteScript = @"
set -euo pipefail
sudo /usr/local/sbin/sumopod-deploy-release '$siteName' '/tmp/$siteName-deploy.tar.gz' '$healthUrl' $migrateFlag $seedFlag
"@
        $encoded = [Convert]::ToBase64String([Text.Encoding]::UTF8.GetBytes($remoteScript.Replace("`r`n", "`n")))
        Write-Output 'Menjalankan deployment dan health check di remote VPS...'
        & $sshExe -F $sshConfig $vpsHost "echo $encoded | base64 -d | bash"
        if ($LASTEXITCODE -ne 0) { throw "Deployment VPS gagal dengan exit code $LASTEXITCODE." }
        Write-Output "Deployment $siteName selesai dan health check berhasil."
    } finally { if (Test-Path $archive) { Remove-Item $archive -Force } }
} finally { Pop-Location }
