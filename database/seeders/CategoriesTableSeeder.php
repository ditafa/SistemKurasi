<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        Carbon::setLocale('id');
        date_default_timezone_set('Asia/Jakarta');
        
        DB::table('categories')->truncate();

        // Parent Categories
        DB::table('categories')->insert([
            [
                'name' => 'Pakaian',
                'parent_id' => null,
                'created_at' => Carbon::now()->setTime(8, 30, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 30, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sepatu',
                'parent_id' => null,
                'created_at' => Carbon::now()->setTime(8, 35, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 35, 0)->format('Y-m-d H:i:s'),
            ],
            /*
            [
                'name' => 'Makanan',
                'parent_id' => null,
                'created_at' => Carbon::now()->setTime(8, 35, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 35, 0)->format('Y-m-d H:i:s'),
            ],*/
        ]);

        // Child Categories
        DB::table('categories')->insert([
            [
                'name' => 'Kemeja',
                'parent_id' => 1,
                'created_at' => Carbon::now()->setTime(8, 40, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 40, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Kaos',
                'parent_id' => 1,
                'created_at' => Carbon::now()->setTime(8, 45, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 45, 0)->format('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Sepatu',
                'parent_id' => 2,
                'created_at' => Carbon::now()->setTime(8, 50, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 50, 0)->format('Y-m-d H:i:s'),
            ],
            /*
            [
                'name' => 'Madu',
                'parent_id' => 3,
                'created_at' => Carbon::now()->setTime(8, 50, 0)->format('Y-m-d H:i:s'),
                'updated_at' => Carbon::now()->setTime(8, 50, 0)->format('Y-m-d H:i:s'),
            ],*/
        ]);
    }
}