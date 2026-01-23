<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\LocaleHelper;

class CategoryResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = LocaleHelper::getLocale();

        return [
            'id' => $this->id,
            'name' => $this->{"name_$locale"},
            'slug' => $this->slug,
            'children' => $this->children ? CategoryResource::collection($this->children) : [],
        ];
    }
}
