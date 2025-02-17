<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductPhotosTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan foto produk
        DB::table('product_photos')->insert([
            'product_id' => 1, // ID produk Smartphone XYZ
            'variation_id' => null, // Foto untuk produk utama
            'url' => 'https://kabarbaik.co/wp-content/uploads/2024/09/hp-samsung-2024.jpeg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Menambahkan foto variasi produk
        DB::table('product_photos')->insert([
            'product_id' => 1, // ID produk Smartphone XYZ
            'variation_id' => 1, // Foto untuk variasi Warna Merah
            'url' => 'https://www.static-src.com/wcsstore/Indraprastha/images/catalog/full/catalog-image/90/MTA-161011187/samsung_samsung_galaxy_a05s_smartphone_-6-128gb-n-_-_travel_adaptor_25w_full12_ihbyunmy.jpg',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

