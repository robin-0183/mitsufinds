<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'brand',
        'slug',
        'image_url',
        'image_path',
        'price',
        'affiliate_url',
        'description',
        'is_active',
    ];

    /**
     * Resolve the display image URL: uploaded file (image_path) or external URL (image_url).
     */
    public function getImageUrlAttribute(?string $value): ?string
    {
        if ($this->attributes['image_path'] ?? null) {
            return Storage::url($this->attributes['image_path']);
        }

        return $value;
    }
}
