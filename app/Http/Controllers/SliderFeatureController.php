<?php

namespace App\Http\Controllers;

use App\Models\SliderFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderFeatureController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $features = SliderFeature::latest()->get();
        return view('features.index', compact('features'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('features.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => 'required|string|max:255', // بدل الصورة
            'is_active' => 'required|boolean',
        ]);

        // $data['image'] = $request->file('image')->store('features', 'public');

        SliderFeature::create($data);

        return redirect()
            ->route('features.index')
            ->with('success', 'تمت إضافة الميزة بنجاح');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $feature = SliderFeature::findOrFail($id);
        return view('features.edit', compact('feature'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $feature = SliderFeature::findOrFail($id);

        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'icon' => 'required|string|max:255', // بدل الصورة
            'is_active' => 'required|boolean',
        ]);


        $feature->update($data);

        return redirect()
            ->route('features.index')
            ->with('success', 'تم التعديل بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $feature = SliderFeature::findOrFail($id);

        Storage::disk('public')->delete($feature->image);
        $feature->delete();

        return redirect()
            ->route('features.index')
            ->with('success', 'تم الحذف بنجاح');
    }
}
