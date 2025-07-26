<?php
namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProfessionalAppreciationGroupResource extends JsonResource
{
    public function toArray(Request $request): array
    {
     
          // اجلب البطاقات المفتاحية بناءً على position
          $cards = $this->cards->keyBy('position');

          return [
              'id' => $this->id,
              'title' => $this->title,
  
              'cards' => [
                  'first_card' => new ProfessionalAppreciationCardResource($cards->get(1)),
                  'second_card' => new ProfessionalAppreciationCardResource($cards->get(2)),
                  'third_card' => new ProfessionalAppreciationCardResource($cards->get(3)),
              ],
          ];
    }
}
