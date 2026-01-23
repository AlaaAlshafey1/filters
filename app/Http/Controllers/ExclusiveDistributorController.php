<?php

namespace App\Http\Controllers;

use App\Models\ExclusiveDistributor;
use Illuminate\Http\Request;

class ExclusiveDistributorController extends Controller
{
    public function index()
    {
        $exclusiveDistributors  = ExclusiveDistributor::get();
        return view('exclusive_distributors.index', compact('exclusiveDistributors'));
    }

    public function create()
    {
        return view('exclusive_distributors.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar'       => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'subtitle_ar'    => 'nullable|string|max:255',
            'subtitle_en'    => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active'      => 'nullable|boolean'
        ]);

        // رفع الصورة إذا كانت موجودة
        if ($request->hasFile('image')) {
            $data['image'] = $request->image->store('exclusive','public');
        }

        // إذا checkbox لم يتم اختياره، اجعل القيمة 0
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        ExclusiveDistributor::create($data);

        return redirect()->route('exclusive-distributors.index')
            ->with('success','تمت الإضافة');
    }


    public function edit(ExclusiveDistributor $exclusiveDistributor)
    {
        return view('exclusive_distributors.edit', compact('exclusiveDistributor'));
    }

    public function update(Request $request, ExclusiveDistributor $exclusiveDistributor)
    {
        $data = $request->validate([
            'title_ar'       => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'subtitle_ar'    => 'nullable|string|max:255',
            'subtitle_en'    => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'image'          => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active'      => 'nullable|boolean'
        ]);

        // رفع الصورة الجديدة إذا تم اختيارها
        if ($request->hasFile('image')) {
            // حذف الصورة القديمة إذا موجودة
            if ($exclusiveDistributor->image) {
                \Storage::disk('public')->delete($exclusiveDistributor->image);
            }
            $data['image'] = $request->image->store('exclusive','public');
        }

        // التعامل مع الـ checkbox
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $exclusiveDistributor->update($data);

        return redirect()->route('exclusive-distributors.index')
            ->with('success','تم التعديل');
    }

    public function destroy(ExclusiveDistributor $exclusiveDistributor)
    {
        $exclusiveDistributor->delete();
        return back()->with('success','تم الحذف');
    }
}

