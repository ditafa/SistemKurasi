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

        // Insert Parent Categories
        $makananId = DB::table('categories')->insertGetId([
            'name' => 'Makanan',
            'parent_id' => null,
            'created_at' => Carbon::now()->setTime(8, 35, 0),
            'updated_at' => Carbon::now()->setTime(8, 35, 0),
        ]);

        $pakaianId = DB::table('categories')->insertGetId([
            'name' => 'Pakaian',
            'parent_id' => null,
            'created_at' => Carbon::now()->setTime(8, 30, 0),
            'updated_at' => Carbon::now()->setTime(8, 30, 0),
        ]);

        $sepatuId = DB::table('categories')->insertGetId([
            'name' => 'Sepatu',
            'parent_id' => null,
            'created_at' => Carbon::now()->setTime(8, 35, 0),
            'updated_at' => Carbon::now()->setTime(8, 35, 0),
        ]);

        // Insert Child Categories
        $kemejaId = DB::table('categories')->insertGetId([
            'name' => 'Kemeja',
            'parent_id' => $pakaianId,
            'created_at' => Carbon::now()->setTime(8, 40, 0),
            'updated_at' => Carbon::now()->setTime(8, 40, 0),
        ]);

        $kaosId = DB::table('categories')->insertGetId([
            'name' => 'Kaos',
            'parent_id' => $pakaianId,
            'created_at' => Carbon::now()->setTime(8, 45, 0),
            'updated_at' => Carbon::now()->setTime(8, 45, 0),
        ]);

        $maduId = DB::table('categories')->insertGetId([
            'name' => 'Madu',
            'parent_id' => $makananId,
            'created_at' => Carbon::now()->setTime(8, 50, 0),
            'updated_at' => Carbon::now()->setTime(8, 50, 0),
        ]);
    }
}
