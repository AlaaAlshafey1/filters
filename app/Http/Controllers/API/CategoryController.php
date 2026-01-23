<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::whereNull('parent_id')->with('children')->get();
        return response()->json([
            'success' => true,
            'data' => CategoryResource::collection($categories)
        ]);
    }

    public function products($id)
    {
        $category = Category::with('products.images')->findOrFail($id);
        return response()->json([
            'success' => true,
            'category' => [
                'id' => $category->id,
                'name' => $category->name_ar,
            ],
            'products' => ProductResource::collection($category->products)
        ]);
    }
}
