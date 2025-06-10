<?php

namespace App\Policies;

use App\Models\Pedagang;
use App\Models\Product;

class ProductPolicy
{
    public function view(Pedagang $pedagang, Product $product): bool
    {
        return $product->pedagang_id === $pedagang->id;
    }

    public function update(Pedagang $pedagang, Product $product)
    {
        return $pedagang->id === $product->pedagang_id;
    }

    public function delete(Pedagang $pedagang, Product $product)
    {
        return $pedagang->id === $product->pedagang_id;
    }


    public function create(Pedagang $pedagang): bool
    {
        return true; // Semua pedagang bisa membuat produk
    }
}
