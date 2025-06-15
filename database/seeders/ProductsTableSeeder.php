<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use App\Models\Pedagang; // ← Tambahkan baris ini

class ProductsTableSeeder extends Seeder
{
    public function run(): void
    {
        $pedagang = Pedagang::first(); // pastikan ada minimal 1 pedagang di database
        $categories = Category::take(3)->get(); // ambil beberapa kategori

        foreach ($categories as $category) {
            Product::create([
                'pedagang_id' => $pedagang->id,
                'category_id' => $category->id,
                'name' => 'Produk ' . $category->name,
                'description' => 'Deskripsi produk untuk kategori ' . $category->name,
                'price' => rand(10000, 100000),
                'type' => ['single', 'variation'][rand(0, 1)],
                'status' => 'diajukan',
            ]);
        }
    }
}
