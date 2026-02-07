<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    public function privacy()
    {
        $content = Setting::where('key', 'privacy_policy')->value('value');
        return response()->json([
            'success' => true,
            'data' => $content ?? ''
        ]);
    }

    public function terms()
    {
        $content = Setting::where('key', 'terms_conditions')->value('value');
        return response()->json([
            'success' => true,
            'data' => $content ?? ''
        ]);
    }

    public function cookies()
    {
        $content = Setting::where('key', 'cookies_policy')->value('value');
        return response()->json([
            'success' => true,
            'data' => $content ?? ''
        ]);
    }

    public function all()
    {
        $keys = ['privacy_policy', 'terms_conditions', 'cookies_policy'];
        $legal = Setting::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        return response()->json([
            'success' => true,
            'data' => [
                'privacy_policy' => $legal['privacy_policy'] ?? '',
                'terms_conditions' => $legal['terms_conditions'] ?? '',
                'cookies_policy' => $legal['cookies_policy'] ?? '',
            ]
        ]);
    }
}
