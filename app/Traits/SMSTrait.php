<?php

namespace App\Traits;

use Illuminate\Support\Facades\Http;

trait SMSTrait
{
    protected function sendSMS($message)
    {
        $response = Http::get("" , [
            'id' => env('', ''),
            'sender' => "",
            'to' => $this->full_phone,
            'msg' => $message,
            'mode' => 0,
        ]);

        return $response->body();
    }
}
