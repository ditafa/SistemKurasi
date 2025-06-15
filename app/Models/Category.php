<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    // Untuk mendapatkan induk kategori
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }


    // Relasi kategori dengan produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function getFullCategoryPath()
{
    $categories = collect([$this->name]);
    $parent = $this->parent;

    while ($parent) {
        $categories->prepend($parent->name); // Tambahkan ke awal array
        $parent = $parent->parent;
    }

    return $categories->join(' > '); // Gabungkan dengan ">"
}

}

