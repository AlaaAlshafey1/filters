<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->latest()->get();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'nullable',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'eco_description' => 'nullable',
            'finishes_description' => 'nullable',
            'category_id' => 'required|exists:categories,id',

            'main_image' => 'nullable|image',
            'images.*' => 'nullable|image',

            'pdf_open_plate' => 'nullable|mimes:pdf',
            'pdf_offset_hole' => 'nullable|mimes:pdf',
            'pdf_closed_plate' => 'nullable|mimes:pdf',
            'is_tecnology'=>'nullable'
        ]);

        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')
                ->store('products/main', 'public');
        }

        foreach (['pdf_open_plate','pdf_offset_hole','pdf_closed_plate'] as $pdf) {
            if ($request->hasFile($pdf)) {
                $data[$pdf] = $request->file($pdf)
                    ->store('products/pdfs', 'public');
            }
        }

        $product = Product::create($data);

        // Gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image->store('products/gallery', 'public'),
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'تم إضافة المنتج بنجاح');
    }

    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        $categories = Category::all();

        return view('products.edit', compact('product','categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $data = $request->validate([
            'name_ar' => 'required',
            'name_en' => 'nullable',
            'description_ar' => 'nullable',
            'description_en' => 'nullable',
            'eco_description' => 'nullable',
            'finishes_description' => 'nullable',
            'category_id' => 'required|exists:categories,id',

            'main_image' => 'nullable|image',
            'images.*' => 'nullable|image',

            'pdf_open_plate' => 'nullable|mimes:pdf',
            'pdf_offset_hole' => 'nullable|mimes:pdf',
            'pdf_closed_plate' => 'nullable|mimes:pdf',
            'is_tecnology'=>'nullable'

        ]);

        // Main image
        if ($request->hasFile('main_image')) {
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            $data['main_image'] = $request->file('main_image')
                ->store('products/main', 'public');
        }

        // PDFs
        foreach (['pdf_open_plate','pdf_offset_hole','pdf_closed_plate'] as $pdf) {
            if ($request->hasFile($pdf)) {
                if ($product->$pdf) {
                    Storage::disk('public')->delete($product->$pdf);
                }
                $data[$pdf] = $request->file($pdf)
                    ->store('products/pdfs', 'public');
            }
        }

        $product->update($data);

        // Add new gallery images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $image->store('products/gallery', 'public'),
                    'sort_order' => $index
                ]);
            }
        }

        return redirect()->route('products.index')
            ->with('success', 'تم تعديل المنتج بنجاح');
    }

    public function destroy($id)
    {
        $product = Product::with('images')->findOrFail($id);

        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }

        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image);
        }

        $product->delete();

        return redirect()->route('products.index')
            ->with('success','تم حذف المنتج بنجاح');
    }

    public function destroyImage(ProductImage $image)
    {
        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return back()->with('success', 'تم حذف الصورة');
    }
}
