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
        $settings = Setting::all()->pluck('value', 'key')->toArray();
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
            'privacy_policy' => 'nullable|string',
            'terms_conditions' => 'nullable|string',
            'cookies_policy' => 'nullable|string',
            'privacy_policy_ar' => 'nullable|string',
            'terms_conditions_ar' => 'nullable|string',
            'cookies_policy_ar' => 'nullable|string',
            'privacy_policy_en' => 'nullable|string',
            'terms_conditions_en' => 'nullable|string',
            'cookies_policy_en' => 'nullable|string',
        ]);

        // Handle images
        foreach (['logo', 'favicon'] as $imgField) {
            if ($request->hasFile($imgField)) {
                $file = $request->file($imgField);
                $path = $file->store('settings', 'public');

                // Delete old if exists
                $old = Setting::where('key', $imgField)->first();
                if ($old && $old->value) {
                    Storage::disk('public')->delete($old->value);
                }

                Setting::updateOrCreate(['key' => $imgField], ['value' => $path]);
            }
        }

        $fields = [
            'phone',
            'email',
            'address',
            'facebook',
            'twitter',
            'instagram',
            'linkedin',
            'privacy_policy',
            'terms_conditions',
            'cookies_policy',
            'privacy_policy_ar',
            'terms_conditions_ar',
            'cookies_policy_ar',
            'privacy_policy_en',
            'terms_conditions_en',
            'cookies_policy_en'
        ];

        foreach ($fields as $field) {
            if (isset($data[$field])) {
                Setting::updateOrCreate(['key' => $field], ['value' => $data[$field]]);
            }
        }

        return redirect()->back()->with('success', 'تم تحديث الإعدادات');
    }
}
