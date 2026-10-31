<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPassword = env('ADMIN_INITIAL_PASSWORD');
        if (empty($adminPassword)) {
            $adminPassword = app()->environment('local') ? 'Password123!' : Str::random(32);
            $this->command?->info("Default Admin Password generated: {$adminPassword}");
        }

        // 1. Administrator Account
        User::updateOrCreate(
            ['email' => 'adiwitnosaroso@gmail.com'],
            [
                'name' => 'Adiwitno Saroso',
                'role' => UserRole::Administrator,
                'password' => Hash::make($adminPassword),
                'email_verified_at' => now(),
            ]
        );

        $memberPassword = env('MEMBER_INITIAL_PASSWORD');
        if (empty($memberPassword)) {
            $memberPassword = app()->environment('local') ? 'Password123!' : Str::random(32);
        }

        // 2. Member Account
        User::updateOrCreate(
            ['email' => 'percetakanwisuda.com@gmail.com'],
            [
                'name' => 'Member Read2Buy',
                'role' => UserRole::Member,
                'password' => Hash::make($memberPassword),
                'email_verified_at' => now(),
            ]
        );
    }
}
