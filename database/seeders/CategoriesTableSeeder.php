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
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $pakaianId = DB::table('categories')->insertGetId([
            'name' => 'Pakaian',
            'parent_id' => null,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert Child Categories (Anak)
        $atasanId = DB::table('categories')->insertGetId([
            'name' => 'Atasan',
            'parent_id' => $pakaianId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $bawahanId = DB::table('categories')->insertGetId([
            'name' => 'Bawahan',
            'parent_id' => $pakaianId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert Grandchild Categories (Cucu)
        $kemejaId = DB::table('categories')->insertGetId([
            'name' => 'Kemeja',
            'parent_id' => $atasanId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $kaosId = DB::table('categories')->insertGetId([
            'name' => 'Kaos',
            'parent_id' => $atasanId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $celanaId = DB::table('categories')->insertGetId([
            'name' => 'Celana',
            'parent_id' => $bawahanId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        $sepatuId = DB::table('categories')->insertGetId([
            'name' => 'Sepatu',
            'parent_id' => $bawahanId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // Insert Madu (Tidak Ada Subkategori)
        $maduId = DB::table('categories')->insertGetId([
            'name' => 'Madu',
            'parent_id' => $makananId,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
