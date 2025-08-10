<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainigProgramCardResource extends JsonResource
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
            'position' => $this->position,
            'description_ar' => $this->description_ar,
            'description_en' => $this->description_en,
            'icon' => $this->getImagePathFromDirectory($this->icon, 'TrainingPrograms'),
        ];
    }
}
