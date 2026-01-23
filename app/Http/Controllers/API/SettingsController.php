<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class SettingsController extends Controller
{
    public function index()
    {
        // جلب كل الإعدادات كـ key => value
        $settings = Setting::all()->pluck('value','key')->toArray();

        // إذا فيه logo أو favicon، حولهم لرابط كامل
        if(isset($settings['logo']) && $settings['logo']){
            $settings['logo'] = asset('storage/' . $settings['logo']);
        }

        if(isset($settings['favicon']) && $settings['favicon']){
            $settings['favicon'] = asset('storage/' . $settings['favicon']);
        }

        return response()->json([
            'success' => true,
            'data' => $settings
        ]);
    }
}
