<?php

namespace App\Services;

use Closure;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Turnstile
{
    public const SITEVERIFY_URL = 'https://challenges.cloudflare.com/turnstile/v0/siteverify';

    /**
     * Verify a Turnstile response token with Cloudflare's siteverify API.
     *
     * @param string|null $token
     * @param string|null $expectedAction
     * @param string|null $remoteIp
     * @return bool
     */
    public static function verify(?string $token, ?string $expectedAction = null, ?string $remoteIp = null): bool
    {
        if (! is_string($token) || trim($token) === '' || strlen($token) > 2048) {
            return false;
        }

        $secret = config('services.turnstile.secret');
        if (empty($secret)) {
            Log::error('Turnstile secret key is not configured.');
            return false;
        }

        try {
            $payload = [
                'secret' => $secret,
                'response' => $token,
            ];

            if (! empty($remoteIp)) {
                $payload['remoteip'] = $remoteIp;
            }

            $response = Http::asForm()
                ->timeout(10)
                ->post(self::SITEVERIFY_URL, $payload);

            if (! $response->successful()) {
                Log::warning('Turnstile siteverify HTTP failure', [
                    'status' => $response->status(),
                ]);
                return false;
            }

            $data = $response->json();

            if (! is_array($data) || ($data['success'] ?? false) !== true) {
                Log::info('Turnstile verification unsuccessful', [
                    'error-codes' => $data['error-codes'] ?? [],
                ]);
                return false;
            }

            if ($expectedAction !== null && ($data['action'] ?? null) !== $expectedAction) {
                Log::warning('Turnstile action mismatch', [
                    'expected' => $expectedAction,
                    'received' => $data['action'] ?? null,
                ]);
                return false;
            }

            $rawHostnames = (string) config('services.turnstile.hostnames', '');
            $allowedHostnames = array_filter(array_map('trim', explode(',', $rawHostnames)));

            if (! empty($allowedHostnames) && ! in_array($data['hostname'] ?? '', $allowedHostnames, true)) {
                Log::warning('Turnstile hostname not in allowed list', [
                    'allowed' => $allowedHostnames,
                    'received' => $data['hostname'] ?? null,
                ]);
                return false;
            }

            return true;
        } catch (\Throwable $e) {
            Log::error('Turnstile verification exception', [
                'message' => $e->getMessage(),
            ]);
            return false;
        }
    }

    /**
     * Fake Cloudflare siteverify endpoint responses for testing.
     *
     * @param bool $success
     * @param string|null $action
     * @param string|null $hostname
     */
    public static function fake(bool $success = true, ?string $action = null, ?string $hostname = 'localhost'): void
    {
        Http::fake([
            self::SITEVERIFY_URL => Http::response([
                'success' => $success,
                'action' => $action,
                'hostname' => $hostname,
                'error-codes' => $success ? [] : ['invalid-input-response'],
            ], 200),
        ]);
    }
}
