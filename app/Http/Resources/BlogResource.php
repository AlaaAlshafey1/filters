<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Helpers\LocaleHelper;

class BlogResource extends JsonResource
{
    public function toArray($request)
    {
        $locale = LocaleHelper::getLocale();

        return [
            'id' => $this->id,
            'title' => $this->{"title_$locale"},
            'excerpt' => $this->{"excerpt_$locale"},
            'content' => $this->{"content_$locale"},
            'image' => $this->image ? asset('storage/'.$this->image) : null,
            'created_at' => date("d-m-Y",strtotime($this->created_at)),
        ];
    }
}
  