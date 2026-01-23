<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'title1_ar','title1_en',
        'title2_ar','title2_en',
        'desc1_ar','desc1_en',
        'title3_ar','title3_en',
        'desc2_ar','desc2_en',
        'image',
        'items',
        'is_active'
        
    ];

    protected $casts = [
        'items' => 'array'
    ];
}
