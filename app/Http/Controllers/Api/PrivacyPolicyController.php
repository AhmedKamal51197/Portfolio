<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\PrivacyPolicyRequest;
use App\Http\Resources\PrivacyPolicyResource;
use App\Models\PrivacyPolicy;
use Illuminate\Http\Request;

class PrivacyPolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $privacyPolicy = PrivacyPolicy::first();
        
        if (!$privacyPolicy) {
            return $this->failure(__('No data found'), 404);
        }
        return $this->success(__('success'), data: new PrivacyPolicyResource($privacyPolicy));
    }
    public function update(PrivacyPolicyRequest $request)
    {
        $data = $request->validated();
        try {
            $privacyPolicy = PrivacyPolicy::first();
            if (!$privacyPolicy) {
                return $this->failure(__('No data found'), 404);
            }
            $privacyPolicy->update($data);
            return $this->success(__('Privacy policy updated successfully'));
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }
}
