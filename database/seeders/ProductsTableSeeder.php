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

        DB::table('products')->insert([
            [
                'user_id' => 2,
                'category_id' => 3,
                'name' => 'Kemeja Pria Premium',
                'description' => 'Kemeja pria lengan panjang berbahan katun premium',
                'price' => 299000.00,
                'type' => 'variation',
                'status' => 'diajukan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 2,
                'category_id' => 3,
                'name' => 'Kemeja Wanita Elegant',
                'description' => 'Kemeja wanita modern dengan desain elegant',
                'price' => 275000.00,
                'type' => 'variation',
                'status' => 'diterima',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'category_id' => 4,
                'name' => 'Kaos Jogja Heritage',
                'description' => 'Kaos dengan desain khas Jogja',
                'price' => 125000.00,
                'type' => 'variation',
                'status' => 'revisi',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'user_id' => 3,
                'category_id' => 5,
                'name' => 'Sepatu Jogja Handmade',
                'description' => 'Sepatu lokal produksi Jogja dengan kualitas premium',
                'price' => 450000.00,
                'type' => 'variation',
                'status' => 'ditolak',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}