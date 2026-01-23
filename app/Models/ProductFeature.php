<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductFeature extends Model
{
    protected $fillable = ['product_id','title_ar','title_en','description_ar','description_en','icon'];

    public function product() {
        return $this->belongsTo(Product::class);
    }
}

