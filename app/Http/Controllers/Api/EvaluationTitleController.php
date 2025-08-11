<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationTitle;
use App\Http\Requests\EvaluationTitleRequest;
use Illuminate\Http\Request;

class EvaluationTitleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $title = \App\Models\EvaluationTitle::first();
        if (!$title) {
            return $this->failure(__('No data found'), 404);
        }
        $data = [
            'title_ar' => $title->title_ar,
            'title_en' => $title->title_en,
        ];
        return $this->success(message: __('success'), data: $data, status: 200);
    }
    public function update(EvaluationTitleRequest $request)
    {
        $data = $request->validated();

        $title = \App\Models\EvaluationTitle::first();
        if ($title) {
            $title->update($request->all());
        } else {
            $title = \App\Models\EvaluationTitle::create($request->all());
        }
        if (!$title) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
        $data = [
            'title_ar' => $title->title_ar,
            'title_en' => $title->title_en,
        ];
        return $this->success(message: __('success'), data: $data, status: 200);
    }
}
