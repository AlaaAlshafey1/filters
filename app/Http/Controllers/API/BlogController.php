<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Http\Resources\BlogResource;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::where('is_active',1)->paginate(10);
        return response()->json([
            'success' => true,
            'data' => BlogResource::collection($blogs),
            'pagination' => [
                'total' => $blogs->total(),
                'per_page' => $blogs->perPage(),
                'current_page' => $blogs->currentPage(),
                'last_page' => $blogs->lastPage(),
            ]
        ]);
    }

    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return response()->json([
            'success' => true,
            'data' => new BlogResource($blog)
        ]);
    }
}
