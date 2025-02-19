<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'variation_id', 'url'];

    // Relasi dengan Product
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi dengan ProductVariation
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
