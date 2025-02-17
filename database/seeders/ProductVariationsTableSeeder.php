<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductVariationsTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan variasi produk
        DB::table('product_variations')->insert([
            'product_id' => 1, // ID produk Smartphone XYZ
            'name' => 'Warna Merah',
            'price' => 5100000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('product_variations')->insert([
            'product_id' => 1, // ID produk Smartphone XYZ
            'name' => 'Warna Biru',
            'price' => 5100000.00,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
