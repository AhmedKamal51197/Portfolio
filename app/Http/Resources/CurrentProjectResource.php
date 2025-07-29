<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CurrentProjectResource extends JsonResource
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
 
             'cards' => [
                 'first_card' => new CurrentProjectCardResource($cards->get(1)),
                 'second_card' => new CurrentProjectCardResource($cards->get(2)),
                 'third_card' => new CurrentProjectCardResource($cards->get(3)),
                 'fourth_card' => new CurrentProjectCardResource($cards->get(4)),
             ],
         ];
    }
}
