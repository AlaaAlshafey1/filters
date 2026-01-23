<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title_ar', 'title_en',
        'excerpt_ar', 'excerpt_en',
        'content_ar', 'content_en',
        'image', 'is_active',
    ];
}
