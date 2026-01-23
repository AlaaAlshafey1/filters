<?php

namespace App\Http\Controllers;

use App\Models\CompanyDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyDetailController extends Controller
{
    public function index()
    {
        $details = CompanyDetail::orderBy('id','asc')->get();
        return view('company_details.index', compact('details'));
    }

    public function create()
    {
        return view('company_details.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'section_key'    => 'required|string|max:255|unique:company_details,section_key',
            'title_ar'       => 'nullable|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'video_url'      => 'nullable|url',
            'is_active'      => 'nullable|boolean'
        ]);

        if($request->hasFile('images')){
            $images = [];
            foreach($request->file('images') as $image){
                $path = $image->store('company_details', 'public'); // تخزين في storage/app/public/company_details
                $images[] = $path;
            }
        $data['images'] = $images;
        }
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        CompanyDetail::create($data);

        return redirect()->route('company-details.index')->with('success','تمت الإضافة');
    }

    public function edit(CompanyDetail $companyDetail)
    {
        return view('company_details.edit', compact('companyDetail'));
    }

    public function update(Request $request, CompanyDetail $companyDetail)
    {
        $data = $request->validate([
            'title_ar'       => 'nullable|string|max:255',
            'title_en'       => 'nullable|string|max:255',
            'description_ar' => 'nullable|string',
            'description_en' => 'nullable|string',
            'images.*'       => 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:2048',
            'video_url'      => 'nullable|url',
            'is_active'      => 'nullable|boolean'
        ]);

        // احتفظ بالصور القديمة (بدون json_decode)
        $existingImages = $companyDetail->images ?? [];

        // إضافة صور جديدة
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path = $image->store('company_details', 'public');
                $existingImages[] = $path;
            }
        }

        $data['images'] = $existingImages; // لا تحتاج json_encode لأن الـ Model سيقوم بالتحويل تلقائيًا
        $data['is_active'] = $request->has('is_active') ? 1 : 0;

        $companyDetail->update($data);

        return redirect()->route('company-details.index')->with('success','تم التعديل');
        }
public function destroy(CompanyDetail $companyDetail)
{
    $images = $companyDetail->images;

    if ($images && !is_array($images)) {
        $images = json_decode($images, true) ?: [];
    }

    foreach($images as $img) {
        Storage::disk('public')->delete($img);
    }

    $companyDetail->delete();

    return back()->with('success','تم الحذف');
}
}
