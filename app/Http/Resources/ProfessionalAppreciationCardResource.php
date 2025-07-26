<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalAppreciationCardResource extends JsonResource
{
    use \App\Traits\ImageTrait;

    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'description' => $this->description,
            'icon' => $this->getImagePathFromDirectory($this->icon, 'ProfessionalAppreciations'),
        ];
    }
}