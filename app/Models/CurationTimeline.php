<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurationTimeline extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id', // foreign key
        'status',     // status kurasi
        'description', // deskripsi status
        'created_at',  // waktu status
    ];

    // Relasi ke produk
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
