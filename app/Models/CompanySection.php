<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanySection extends Model
{
    protected $fillable = [
        'type',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'images',
        'order',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean'
    ];
}

