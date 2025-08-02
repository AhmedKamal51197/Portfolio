<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Models\ResetPasswordToken;
use App\Models\User;
use App\Customs\Services\EmailResetAdminPasswordService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    protected $service; 
    public function __construct(EmailResetAdminPasswordService $service)
    {
        $this->service = $service;
    }
    public function login(LoginRequest $request)
    {
        // $employee = User::where('email', $request->email)->first();
        $token = auth('api')->attempt($request->validated());
        if ($token) {
            return $this->responseWithToken($token, auth('api')->user());
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => __('Email or password incorrect')
            ], 401);
        }
    }
     /**
     * get token response
     */
    public function responseWithToken($token, $user)
    {

        $customer = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
        ];
        return response()->json([
            'status' => 'success',
            'customer' =>  $customer,
            'access_token' => $token,
            'type' => 'bearer'
        ]);
    }

      /**
     * Forget Password 
     */
    public function forogtPassword(Request $request)
    {
        $vlaidatedData = $request->validate([
            'email' => ['required', 'email']
        ]);
        $user = User::where('email', $vlaidatedData['email'])->first();
        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => __('User not found')
            ], 404);
        }
        $this->service->sendResetlink($user);
        return response()->json([
            'status' => 'success',
            'message' => __('Reset Link send successfully to your email')
        ], 200);
    }
    /**
     * Check Email & Token 
     */
    public function checkResetToken(Request $request)
    {
        // $email = $request->email;
        $token = $request->token;
        // return response()->json(['aya 7aga']);
        $verifiedResult = $this->service->verifyEmail($token);
        // dd($verifiedResult);
        if ($verifiedResult instanceof ResetPasswordToken) {
            return response()->json([
                'status' => 'success',
                'message' => __('Email & token verified successfully you can now reset your password'),
                'token' => $token,
                // 'email' => $email
            ], 200);
        }
        return $verifiedResult;
    }

    /**
     * Reset password
     */
    public function resetPassword(Request $request)
    {
        $vlaidatedData = $request->validate([
            // 'email' => ['required', 'email'],
            'token' => ['required'],
            'new_password' => ['required', 'min:8', 'confirmed']
        ]);
        
        $verifiedResult = $this->service->verifyEmail( $vlaidatedData['token']);
        $email = $verifiedResult->email;
        $user = User::where('email',$email)->first();
        if (!$user) {
            return response()->json([
                'status' => 'failed',
                'message' => __('User not found')
            ], 404);
        }
        if ($verifiedResult instanceof ResetPasswordToken) {
            $user->password = Hash::make($vlaidatedData['new_password']);
            $user->save();
            return response()->json([
                'status' => 'success',
                'message' => __('Password reset Successfully')
            ], 200);
        }
        return $verifiedResult;
    }

     

      public function seeData()
      {
        return response()->json([
            'status' => 'success',
            'message' => __('User data'),
            'data' => request()->query('token')." : ".request()->query('email')
        ]);
      }

}
