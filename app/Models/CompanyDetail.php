<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'section_key',
        'title_ar',
        'title_en',
        'description_ar',
        'description_en',
        'images',
        'video_url',
        'is_active'
    ];

    protected $casts = [
        'images' => 'array',
        'is_active' => 'boolean'
    ];
}
