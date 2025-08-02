<?php

namespace App\Http\Resources;

use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MyVisionMissionResource extends JsonResource
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
            'id' => $this->id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'type' => __($this->type), // 'vision' or 'mission'
            'icon' => $this->getImagePathFromDirectory($this->icon, 'MyVisionMission')
        ];
    }
}
