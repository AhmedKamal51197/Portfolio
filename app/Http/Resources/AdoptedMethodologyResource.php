<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdoptedMethodologyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       
          // اجلب البطاقات المفتاحية بناءً على position
          $cards = $this->cards->keyBy('position');

          return [
              'id' => $this->id,
              'title_ar' => $this->title_ar,
              'title_en' => $this->title_en,
              'description_ar' => $this->description_ar,
              'description_en' => $this->description_en,
  
              'cards' => [
                   new AdoptedMethodologyCardResource($cards->get(1)),
                   new AdoptedMethodologyCardResource($cards->get(2)),
                   new AdoptedMethodologyCardResource($cards->get(3)),
                   new AdoptedMethodologyCardResource($cards->get(4)),
              ],
          ];
    }
}
