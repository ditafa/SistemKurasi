<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pemilik',
        'nama_usaha',
        'email',
        'telepon',
        'alamat',
        'nama_produk',
        'kategori',
        'deskripsi',
        'harga',
        'foto',
    ];

    protected $casts = [
        'foto' => 'array',
    ];
}
