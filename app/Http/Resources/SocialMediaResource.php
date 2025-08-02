<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SocialMediaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'facebook_link' => $this->facebook_link,
            'instagram_link'=> $this->instagram_link,
            'whatsApp_link' => $this->whatsApp_link,
            'telegram_link' => $this->telegram_link,
            'tictok_link' => $this->tictok_link,
            'youtube_link' => $this->youtube_link,
            'mail_link' => $this->mail_link,
        ];
    }
}
