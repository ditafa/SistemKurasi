<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    public function run()
    {
        // Menambahkan kategori tanpa parent (kategori utama)
        DB::table('categories')->insert([
            'name' => 'Elektronik',
            'parent_id' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Menambahkan kategori dengan parent
        DB::table('categories')->insert([
            'name' => 'Smartphone',
            'parent_id' => 1, // ID kategori Elektronik
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}

