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
           [
               'product_id' => 1,
               'variation_id' => 1,
               'url' => '',
               'created_at' => Carbon::now()->subDays(3)->setTime(13, 20, 0)->format('Y-m-d H:i:s'),
           ],
       ]);
   }
}