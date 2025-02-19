<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'name', 'price'];

    // Relasi dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi dengan ProductPhoto
    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}

