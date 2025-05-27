<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            AdminsTableSeeder::class,
            PedagangsTableSeeder::class,
            UsersTableSeeder::class,
            CategoriesTableSeeder::class,
            ProductsTableSeeder::class,
            ProductVariationsTableSeeder::class,
            ProductPhotosTableSeeder::class,
            ProductStatusHistoriesTableSeeder::class,
        ]);
    }
}

