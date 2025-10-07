<?php

namespace Database\Seeders;

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
        // Create admin user with specific credentials
        User::create([
            'name' => 'PT MSA Alkes Lab Admin',
            'email' => 'admin@msapt.co.id',
            'password' => Hash::make('ptmsa112233'),
            'email_verified_at' => now(),
        ]);
    }
}
