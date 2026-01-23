<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExclusiveDistributor extends Model
{
    protected $fillable = [
        'title_ar','title_en',
        'subtitle_ar','subtitle_en',
        'description_ar','description_en',
        'image','image_alt_ar','image_alt_en',
        'button_text_ar','button_text_en',
        'button_link','open_new_tab',
        'country_code',
        'sort_order','is_active'
    ];
}

