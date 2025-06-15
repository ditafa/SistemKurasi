<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Pedagang;
use App\Models\Category;
use App\Models\ProductPhoto;
use App\Models\ProductVariation;
use App\Models\ProductStatusHistory;
use App\Models\CurationTimeline;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'pedagang_id',
        'category_id',
        'name',
        'description',
        'price',
        'type',
        'status',
        'gambar',
        'color',
        'size',
    ];

        public function user()
    {
        return $this->belongsTo(User::class, 'pedagang_id');
    }

    public function variations()
    {
        return $this->hasMany(\App\Models\ProductVariation::class);
    }


    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function firstPhoto()
    {
        return $this->hasOne(ProductPhoto::class)->oldestOfMany();
    }

    public function statusHistories()
    {
        return $this->hasMany(ProductStatusHistory::class);
    }


    public function latestHistory()
    {
        return $this->hasOne(ProductStatusHistory::class, 'product_id')->latest();
    }

    public function setColorAttribute($value)
    {
        $this->attributes['color'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getColorAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function setSizeAttribute($value)
    {
        $this->attributes['size'] = is_array($value) ? json_encode($value) : $value;
    }

    public function getSizeAttribute($value)
    {
        return $value ? json_decode($value, true) : [];
    }

    public function getFormattedStatusAttribute()
    {
        $statusMapping = [
            'diajukan' => 'Diajukan',
            'diterima' => 'Diterima',
            'ditolak' => 'Ditolak',
            'revisi' => 'Diterima dengan Revisi',
        ];

        return $statusMapping[$this->status] ?? $this->status;
    }

    public function getRootCategoryAttribute()
    {
        $category = $this->category;

        while ($category && $category->parent) {
            $category = $category->parent;
        }

        return $category ?: $this->category;
    }

    public function curationTimelines()
{
    return $this->hasMany(\App\Models\CurationTimeline::class);
}


    public function latestCuration()
{
    return $this->hasOne(CurationTimeline::class, 'product_id')->latestOfMany();
}

}
