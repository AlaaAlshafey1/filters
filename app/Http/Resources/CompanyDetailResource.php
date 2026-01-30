<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CompanyDetailResource extends JsonResource
{
    public function toArray($request)
    {
        $lang = $request->header('Accept-Language', 'ar');

        return [
            'id' => $this->id,
            'section_key' => $this->section_key, // about_main, about_media
            'title' => $lang === 'en' ? $this->title_en : $this->title_ar,
            'description' => $lang === 'en' ? $this->description_en : $this->description_ar,
            'images' => $this->images ?? [],
            'video_url' => $this->video_url,
            'is_active' => $this->is_active,
        ];
    }
}
