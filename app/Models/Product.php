<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category',
        'brand',
        'slug',
        'image_url',
        'price',
        'affiliate_url',
        'description',
        'is_active',
    ];
}
