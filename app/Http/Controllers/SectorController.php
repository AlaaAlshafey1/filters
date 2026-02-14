<?php

namespace App\Http\Controllers;

use App\Models\Sector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Sector::orderBy('created_at', 'desc')->get();
        return view('sectors.index', compact('sectors'));
    }

    public function create()
    {
        return view('sectors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'desc_ar' => 'nullable|string',
            'desc_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('sectors', 'public');
        }

        Sector::create($data);

        return redirect()->route('sectors.index')->with('success', 'تمت الإضافة بنجاح');
    }

    public function edit(Sector $sector)
    {
        return view('sectors.edit', compact('sector'));
    }

    public function update(Request $request, Sector $sector)
    {
        $data = $request->validate([
            'title_ar' => 'required|string|max:255',
            'title_en' => 'required|string|max:255',
            'desc_ar' => 'nullable|string',
            'desc_en' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // حذف الصورة القديمة
            if ($sector->image) {
                Storage::disk('public')->delete($sector->image);
            }
            $data['image'] = $request->file('image')->store('sectors', 'public');
        }

        $sector->update($data);

        return redirect()->route('sectors.index')->with('success', 'تم التحديث بنجاح');
    }

    public function destroy(Sector $sector)
    {
        if ($sector->image) {
            Storage::disk('public')->delete($sector->image);
        }
        $sector->delete();
        return back()->with('success', 'تم الحذف');
    }

    public function show(Sector $sector)
    {
        return view('sectors.show', compact('sector'));
    }
}
