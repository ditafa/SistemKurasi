<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        DB::table('users')->truncate();
        
        DB::table('users')->insert([
            [
                'name' => 'AdminUtama',
                'email' => 'admin@example.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'created_at' => Carbon::now()->setTime(8, 0, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 0, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'PedagangSatu',
                'email' => 'pedagang1@example.com',
                'password' => Hash::make('password123'),
                'role' => 'pedagang',
                'created_at' => Carbon::now()->setTime(9, 30, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(9, 30, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'PedagangDua',
                'email' => 'pedagang2@example.com',
                'password' => Hash::make('password123'),
                'role' => 'pedagang',
                'created_at' => Carbon::now()->setTime(10, 15, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(10, 15, 0)->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}