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
        ]);
    }
}