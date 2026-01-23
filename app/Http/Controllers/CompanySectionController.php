<?php

namespace App\Http\Controllers;

use App\Models\CompanySection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanySectionController extends Controller
{
    public function index()
    {
        $sections = CompanySection::orderBy('id','desc')->get();
        return view('company_sections.index', compact('sections'));
    }

    public function create()
    {
        return view('company_sections.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title_ar'       => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active'      => 'nullable|boolean'
        ]);

        // رفع الصور
        if($request->hasFile('images')) {
            $uploadedImages = [];
            foreach($request->file('images') as $image) {
                $uploadedImages[] = $image->store('company_sections','public');
            }
            $data['images'] = $uploadedImages;
        }

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        CompanySection::create($data);

        return redirect()->route('company-sections.index')->with('success','تمت الإضافة');
    }

    public function edit(CompanySection $companySection)
    {
        return view('company_sections.edit', compact('companySection'));
    }

    public function update(Request $request, CompanySection $companySection)
    {
        $data = $request->validate([
            'title_ar'       => 'required|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'is_active'      => 'nullable|boolean'
        ]);

        // رفع الصور الجديدة وإضافة القديمة
        $images = $companySection->images ?? [];
        if($request->hasFile('images')) {
            foreach($request->file('images') as $image) {
                $images[] = $image->store('company_sections','public');
            }
        }
        $data['images'] = $images;

        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $companySection->update($data);

        return redirect()->route('company-sections.index')->with('success','تم التعديل');
    }

    public function destroy(CompanySection $companySection)
    {
        // حذف الصور من التخزين
        if($companySection->images) {
            foreach($companySection->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $companySection->delete();
        return back()->with('success','تم الحذف');
    }
}
