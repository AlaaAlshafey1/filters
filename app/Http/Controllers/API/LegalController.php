<?php

namespace App\Http\Controllers\Api;

use App\Helpers\LocaleHelper;
use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class LegalController extends Controller
{
    private function getLocale()
    {
        return         $locale = LocaleHelper::getLocale();

    }

    public function privacy()
    {
        $lang = $this->getLocale();
        $key = 'privacy_policy_' . $lang;
        $content = Setting::where('key', $key)->value('value');

        if (!$content && $lang == 'ar') {
            $content = Setting::where('key', 'privacy_policy')->value('value');
        }

        return response()->json([
            'success' => true,
            'data' => $content ?? ''
        ]);
    }

    public function terms()
    {
        $lang = $this->getLocale();
        $key = 'terms_conditions_' . $lang;
        $content = Setting::where('key', $key)->value('value');

        if (!$content && $lang == 'ar') {
            $content = Setting::where('key', 'terms_conditions')->value('value');
        }

        return response()->json([
            'success' => true,
            'data' => $content ?? ''
        ]);
    }

    public function cookies()
    {
        $lang = $this->getLocale();
        $key = 'cookies_policy_' . $lang;
        $content = Setting::where('key', $key)->value('value');

        if (!$content && $lang == 'ar') {
            $content = Setting::where('key', 'cookies_policy')->value('value');
        }

        return response()->json([
            'success' => true,
            'data' => $content ?? ''
        ]);
    }

    public function all()
    {
        $lang = $this->getLocale();
        $keys = [
            'privacy_policy_' . $lang,
            'terms_conditions_' . $lang,
            'cookies_policy_' . $lang,
            'privacy_policy',
            'terms_conditions',
            'cookies_policy'
        ];
        $legal = Setting::whereIn('key', $keys)->pluck('value', 'key')->toArray();

        return response()->json([
            'success' => true,
            'data' => [
                'privacy_policy' => $legal['privacy_policy_' . $lang] ?? ($lang == 'ar' ? ($legal['privacy_policy'] ?? '') : ''),
                'terms_conditions' => $legal['terms_conditions_' . $lang] ?? ($lang == 'ar' ? ($legal['terms_conditions'] ?? '') : ''),
                'cookies_policy' => $legal['cookies_policy_' . $lang] ?? ($lang == 'ar' ? ($legal['cookies_policy'] ?? '') : ''),
            ]
        ]);
    }
}
