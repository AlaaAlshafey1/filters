<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\LocaleHelper;

class FaqResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = LocaleHelper::getLocale();

        return [
            'id'       => $this->id,
            'question' => $this->{"question_$locale"},
            'answer'   => $this->{"answer_$locale"},
        ];
    }
}
