<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

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
        'is_featured',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'price' => 'decimal:2',
        'old_price' => 'decimal:2',
        'weight' => 'decimal:2',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order')->orderBy('id');
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

    public function getGalleryUrlsAttribute(): array
    {
        $urls = [$this->image_url];

        foreach ($this->images as $image) {
            $urls[] = $image->image_url;
        }

        return array_values(array_unique($urls));
    }
}