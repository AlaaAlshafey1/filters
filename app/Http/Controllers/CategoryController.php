<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(10);
        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all(); // لاختيار الفئة الأصلية
        return view('categories.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar'   => 'required|string|max:255',
            'name_en'   => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'slug'      => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',


        ]);

        $data['slug'] = isset($data['name_en']) ? Str::slug($data['name_en']) : null;
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('categories', 'public');
        }
        Category::create($data);

        return redirect()->route('categories.index')
                         ->with('success', 'تمت إضافة الفئة بنجاح');
    }

    public function edit(Category $category)
    {
        $categories = Category::where('id', '!=', $category->id)->get();
        return view('categories.edit', compact('category', 'categories'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name_ar'   => 'required|string|max:255',
            'name_en'   => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
            'slug'      => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        ]);
        $data['slug'] = isset($data['name_en']) ? Str::slug($data['name_en']) : null;
            if ($request->hasFile('image')) {

                // (اختياري) حذف الصورة القديمة
                if ($category->image && \Storage::disk('public')->exists($category->image)) {
                    \Storage::disk('public')->delete($category->image);
                }

                $data['image'] = $request->file('image')->store('categories', 'public');
            }

        $category->update($data);

        return redirect()->route('categories.index')
                         ->with('success', 'تم تحديث الفئة بنجاح');
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('categories.index')
                         ->with('success', 'تم حذف الفئة بنجاح');
    }
}
