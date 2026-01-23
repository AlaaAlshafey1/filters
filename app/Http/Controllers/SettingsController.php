<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = Setting::all()->pluck('value','key')->toArray();
        return view('settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,svg|max:2048',
            'favicon' => 'nullable|image|mimes:ico,png|max:1024',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:100',
            'address' => 'nullable|string|max:255',
            'facebook' => 'nullable|url|max:255',
            'twitter' => 'nullable|url|max:255',
            'instagram' => 'nullable|url|max:255',
            'linkedin' => 'nullable|url|max:255',
        ]);

        // Handle images
        foreach (['logo', 'favicon'] as $imgField) {
            if($request->hasFile($imgField)){
                $file = $request->file($imgField);
                $path = $file->store('settings', 'public');

                // Delete old if exists
                $old = Setting::where('key', $imgField)->first();
                if($old && $old->value){
                    Storage::disk('public')->delete($old->value);
                }

                Setting::updateOrCreate(['key'=>$imgField], ['value'=>$path]);
            }
        }

        foreach(['phone','email','address','facebook','twitter','instagram','linkedin'] as $field){
            if(isset($data[$field])){
                Setting::updateOrCreate(['key'=>$field], ['value'=>$data[$field]]);
            }
        }

        return redirect()->back()->with('success','تم تحديث الإعدادات');
    }
}
