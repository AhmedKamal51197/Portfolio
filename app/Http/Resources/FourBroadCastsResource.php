<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FourBroadCastsResource extends JsonResource
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
            'broadcast_link' => $this->broadcast_link,
            'image' => $this->getImagePathFromDirectory($this->image, 'FourBroadCasts'),
       ];
    }
}
