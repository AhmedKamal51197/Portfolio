<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComunityImpactCardResource extends JsonResource
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
            'description' => $this->description,
            'icon' => $this->getImagePathFromDirectory($this->icon, 'ComunityImpacts'),
        ];
    }
}
