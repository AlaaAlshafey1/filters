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
use App\Models\Employee;
use App\Models\Blog;

use App\Http\Resources\SliderResource;
use App\Http\Resources\SliderFeatureResource;
use App\Http\Resources\ProductResource;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ExclusiveDistributorResource;
use App\Http\Resources\CompanyDetailResource;
use App\Http\Resources\EmployeeResource;
use App\Http\Resources\BlogResource;
use App\Http\Resources\CompanySectionResource;
use App\Models\CompanySection;

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

    // New endpoint for About Us + Employees
    public function aboutUs(Request $request)
    {
        $lang = $request->header('Accept-Language', 'ar');

        // تفاصيل About Main
        $aboutMain = CompanyDetail::where('section_key', 'about_main')->first();
        $aboutMedia = CompanyDetail::where('section_key', 'about_media')->first();

        // سيكشنات إضافية
        $visions = CompanySection::where('type', 'vision')->orderBy('order')->get();
        $contents = CompanySection::where('type', 'content')->orderBy('order')->get();

        // الموظفين
        $employees = Employee::orderBy('order')->get();

        return response()->json([
            'about' => [
                'main' => new CompanyDetailResource($aboutMain),
                'media' => new CompanyDetailResource($aboutMedia),
                'visions' => CompanySectionResource::collection($visions),
                'contents' => CompanySectionResource::collection($contents),
            ],
            'employees' => EmployeeResource::collection($employees),
        ]);
    }
    
}
