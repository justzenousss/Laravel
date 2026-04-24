<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    protected $fillable = [
        'product_id',
        'image',
        'sort_order',
    ];

    protected $casts = [
        'sort_order' => 'integer',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getImageUrlAttribute(): string
    {
        if (!empty($this->image)) {
            if (Storage::disk('public')->exists($this->image)) {
                return asset('storage/' . $this->image);
            }

            if (file_exists(public_path('images/' . $this->image))) {
                return asset('images/' . $this->image);
            }

            if (file_exists(public_path($this->image))) {
                return asset($this->image);
            }
        }

        return asset('images/product-placeholder.svg');
    }
}