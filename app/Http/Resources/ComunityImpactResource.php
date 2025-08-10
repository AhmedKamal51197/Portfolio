<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ComunityImpactResource extends JsonResource
{
    use \App\Traits\ImageTrait;
    public function toArray(Request $request): array
    {
        //  dd($this->images->map(fn($img) => $this->getImagePathFromDirectory($img->image, 'ComunityImpacts')));
         
        $cards = $this->cards->keyBy('position');
        return [
            'id' => $this->id,
            'title_ar' => $this->title_ar,
            'title_en' => $this->title_en,
            'images'=> $this->images->map(fn($img) => $this->getImagePathFromDirectory($img->image, 'ComunityImpacts')),
            'cards' => [
                  new  ComunityImpactCardResource($cards->get(1)),
                  new  ComunityImpactCardResource($cards->get(2)),
                  new  ComunityImpactCardResource($cards->get(3)),
                  new  ComunityImpactCardResource($cards->get(4)),
            ],
        ];
    }
}
