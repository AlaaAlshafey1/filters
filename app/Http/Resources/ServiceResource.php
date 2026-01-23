<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\LocaleHelper;

class ServiceResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = LocaleHelper::getLocale(); // ar / en

        $items = collect($this->items)->map(function($item) use ($locale) {
            return [
                'title' => $item["title_$locale"] ?? null,
                'desc'  => $item["desc_$locale"] ?? null,
            ];
        });

        return [
            'id'      => $this->id,
            'title1'  => $this->{"title1_$locale"},
            'title2'  => $this->{"title2_$locale"},
            'title3'  => $this->{"title3_$locale"},
            'desc1'   => $this->{"desc1_$locale"},
            'desc2'   => $this->{"desc2_$locale"},
            'image'   => $this->image ? asset('storage/'.$this->image) : null,
            'items'   => $items,
            'is_active' => $this->is_active,
        ];
    }
}
