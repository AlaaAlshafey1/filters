<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;

class ProductController extends Controller
{
    public function show($id)
    {
        $product = Product::with('category','images')->findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => new ProductResource($product)
        ]);
    }

    public function index(Request $request)
    {
        $products = Product::with('category','images')->get();

        return response()->json([
            'success' => true,
            'data' => ProductResource::collection($products)
        ]);
    }
}
