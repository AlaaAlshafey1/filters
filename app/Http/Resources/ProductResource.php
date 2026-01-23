<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\LocaleHelper;

class ProductResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = LocaleHelper::getLocale();

        return [
            'id' => $this->id,
            'name' => $this->{"name_$locale"},
            'description' => $this->{"description_$locale"},
            'eco_description' => $this->eco_description,
            'finishes_description' => $this->finishes_description,
            'main_image' => $this->main_image ? asset('storage/'.$this->main_image) : null,
            'pdf_open_plate' => $this->pdf_open_plate ? asset('storage/'.$this->pdf_open_plate) : null,
            'pdf_offset_hole' => $this->pdf_offset_hole ? asset('storage/'.$this->pdf_offset_hole) : null,
            'pdf_closed_plate' => $this->pdf_closed_plate ? asset('storage/'.$this->pdf_closed_plate) : null,
            'category' => $this->category ? [
                'id' => $this->category->id,
                'name' => $this->category->{"name_$locale"}
            ] : null,
            'images' => $this->images->map(fn($img) => $img->image ? asset('storage/'.$img->image) : null),
            'is_tecnology' => $this->is_tecnology,

        ];
    }
}
