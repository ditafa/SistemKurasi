<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data sebelum menambahkan yang baru
        DB::table('products')->truncate();

        DB::table('products')->insert([
            [
                'user_id' => 2,
                'category_id' => 3, // Subkategori "Smartphone" (parent: Elektronik)
                'name' => 'Smartphone XYZ',
                'description' => 'Smartphone dengan spesifikasi tinggi',
                'price' => 5000000.00,
                'type' => 'single',
                'status' => 'diajukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'category_id' => 5, // Subkategori "Jaket" (parent: Pakaian)
                'name' => 'Jaket Musim Dingin',
                'description' => 'Jaket tebal untuk cuaca dingin',
                'price' => 800000.00,
                'type' => 'single',
                'status' => 'diterima',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'category_id' => 4, // Subkategori "Kemeja" (parent: Pakaian)
                'name' => 'Kemeja Formal',
                'description' => 'Kemeja lengan panjang untuk acara formal',
                'price' => 350000.00,
                'type' => 'single',
                'status' => 'diajukan',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
