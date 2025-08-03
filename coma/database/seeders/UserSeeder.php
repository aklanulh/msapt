<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Admin User
        User::create([
            'name' => 'Admin COMA',
            'email' => 'admin@coma.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Test User 1
        User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Test User 2
        User::create([
            'name' => 'Siti Nurhaliza',
            'email' => 'siti@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Test User 3
        User::create([
            'name' => 'Ahmad Wijaya',
            'email' => 'ahmad@test.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
        ]);

        // Demo User
        User::create([
            'name' => 'Demo User',
            'email' => 'demo@coma.com',
            'email_verified_at' => now(),
            'password' => Hash::make('demo123'),
        ]);
    }
}
