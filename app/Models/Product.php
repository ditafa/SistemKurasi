<?php

// Model Product.php
// Model Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'category_id', 'name', 'description', 'price', 'type', 'status'];

    // Relasi dengan User (Pedagang)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi dengan Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Relasi dengan ProductVariation
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    // Relasi dengan ProductPhoto
    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    // Relasi dengan ProductStatusHistory
    public function statusHistories()
    {
        return $this->hasMany(ProductStatusHistory::class);
    }

    public function latestHistory()
{
    return $this->hasOne(ProductStatusHistory::class, 'product_id')->latest();
    return $this->hasOne(ProductStatusHistory::class)->latestOfMany();
}




    // Accessor untuk format status tampilan
    public function getFormattedStatusAttribute()
    {
        $statusMapping = [
            'diajukan' => 'Diajukan',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            'revisi' => 'Diterima dengan Revisi',
        ];

        return $statusMapping[$this->status] ?? $this->status;
    }

    // Accessor untuk mendapatkan kategori utama
    public function getRootCategoryAttribute()
    {
        $category = $this->category;

        while ($category && $category->parent) {
            $category = $category->parent;
        }

        return $category ?: $this->category; // Jika tidak ada parent, kembalikan kategori saat ini
    }
}
