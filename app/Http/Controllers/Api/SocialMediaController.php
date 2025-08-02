<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function index()
    {
        $socialMedia = \App\Models\SocialMedia::all();

        if ($socialMedia->isEmpty()) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: \App\Http\Resources\SocialMediaResource::collection($socialMedia));
    }
    public function update(SocialMediaRequest $request)
    {
        $data = $request->validated();

        try {
            $socialMedia = \App\Models\SocialMedia::first();
            if (!$socialMedia) {
                return $this->failure(__('No data found'), 404);
            }
            $socialMedia->update($data);
            return $this->success(__('Social media links updated successfully'));
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }

    }
}
