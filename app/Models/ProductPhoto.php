<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    use HasFactory;

    // Nama tabel jika tidak sesuai default (optional)
    protected $table = 'product_photos';

    // Kolom yang bisa diisi mass assignment
    protected $fillable = [
        'product_id',
        'variation_id',
        'url',
        'photo_data', // kolom untuk menyimpan file biner
    ];

    // Jika ingin agar photo_data otomatis di-cast ke string (binary)
    protected $casts = [
        'photo_data' => 'binary',
    ];

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // Relasi ke variasi produk (boleh null)
    public function variation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
