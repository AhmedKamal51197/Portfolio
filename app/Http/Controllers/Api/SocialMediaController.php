<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SocialMediaRequest;
use App\Http\Requests\UpdateSocialMediaRequest;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $socialMedia = \App\Models\SocialMedia::all();

        if ($socialMedia->isEmpty()) {
            return $this->failure(__('No data found'), 404);
        }

        return $this->success(__('success'), data: \App\Http\Resources\SocialMediaResource::collection($socialMedia));
    }
    public function update(UpdateSocialMediaRequest $request, $id)
    {
        $data = $request->validated();

        try {
            $socialMedia = \App\Models\SocialMedia::findOrFail($id);
            if($request->hasFile('icon')) {
                $data['icon'] = $this->updateModelImage($socialMedia,$request->file('icon'), 'SocialMedias');
            }

            $socialMedia->update($data);
            return $this->success(__('Social media links updated successfully'));
        }catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return $this->failure(__('No data found'), 404);
        }catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }

    }
}
