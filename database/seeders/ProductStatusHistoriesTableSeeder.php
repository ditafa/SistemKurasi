<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductStatusHistoriesTableSeeder extends Seeder
{
    public function run()
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        DB::table('product_status_histories')->truncate();

        DB::table('product_status_histories')->insert([
            // Riwayat untuk Kemeja Pria Premium
            
            
            // Riwayat untuk Kemeja Wanita Elegant
           
            [
                'product_id' => 2,
                'admin_id' => 1, // ID admin yang memverifikasi
                'status' => 'diterima',
                'notes' => 'Produk telah diverifikasi dan memenuhi standar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            
            // Riwayat untuk Kaos Jogja Heritage
           
            [
                'product_id' => 3,
                'admin_id' => 1, // ID admin yang meminta revisi
                'status' => 'diterima dengan revisi',
                'notes' => 'Mohon tambahkan detail ukuran yang tersedia dan foto yang lebih jelas',
                'created_at' => Carbon::now()->subDays(3)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            [
                'product_id' => 3,
                'admin_id' => 1, // ID admin yang meminta revisi
                'status' => 'diterima',
                'notes' => 'Produk telah diverifikasi dan memenuhi standar',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],
            
            // Riwayat untuk Sepatu Jogja Handmade
            
            [
                'product_id' => 4,
                'admin_id' => 1, // ID admin yang menolak
                'status' => 'ditolak',
                'notes' => 'Produk tidak memenuhi standar kualitas yang ditetapkan',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],

            // Riwayat Madu
            /*

            [
                'product_id' => 5,
                'admin_id' => 1, // ID admin yang menolak
                'status' => 'diterima dengan revisi',
                'notes' => 'Foto produk madu mengambil foto produk kompetitor',
                'created_at' => Carbon::now()->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->format('Y-m-d H:i:s'),
            ],*/
        ]);
    }
}