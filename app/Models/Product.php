<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name_ar',
        'name_en',
        'description_ar',
        'description_en',
        'eco_description',
        'finishes_description',
        'main_image',
        'pdf_open_plate',
        'pdf_offset_hole',
        'pdf_closed_plate',
        'category_id',
        "is_tecnology"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
