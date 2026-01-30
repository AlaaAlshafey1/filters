<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\CompanyDetail;
use App\Models\CompanySection;

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
    /* ================= MAIN ABOUT ================= */
    CompanyDetail::updateOrCreate(
        ['section_key' => 'about_main'],
        $request->main
    );

    /* ================= VISIONS ================= */
    if ($request->filled('visions')) {
        foreach ($request->visions as $index => $vision) {
            CompanySection::create([
                'type' => 'vision',
                'title_ar' => $vision['title_ar'] ?? null,
                'title_en' => $vision['title_en'] ?? null,
                'description_ar' => $vision['description_ar'] ?? null,
                'description_en' => $vision['description_en'] ?? null,
                'order' => $index,
                'is_active' => 1
            ]);
        }
    }

    /* ================= EXTRA CONTENT ================= */
    if ($request->filled('contents')) {
        foreach ($request->contents as $index => $content) {
            CompanySection::create([
                'type' => 'content',
                'title_ar' => $content['title_ar'],
                'title_en' => $content['title_en'],
                'description_ar' => $content['description_ar'],
                'description_en' => $content['description_en'],
                'order' => $index,
                'is_active' => 1
            ]);
        }
    }

    /* ================= IMAGES + VIDEO ================= */
    $images = [];
    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $img) {
            $images[] = $img->store('about','public');
        }
    }

    CompanyDetail::updateOrCreate(
        ['section_key' => 'about_media'],
        [
            'images' => $images,
            'video_url' => $request->video['url'] ?? null
        ]
    );

    return redirect()->route('company-details.index')
        ->with('success','تم حفظ صفحة About بنجاح');
}

public function edit(CompanyDetail $companyDetail)
{
    $visions = CompanySection::where('type','vision')
        ->orderBy('order')
        ->get();

    $contents = CompanySection::where('type','content')
        ->orderBy('order')
        ->get();

    return view('company_details.edit', compact(
        'companyDetail',
        'visions',
        'contents'
    ));
}



public function update(Request $request, CompanyDetail $companyDetail)
{
    /* ================= VALIDATION ================= */
    $request->validate([
        'title_ar' => 'nullable|string|max:255',
        'title_en' => 'nullable|string|max:255',
        'description_ar' => 'nullable|string',
        'description_en' => 'nullable|string',
        'video_url' => 'nullable|url',

        'images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',

        'visions.*.title_ar' => 'nullable|string|max:255',
        'visions.*.title_en' => 'nullable|string|max:255',
        'visions.*.description_ar' => 'nullable|string',
        'visions.*.description_en' => 'nullable|string',

        'contents.*.title_ar' => 'nullable|string|max:255',
        'contents.*.title_en' => 'nullable|string|max:255',
        'contents.*.description_ar' => 'nullable|string',
        'contents.*.description_en' => 'nullable|string',
    ]);

    /* ================= MAIN ABOUT ================= */
    $companyDetail->update([
        'title_ar' => $request->title_ar,
        'title_en' => $request->title_en,
        'description_ar' => $request->description_ar,
        'description_en' => $request->description_en,
        'video_url' => $request->video_url,
    ]);

    /* ================= IMAGES ================= */
    $images = $companyDetail->images ?? [];

    if ($request->hasFile('images')) {
        foreach ($request->file('images') as $image) {
            $images[] = $image->store('company_details', 'public');
        }
    }

    $companyDetail->update([
        'images' => $images
    ]);

    /* ================= VISIONS ================= */
    CompanySection::where('type', 'vision')->delete();

    if ($request->filled('visions')) {
        foreach ($request->visions as $index => $vision) {
            CompanySection::create([
                'type' => 'vision',
                'title_ar' => $vision['title_ar'] ?? null,
                'title_en' => $vision['title_en'] ?? null,
                'description_ar' => $vision['description_ar'] ?? null,
                'description_en' => $vision['description_en'] ?? null,
                'order' => $index,
                'is_active' => 1,
            ]);
        }
    }

    /* ================= CONTENT SECTIONS ================= */
    CompanySection::where('type', 'content')->delete();

    if ($request->filled('contents')) {
        foreach ($request->contents as $index => $content) {
            CompanySection::create([
                'type' => 'content',
                'title_ar' => $content['title_ar'] ?? null,
                'title_en' => $content['title_en'] ?? null,
                'description_ar' => $content['description_ar'] ?? null,
                'description_en' => $content['description_en'] ?? null,
                'order' => $index,
                'is_active' => 1,
            ]);
        }
    }

    return redirect()
        ->route('company-details.edit', $companyDetail->id)
        ->with('success', 'تم تحديث صفحة About بنجاح');
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
