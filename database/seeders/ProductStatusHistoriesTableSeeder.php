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
            [
                'product_id' => 1,
                'admin_id' => 2, // ID pedagang yang mengajukan
                'status' => 'diajukan',
                'notes' => 'Pengajuan produk baru oleh pedagang',
                'created_at' => Carbon::now()->subDays(3)->setTime(13, 0, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(3)->setTime(13, 0, 0)->format('Y-m-d H:i:s'),
            ],
            
            // Riwayat untuk Kemeja Wanita Elegant
            [
                'product_id' => 2,
                'admin_id' => 2, // ID pedagang yang mengajukan
                'status' => 'diajukan',
                'notes' => 'Pengajuan produk baru oleh pedagang',
                'created_at' => Carbon::now()->subDays(5)->setTime(14, 30, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(5)->setTime(14, 30, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'product_id' => 2,
                'admin_id' => 1, // ID admin yang memverifikasi
                'status' => 'diterima',
                'notes' => 'Produk telah diverifikasi dan memenuhi standar',
                'created_at' => Carbon::now()->subDays(4)->setTime(9, 15, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(4)->setTime(9, 15, 0)->format('Y-m-d H:i:s'),
            ],
            
            // Riwayat untuk Kaos Jogja Heritage
            [
                'product_id' => 3,
                'admin_id' => 3, // ID pedagang yang mengajukan
                'status' => 'diajukan',
                'notes' => 'Pengajuan produk baru oleh pedagang',
                'created_at' => Carbon::now()->subDays(2)->setTime(10, 0, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(2)->setTime(10, 0, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'product_id' => 3,
                'admin_id' => 1, // ID admin yang meminta revisi
                'status' => 'revisi',
                'notes' => 'Mohon tambahkan detail ukuran yang tersedia dan foto yang lebih jelas',
                'created_at' => Carbon::now()->subDays(1)->setTime(15, 45, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(1)->setTime(15, 45, 0)->format('Y-m-d H:i:s'),
            ],
            
            // Riwayat untuk Sepatu Jogja Handmade
            [
                'product_id' => 4,
                'admin_id' => 3, // ID pedagang yang mengajukan
                'status' => 'diajukan',
                'notes' => 'Pengajuan produk baru oleh pedagang',
                'created_at' => Carbon::now()->subDays(7)->setTime(11, 20, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(7)->setTime(11, 20, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'product_id' => 4,
                'admin_id' => 1, // ID admin yang menolak
                'status' => 'ditolak',
                'notes' => 'Produk tidak memenuhi standar kualitas yang ditetapkan',
                'created_at' => Carbon::now()->subDays(6)->setTime(16, 30, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->subDays(6)->setTime(16, 30, 0)->format('Y-m-d H:i:s'),
            ],
        ]);
    }
}