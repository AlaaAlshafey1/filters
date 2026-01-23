<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    public function index()
    {
        $sliders = Slider::latest()->get();
        return view('sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('sliders.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
            'image' => 'required|image',
        ]);

        $image = $request->file('image')->store('sliders', 'public');

        Slider::create([
            'title_ar' => $request->title_ar,
            'title_en' => $request->title_en,
            'description_ar' => $request->description_ar,
            'description_en' => $request->description_en,
            'image' => $image,
            'is_active' => $request->is_active,
        ]);

        return redirect()->route('sliders.index')->with('success', 'تم إضافة السلايدر بنجاح');
    }

    public function edit(Slider $slider)
    {
        return view('sliders.edit', compact('slider'));
    }

    public function update(Request $request, Slider $slider)
    {
        $request->validate([
            'title_ar' => 'required|string|max:255',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($slider->image);
            $data['image'] = $request->file('image')->store('sliders', 'public');
        }

        $slider->update($data);

        return redirect()->route('sliders.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Slider $slider)
    {
        Storage::disk('public')->delete($slider->image);
        $slider->delete();

        return back()->with('success', 'تم الحذف بنجاح');
    }
}

