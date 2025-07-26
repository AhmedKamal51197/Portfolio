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
            'title' => $this->title,
            'description' => $this->description,
            'type' => __($this->type), // 'vision' or 'mission'
            'icon' => $this->getImagePathFromDirectory($this->icon, 'MyVisionMission')
        ];
    }
}
