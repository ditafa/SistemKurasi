<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->truncate();

        DB::table('products')->insert([
            [
                'category_id' => 5,
                'name' => 'Kemeja Pria Premium',
                'description' => 'Kemeja pria polos premium, terbuat dari bahan katun berkualitas tinggi
                                    yang lembut dan nyaman digunakan. Tersedia dalam berbagai ukuran
                                    dengan desain elegan yang cocok untuk acara formal maupun santai.
                                    Mudah dirawat, tidak mudah kusut, dan rapi sepanjang hari.',
                'pedagang_id' => 2,
                'price' => 200000,
                'type' => 'variation',
                'created_at' => Carbon::create(2025, 5, 26, 21, 24, 11),
                'updated_at' => Carbon::create(2025, 5, 30, 21, 24, 11),
            ],
            [
                'category_id' => 5,
                'name' => 'Kemeja Wanita Elegant',
                'description' => 'Kemeja wanita polos premium, menggunakan bahan katun berkualitas
                                    tinggi yang nyaman dipakai. Tersedia dalam berbagai ukuran.
                                    Cocok untuk acara formal maupun casual.
                                    Perawatan mudah dan tidak mudah kusut.',
                'pedagang_id' => 2,
                'price' => 150000,
                'type' => 'variation',
                'created_at' => Carbon::create(2025, 5, 26, 9, 30, 0),
                'updated_at' => Carbon::create(2025, 5, 30, 21, 24, 11),
            ],
            [
                'category_id' => 6,
                'name' => 'Kaos Jogja Heritage',
                'description' => 'Kaos dengan desain khas Jogja',
                'pedagang_id' => 3,
                'price' => 50000,
                'type' => 'variation',
                'created_at' => Carbon::create(2025, 5, 26, 21, 24, 11),
                'updated_at' => Carbon::create(2025, 5, 30, 21, 24, 11),
            ],
            [
                'category_id' => 8,
                'name' => 'Sepatu Jogja Handmade',
                'description' => 'Sepatu lokal produksi Jogja dengan kualitas premium',
                'pedagang_id' => 3,
                'price' => 400000,
                'type' => 'variation',
                'created_at' => Carbon::create(2025, 5, 26, 21, 24, 11),
                'updated_at' => Carbon::create(2025, 5, 30, 21, 24, 11),
            ],
            [
                'category_id' => 9,
                'name' => 'Madu Asli Lokal',
                'description' => 'Madu Lokal Asli Diambil Dari Pedalaman Hutan Yogyakarta Bantul',
                'pedagang_id' => 3,
                'price' => 150000,
                'type' => 'single',
                'created_at' => Carbon::create(2025, 5, 26, 21, 24, 11),
                'updated_at' => Carbon::create(2025, 5, 30, 21, 24, 11),
            ],
        ]);
    }
}
