<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // Membuat admin
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Membuat pedagang
        DB::table('users')->insert([
            'name' => 'Pedagang',
            'email' => 'pedagang@example.com',
            'password' => Hash::make('password123'),
            'role' => 'pedagang',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
