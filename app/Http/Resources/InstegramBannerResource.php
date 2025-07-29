<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstegramBannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'banner_title' => $this->banner_title,
            'banner_description' => $this->banner_description,

            'image' => $this->getImagePathFromDirectory($this->image, 'InstegramBanners'),
            'all_broadcast_link' => $this->all_broadcast_link,
            'broadcast_link' =>$this->broadcast_link,
        ];
    }
}
