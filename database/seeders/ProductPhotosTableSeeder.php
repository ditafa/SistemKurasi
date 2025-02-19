<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductPhotosTableSeeder extends Seeder
{
   public function run()
   {
       Carbon::setLocale('id');
       date_default_timezone_set('Asia/Jakarta');
       
       DB::table('product_photos')->truncate();

       DB::table('product_photos')->insert([
           // Foto untuk Kemeja Pria Premium
           [
               'product_id' => 1,
               'variation_id' => 1, // Putih - Size M
               'url' => 'https://down-id.img.susercontent.com/file/690553ee99c888fdba1bab371ecc11f3',
               'created_at' => Carbon::now()->subDays(3)->setTime(13, 20, 0)->format('Y-m-d H:i:s'),
           ],
           [
               'product_id' => 1,
               'variation_id' => 2, // Putih - Size L
               'url' => 'https://down-id.img.susercontent.com/file/sg-11134201-7rbnk-lp83s09fjdxi61',
               'created_at' => Carbon::now()->subDays(3)->setTime(13, 21, 0)->format('Y-m-d H:i:s'),
           ],
           [
               'product_id' => 1,
               'variation_id' => 3, // Biru - Size M
               'url' => 'https://down-id.img.susercontent.com/file/688db4bd400774af2057ed12df56767d',
               'created_at' => Carbon::now()->subDays(3)->setTime(13, 22, 0)->format('Y-m-d H:i:s'),
           ],
           [
               'product_id' => 1,
               'variation_id' => 4, // Biru - Size L
               'url' => 'https://down-id.img.susercontent.com/file/id-11134207-7qul0-ljz8fiy6511b35',
               'created_at' => Carbon::now()->subDays(3)->setTime(13, 23, 0)->format('Y-m-d H:i:s'),
           ],

           // Foto untuk Kemeja Wanita Elegant
           [
               'product_id' => 2,
               'variation_id' => 5, // Merah Muda
               'url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98p-lusrprde1bn8ee',
               'created_at' => Carbon::now()->subDays(5)->setTime(14, 35, 0)->format('Y-m-d H:i:s'),
           ],
           [
               'product_id' => 2,
               'variation_id' => 6, // Putih
               'url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98u-lxt5h1e3rvd675',
               'created_at' => Carbon::now()->subDays(5)->setTime(14, 36, 0)->format('Y-m-d H:i:s'),
           ],

           // Foto untuk Kaos Jogja Heritage
           [
               'product_id' => 3,
               'variation_id' => 7, // Putih - Motif 1
               'url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r98u-lryyxvzremh5eb',
               'created_at' => Carbon::now()->subDays(2)->setTime(10, 5, 0)->format('Y-m-d H:i:s'),
           ],
           [
               'product_id' => 3,
               'variation_id' => 8, // Putih - Motif 2
               'url' => 'https://down-id.img.susercontent.com/file/id-11134207-7r990-lzjbcl140qvc8e',
               'created_at' => Carbon::now()->subDays(2)->setTime(10, 6, 0)->format('Y-m-d H:i:s'),
           ],

           // Foto untuk Sepatu Jogja Handmade
           [
               'product_id' => 4,
               'variation_id' => 9, // Coklat Muda
               'url' => 'https://down-id.img.susercontent.com/file/9f867b37aeae9ea237c17a59bf4cde1c',
               'created_at' => Carbon::now()->subDays(7)->setTime(11, 25, 0)->format('Y-m-d H:i:s'),
           ],
           [
               'product_id' => 4,
               'variation_id' => 10, // Coklat Tua
               'url' => 'https://down-id.img.susercontent.com/file/b8d75d8a363734aba9b7c13356fb88a2',
               'created_at' => Carbon::now()->subDays(7)->setTime(11, 26, 0)->format('Y-m-d H:i:s'),
           ],
           [
               'product_id' => 4,
               'variation_id' => 11, // Hitam
               'url' => 'https://down-id.img.susercontent.com/file/3f0d7c81cfdd12b5df97723542305ae7',
               'created_at' => Carbon::now()->subDays(7)->setTime(11, 27, 0)->format('Y-m-d H:i:s'),
           ],
       ]);
   }
}