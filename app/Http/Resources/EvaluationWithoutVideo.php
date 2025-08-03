<?php

namespace App\Http\Resources;

use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class EvaluationWithoutVideo extends JsonResource
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
            'client_name_en'=> $this->client_name_en,
            'client_name_ar' => $this->client_name_ar,
            'image' => $this->getImagePathFromDirectory($this->image, 'evaluations'),
            'evaluate_ar'=> $this->evaluate_ar,
            'evaluate_en'=> $this->evaluate_en,
        ];
    }
}
