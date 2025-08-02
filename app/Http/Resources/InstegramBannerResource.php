<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstegramBannerResource extends JsonResource
{
    use \App\Traits\ImageTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'all_broadcast_link' => $this->all_broadcast_link,
            'banner_title_ar' => $this->banner_title_ar,
            'banner_title_en' => $this->banner_title_en,
            'banner_description_ar' => $this->banner_description_ar,
            'banner_description_en' => $this->banner_description_en,
            'broadcast_link' =>$this->broadcast_link,
            'image' => $this->getImagePathFromDirectory($this->image, 'InstegramBanners'),

        ];
    }
}
