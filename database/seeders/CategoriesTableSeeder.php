<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Hapus semua data dan reset ID agar tidak bentrok
        DB::statement('TRUNCATE TABLE categories RESTART IDENTITY CASCADE');

        // Menambahkan kategori utama
        DB::table('categories')->insert([
            ['name' => 'Elektronik', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pakaian', 'parent_id' => null, 'created_at' => now(), 'updated_at' => now()],
        ]);

        // Menambahkan subkategori
        DB::table('categories')->insert([
            ['name' => 'Smartphone', 'parent_id' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Kemeja', 'parent_id' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Jaket', 'parent_id' => 2, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
