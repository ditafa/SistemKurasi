<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    public function run()
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');

        DB::table('products')->truncate();

        // Ambil ID kategori berdasarkan nama untuk memastikan konsistensi
        $kemejaId = DB::table('categories')->where('name', 'Kemeja')->value('id');
        $kaosId = DB::table('categories')->where('name', 'Kaos')->value('id');
        $sepatuId = DB::table('categories')->where('name', 'Sepatu')->value('id');
        $maduId = DB::table('categories')->where('name', 'Madu')->value('id');

        DB::table('products')->insert([
            [
                'pedagang_id' => 2, // Ganti user_id jadi pedagang_id
                'category_id' => $kemejaId,
                'name' => 'Kemeja Pria Premium',
                'description' => 'Kemeja pria polos premium, terbuat dari bahan katun berkualitas tinggi 
                                    yang lembut dan nyaman digunakan. Tersedia dalam berbagai ukuran 
                                    dengan desain elegan yang cocok untuk acara formal maupun santai. 
                                    Mudah dirawat, tidak mudah kusut, dan rapi sepanjang hari.',
                'price' => 200000.00,
                'type' => 'variation',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now(),
            ],
            [
                'pedagang_id' => 2,
                'category_id' => $kemejaId,
                'name' => 'Kemeja Wanita Elegant',
                'description' => 'Kemeja wanita polos premium, menggunakan bahan katun berkualitas 
                                    tinggi yang nyaman dipakai. Tersedia dalam berbagai ukuran. 
                                    Cocok untuk acara formal maupun casual.
                                    Perawatan mudah dan tidak mudah kusut.',
                'price' => 150000.00,
                'type' => 'variation',
                'created_at' => Carbon::now()->subDays(4)->setTime(9, 30, 0),
                'updated_at' => Carbon::now(),
            ],
            [
                'pedagang_id' => 3,
                'category_id' => $kaosId,
                'name' => 'Kaos Jogja Heritage',
                'description' => 'Kaos dengan desain khas Jogja',
                'price' => 50000.00,
                'type' => 'variation',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now(),
            ],
            [
                'pedagang_id' => 3,
                'category_id' => $sepatuId,
                'name' => 'Sepatu Jogja Handmade',
                'description' => 'Sepatu lokal produksi Jogja dengan kualitas premium',
                'price' => 400000.00,
                'type' => 'variation',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now(),
            ],
            [
                'pedagang_id' => 3,
                'category_id' => $maduId,
                'name' => 'Madu Asli Lokal',
                'description' => 'Madu Lokal Asli Diambil Dari Pedalaman Hutan Yogyakarta Bantul',
                'price' => 150000.00,
                'type' => 'single',
                'created_at' => Carbon::now()->subDays(4),
                'updated_at' => Carbon::now(),
            ],
        ]);
    }
}
