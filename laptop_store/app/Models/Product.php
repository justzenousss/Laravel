<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'brand_id',
        'name',
        'slug',
        'price',
        'old_price',
        'quantity',
        'image',
        'cpu',
        'ram',
        'storage',
        'screen',
        'gpu',
        'os',
        'weight',
        'description',
        'is_featured'
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}