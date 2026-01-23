<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\LocaleHelper;

class SliderResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = LocaleHelper::getLocale();

        return [
            'id' => $this->id,
            'title' => $this->{"title_$locale"},
            'description' => $this->{"description_$locale"},
            'image' => $this->image ? asset('storage/'.$this->image) : null,
        ];
    }
}
 