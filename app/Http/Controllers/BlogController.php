<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();
        return view('blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'excerpt_ar' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        Blog::create($data);

        return redirect()->route('blogs.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'excerpt_ar' => 'nullable|string',
            'excerpt_en' => 'nullable|string',
            'content_ar' => 'nullable|string',
            'content_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active' => 'nullable|boolean'
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $data['image'] = $request->file('image')->store('blogs', 'public');
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $blog->update($data);

        return redirect()->route('blogs.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Blog $blog)
    {
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();
        return back()->with('success', 'تم الحذف');
    }

    public function show(Blog $blog)
    {
        return view('blogs.show', compact('blog'));
    }
}
