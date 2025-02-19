<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'email', 'password', 'role'];

    // Relasi dengan produk
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    // Relasi dengan status history
    public function productStatusHistories()
    {
        return $this->hasMany(ProductStatusHistory::class);
    }
}
