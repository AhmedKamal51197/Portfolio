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
              'title' => $this->title,
              'description' => $this->description,
  
              'cards' => [
                  'first_card' => new AdoptedMethodologyCardResource($cards->get(1)),
                  'second_card' => new AdoptedMethodologyCardResource($cards->get(2)),
                  'third_card' => new AdoptedMethodologyCardResource($cards->get(3)),
                  'fourth_card' => new AdoptedMethodologyCardResource($cards->get(4)),
              ],
          ];
    }
}
