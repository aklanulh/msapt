<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Membuat admin
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan kata sandi yang kuat
            'role' => 'admin',
            'points' => 0,
        ]);

        // Membuat user
        User::create([
            'name' => 'Budi Budiman',
            'email' => 'budi@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan kata sandi yang kuat
            'role' => 'user',
            'points' => 100,
        ]);
        User::create([
            'name' => 'Ani Septiani',
            'email' => 'ani@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan kata sandi yang kuat
            'role' => 'user',
            'points' => 120,
        ]);
        User::create([
            'name' => 'Agus Sofian',
            'email' => 'agus@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan kata sandi yang kuat
            'role' => 'user',
            'points' => 80,
        ]);
        User::create([
            'name' => 'Aklanul Huda',
            'email' => 'aklanul@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan kata sandi yang kuat
            'role' => 'user',
            'points' => 150,
        ]);
        User::create([
            'name' => 'Guntur Pamungkas',
            'email' => 'guntur@gmail.com',
            'password' => Hash::make('password'), // Ganti dengan kata sandi yang kuat
            'role' => 'user',
            'points' => 70,
        ]);
    }
}
