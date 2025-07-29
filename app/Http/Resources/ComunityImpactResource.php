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
            'title' => $this->title,
            'images'=> $this->images->map(fn($img) => $this->getImagePathFromDirectory($img->image, 'ComunityImpacts')),
            'cards' => [
                'first_card' =>  new  ComunityImpactCardResource($cards->get(1)),
                'second_card'=>  new  ComunityImpactCardResource($cards->get(2)),
                'third_card' =>  new  ComunityImpactCardResource($cards->get(3)),
                'fourth_card'=>  new  ComunityImpactCardResource($cards->get(4)),
            ],
        ];
    }
}
