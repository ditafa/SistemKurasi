<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    protected $table = 'product_photos';

    protected $fillable = ['product_id', 'variation_id', 'url', 'created_at'];

    // Relasi dengan Product (Produk utama)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi dengan ProductVariation (Variasi produk)
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
