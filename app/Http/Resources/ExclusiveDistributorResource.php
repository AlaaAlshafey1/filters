<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\LocaleHelper;

class ExclusiveDistributorResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = LocaleHelper::getLocale();

        return [
            'id' => $this->id,
            'title' => $this->{"title_$locale"},
            'subtitle' => $this->{"subtitle_$locale"},
            'description' => $this->{"description_$locale"},
            'image' => $this->image ? asset('storage/'.$this->image) : null,
            'image_alt' => $this->{"image_alt_$locale"},
            'button_text' => $this->{"button_text_$locale"},
            'button_link' => $this->button_link,
            'open_new_tab' => (bool)$this->open_new_tab,
            'country_code' => $this->country_code,
        ];
    }
}
