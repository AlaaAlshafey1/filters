<?php

namespace App\Helpers;

class LocaleHelper
{
    public static function getLocale(): string
    {
        $locale = request()->header('Accept-Language');

        if (!$locale) return 'ar';

        // ناخد أول جزء لو فيه en-US مثلا
        $locale = strtolower(substr($locale, 0, 2));
        return in_array($locale, ['ar', 'en']) ? $locale : 'ar';
    }
}
