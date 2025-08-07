<?php

namespace App\Http\Resources;

use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    use ImageTrait;
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'=>$this->id,
            'name_ar' => $this->name_ar,
            'name_en' => $this->name_en,
            'link' => $this->link,
            'icon' => $this->getImagePathFromDirectory($this->icon,'SocialMedias'),

        ];
    }
}
