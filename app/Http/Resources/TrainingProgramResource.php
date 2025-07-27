<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TrainingProgramResource extends JsonResource
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
        //  new TrainigProgramCardResource(null);   // ❌ will throw an error (invalid argument)
        //  TrainigProgramCardResource::make(null); // ✅ returns null safely
         return [
             'id' => $this->id,
             'title' => $this->title,
             'description' => $this->description,

             'cards' => [
                 'first_card' =>   TrainigProgramCardResource::make($cards->get(1)),
                 'second_card' =>  TrainigProgramCardResource::make($cards->get(2)),
                 'third_card' =>   TrainigProgramCardResource::make($cards->get(3)),
                 'fourth_card' =>   TrainigProgramCardResource::make($cards->get(4)),
                'fifth_card' =>   TrainigProgramCardResource::make($cards->get(5)),
                'sixth_card' =>  TrainigProgramCardResource::make($cards->get(6)),
                'seventh_card' =>   TrainigProgramCardResource::make($cards->get(7)),
                'eighth_card' =>   TrainigProgramCardResource::make($cards->get(8)),
                'ninth_card' =>   TrainigProgramCardResource::make($cards->get(9)),
                'tenth_card' =>  TrainigProgramCardResource::make($cards->get(10)),

             ],
         ];
    }
}
