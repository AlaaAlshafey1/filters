<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::orderBy('id', 'desc')->get();
        return view('services.index', compact('services'));
    }

    public function create()
    {
        return view('services.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title1_ar' => 'required|string|max:255',
            'title1_en' => 'nullable|string|max:255',
            'title2_ar' => 'nullable|string|max:255',
            'title2_en' => 'nullable|string|max:255',
            'desc1_ar'  => 'nullable|string',
            'desc1_en'  => 'nullable|string',
            'title3_ar' => 'nullable|string|max:255',
            'title3_en' => 'nullable|string|max:255',
            'desc2_ar'  => 'nullable|string',
            'desc2_en'  => 'nullable|string',
            'image'     => 'nullable|image|max:2048',
            'items'     => 'nullable|array',
            'items.*.title_ar' => 'nullable|string|max:255',
            'items.*.title_en' => 'nullable|string|max:255',
            'items.*.desc_ar'  => 'nullable|string',
            'items.*.desc_en'  => 'nullable|string',
        ]);

        $data = $request->only([
            'title1_ar','title1_en',
            'title2_ar','title2_en',
            'desc1_ar','desc1_en',
            'title3_ar','title3_en',
            'desc2_ar','desc2_en',
            'is_active'
        ]);

        // Upload Image
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // items JSON
        $data['items'] = $request->items ? $request->items : [];

        Service::create($data);

        return redirect()->route('services.index')->with('success', 'تم إضافة الخدمة بنجاح');
    }

    public function show(Service $service)
    {
        return view('services.show', compact('service'));
    }

    public function edit(Service $service)
    {
        return view('services.edit', compact('service'));
    }

    public function update(Request $request, Service $service)
    {
        $request->validate([
            'title1_ar' => 'required|string|max:255',
            'title1_en' => 'nullable|string|max:255',
            'title2_ar' => 'nullable|string|max:255',
            'title2_en' => 'nullable|string|max:255',
            'desc1_ar'  => 'nullable|string',
            'desc1_en'  => 'nullable|string',
            'title3_ar' => 'nullable|string|max:255',
            'title3_en' => 'nullable|string|max:255',
            'desc2_ar'  => 'nullable|string',
            'desc2_en'  => 'nullable|string',
            'image'     => 'nullable|image|max:2048',
            'items'     => 'nullable|array',
            'items.*.title_ar' => 'nullable|string|max:255',
            'items.*.title_en' => 'nullable|string|max:255',
            'items.*.desc_ar'  => 'nullable|string',
            'items.*.desc_en'  => 'nullable|string',
        ]);

        $data = $request->only([
            'title1_ar','title1_en',
            'title2_ar','title2_en',
            'desc1_ar','desc1_en',
            'title3_ar','title3_en',
            'desc2_ar','desc2_en',
            'is_active'
        ]);

        // Upload new image + delete old one
        if ($request->hasFile('image')) {
            if ($service->image) {
                Storage::disk('public')->delete($service->image);
            }
            $data['image'] = $request->file('image')->store('services', 'public');
        }

        // items JSON
        $data['items'] = $request->items ? $request->items : [];

        $service->update($data);

        return redirect()->route('services.index')->with('success', 'تم تحديث الخدمة بنجاح');
    }

    public function destroy(Service $service)
    {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }

        $service->delete();

        return redirect()->route('services.index')->with('success', 'تم حذف الخدمة بنجاح');
    }
}
