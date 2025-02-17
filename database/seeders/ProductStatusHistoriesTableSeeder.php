<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductStatusHistoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan riwayat status produk
        DB::table('product_status_histories')->insert([
            'product_id' => 1, // ID produk Smartphone XYZ
            'admin_id' => 1, // ID admin
            'status' => 'diajukan',
            'notes' => 'Produk diajukan untuk review',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_status_histories')->insert([
            'product_id' => 1, // ID produk Smartphone XYZ
            'admin_id' => 1, // ID admin
            'status' => 'diterima',
            'notes' => 'Produk diterima untuk penjualan',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}


