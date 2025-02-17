<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan produk
        DB::table('products')->insert([
            'user_id' => 2, // ID pedagang
            'category_id' => 1, // ID kategori Elektronik
            'name' => 'Smartphone XYZ',
            'description' => 'Smartphone dengan spesifikasi tinggi',
            'price' => 5000000.00,
            'type' => 'single',
            'status' => 'diajukan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
