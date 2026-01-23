<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\SliderFeature;
use App\Models\Product;
use App\Models\Category;
use App\Models\ExclusiveDistributor;
use App\Models\CompanyDetail;
use App\Models\Blog;

use App\Http\Resources\SliderResource;
use App\Http\Resources\SliderFeatureResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ExclusiveDistributorResource;
use App\Http\Resources\CompanyDetailResource;
use App\Http\Resources\BlogResource;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return response()->json([
            'slider' => SliderResource::collection(Slider::where('is_active',1)->get()),
            'slider_features' => SliderFeatureResource::collection(SliderFeature::where('is_active',1)->get()),
            'categories' => CategoryResource::collection(Category::whereNull('parent_id')->get()),
            'products' => ProductResource::collection(Product::with('category','images')->get()),
            'exclusive_distributors' => ExclusiveDistributorResource::collection(ExclusiveDistributor::where('is_active',1)->get()),
            'company_detail' => CompanyDetailResource::collection(CompanyDetail::where('section_key','company')->get()),
            'blogs' => BlogResource::collection(Blog::where('is_active',1)->get()),
        ]);
    }
}
