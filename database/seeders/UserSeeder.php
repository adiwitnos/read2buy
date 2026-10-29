<?php

namespace Database\Seeders;

use App\Enums\UserRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Administrator Account
        User::updateOrCreate(
            ['email' => 'adiwitnosaroso@gmail.com'],
            [
                'name' => 'Adiwitno Saroso',
                'role' => UserRole::Administrator,
                'password' => Hash::make(env('ADMIN_INITIAL_PASSWORD', '*Werkudoro102*')),
                'email_verified_at' => now(),
            ]
        );

        // 2. Member Account
        User::updateOrCreate(
            ['email' => 'percetakanwisuda.com@gmail.com'],
            [
                'name' => 'Member Read2Buy',
                'role' => UserRole::Member,
                'password' => Hash::make('*Werkudoro102*'),
                'email_verified_at' => now(),
            ]
        );
    }
}
