<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TiktokVideo extends Model
{
    protected $fillable = [
        'title',
        'embed_html',
        'is_active',
        'sort_order',
    ];
}

