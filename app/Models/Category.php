<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // Kolom yang dapat diisi (fillable)
    protected $fillable = ['name', 'parent_id'];

    // Relasi ke kategori induk (self-referencing)
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    // Relasi ke kategori anak
    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }
}
