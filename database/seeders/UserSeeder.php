<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Insert user admin
        User::create([
            'name' => 'Admin Satu',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Insert user pedagang
        User::create([
            'name' => 'Pedagang Satu',
            'email' => 'pedagang1@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pedagang',
        ]);
    }
}
