<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductVariationsTableSeeder extends Seeder
{
    public function run()
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        DB::table('product_variations')->truncate();

        DB::table('product_variations')->insert([
            // Kemeja Pria Premium (id: 1-4)
            [
                'id' => 1,
                'product_id' => 1,
                'name' => 'Size M',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 2,
                'product_id' => 1,
                'name' => 'Size L',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 3,
                'product_id' => 1,
                'name' => 'Size M',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 4,
                'product_id' => 1,
                'name' => 'Size L',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            // Kemeja Wanita Elegant (id: 5-6)
            [
                'id' => 5,
                'product_id' => 2,
                'name' => 'Size L',
                'price' => 205000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 6,
                'product_id' => 2,
                'name' => 'Size M',
                'price' => 275000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            // Kaos Jogja Heritage (id: 7-8)
            [
                'id' => 7,
                'product_id' => 3,
                'name' => 'Hitam - Motif 1',
                'price' => 150000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 8,
                'product_id' => 3,
                'name' => 'Putih - Motif 2',
                'price' => 150000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            // Sepatu Jogja Handmade (id: 9-11)
            [
                'id' => 9,
                'product_id' => 4,
                'name' => 'Merah',
                'price' => 450000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 10,
                'product_id' => 4,
                'name' => 'Biru',
                'price' => 450000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 11,
                'product_id' => 4,
                'name' => 'Hitam',
                'price' => 450000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            // Makanan Madu
            /*
            [
                'id' => 12,
                'product_id' => 5,
                'name' => 'Madu Hutan',
                'price' => 150000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'id' => 13,
                'product_id' => 5,
                'name' => 'Madu Lokal',
                'price' => 150000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],*/
        ]);
    }
}