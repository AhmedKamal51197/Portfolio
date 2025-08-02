<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TermsConditionsRequest;
use App\Http\Resources\TermsConditionsResource;
use App\Models\TermsAndConditions;
use Illuminate\Http\Request;

class TermsConditionsController extends Controller
{
    public function index()
    {
        $termsConditions = TermsAndConditions::first();
        if (!$termsConditions) {
            return $this->failure(__('No data found'), 404);
        }
        return $this->success(__('success'), data: new TermsConditionsResource($termsConditions));
    }
    public function update(TermsConditionsRequest $request)
    {
        $data = $request->validated();
        try {
            $termsConditions = TermsAndConditions::first();
            if (!$termsConditions) {
                return $this->failure(__('No data found'), 404);
            }
            $termsConditions->update($data);
            return $this->success(__('Terms and Conditions updated successfully'));
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
}
