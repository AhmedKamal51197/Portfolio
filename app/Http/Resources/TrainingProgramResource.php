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
             'title_ar' => $this->title_ar,
             'title_en' => $this->title_en,
             'description_ar' => $this->description_ar,
             'description_en' => $this->description_en,

             'cards' => [
                TrainigProgramCardResource::collection($cards)
                //     TrainigProgramCardResource::make($cards->get(1)),
                //    TrainigProgramCardResource::make($cards->get(2)),
                //     TrainigProgramCardResource::make($cards->get(3)),
                //     TrainigProgramCardResource::make($cards->get(4)),
                //    TrainigProgramCardResource::make($cards->get(5)),
                //   TrainigProgramCardResource::make($cards->get(6)),
                //    TrainigProgramCardResource::make($cards->get(7)),
                //    TrainigProgramCardResource::make($cards->get(8)),
                //    TrainigProgramCardResource::make($cards->get(9)),
                //   TrainigProgramCardResource::make($cards->get(10)),

             ],
         ];
    }
}
