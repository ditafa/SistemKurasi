<?php

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
    
}
