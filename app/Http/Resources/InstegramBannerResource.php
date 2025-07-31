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
            'title' => $this->title,
            'all_broadcast_link' => $this->all_broadcast_link,
            'banner_title' => $this->banner_title,
            'banner_description' => $this->banner_description,
            'broadcast_link' =>$this->broadcast_link,
            'image' => $this->getImagePathFromDirectory($this->image, 'InstegramBanners'),

        ];
    }
}
