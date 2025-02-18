<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 
        'price', 
        'status', 
        'category_id', 
        'variation_id', 
        'image_url',
        'description',
        'type'
    ];

    // Relasi ke kategori
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    // Relasi ke variasi
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class, 'variation_id');
    }

    // Relasi ke foto-foto produk
    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    // Relasi ke foto utama
    public function mainPhoto()
    {
        return $this->hasOne(ProductPhoto::class)->whereNull('variation_id');
    }

    // Relasi ke riwayat status
    public function statusHistories()
    {
        return $this->hasMany(ProductStatusHistory::class);
    }
}