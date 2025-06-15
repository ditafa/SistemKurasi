<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurationTimeline extends Model
{
    protected $fillable = ['product_id', 'status'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

