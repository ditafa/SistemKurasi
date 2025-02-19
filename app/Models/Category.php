<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'parent_id'];

    // Relasi kategori dengan kategori induk (Self-referencing)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relasi kategori dengan produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

