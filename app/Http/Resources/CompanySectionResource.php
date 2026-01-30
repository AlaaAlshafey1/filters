<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanySectionResource extends JsonResource
{
    public function toArray($request)
    {
        $lang = $request->header('Accept-Language', 'ar');

        return [
            'id' => $this->id,
            'type' => $this->type, // vision, content
            'title' => $lang === 'en' ? $this->title_en : $this->title_ar,
            'description' => $lang === 'en' ? $this->description_en : $this->description_ar,
            'order' => $this->order,
            'is_active' => $this->is_active,
        ];
    }
}
