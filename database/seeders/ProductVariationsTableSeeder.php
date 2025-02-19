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
            [
                'product_id' => 1,
                'name' => 'Putih - Size M',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'product_id' => 1,
                'name' => 'Putih - Size L',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'product_id' => 1,
                'name' => 'Biru - Size M',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ],
            [
                'product_id' => 1,
                'name' => 'Biru - Size L',
                'price' => 299000.00,
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),

            ],
        ]);
    }
}