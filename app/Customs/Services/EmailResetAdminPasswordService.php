<?php 
namespace App\Customs\Services;

use App\Mail\ResetEmail;
use App\Models\ResetPasswordToken;
use App\Models\User;
// use App\Notifications\EmailVerificationNotification;
use Illuminate\Support\Facades\Mail;
// use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Str;

class EmailResetAdminPasswordService 
{
    /**
     * Send verification link
    */
    public function sendResetlink($user)
    {
        Mail::to($user->email)->send(new ResetEmail($user,$this->generateResetLink($user->email)));

      //  Notification::send($user, new EmailVerificationNotification($this->generateVerificationLink($user->email)));
    }
    /**
     * Resend link with token
     */
    public function resendLink($email)
    {
        $user = User::where('email',$email)->first();
        if($user)
        {
            $this->sendResetlink($user);
            return response()->json([
                'status'=>'success',
                'message'=>__('ResetPassword link sent successfully')
            ]);
        }else{
            return response()->json([
                'status'=>'failed',
                'message'=>__('User not found')
            ]);
        }
    }
 
    /**
     * Verify user Email
     */
    public function verifyEmail($token)
    {
        // $user = User::where('email',$email)->first();
        // if(!$user) return response()->json([
        //     'status'=>'failed',
        //     'message'=>__('User not found')
        // ],400);
        // else 
            $resetToken = $this->verifyToken($token);
            
            return $resetToken; 
    }
    /**
     * Verify token
     */
    public function verifyToken($token)
    {
        $token = ResetPasswordToken::where('token',$token)->first();
        if($token)
        {
            if($token->expired_at>=now())
            {
                return $token;
            }else{
                $token->delete();
                return response()->json([
                    'status'=>'failed',
                    'message'=>__('Token expired'),
                ],400);
            }
        }
        else
        {
           return response()->json([
                'status'=>'failed',
                'message'=>__('Invalid token')
            ]);
            
        }
    }   
    /**
     * Generate verification Link
     */
       public function generateResetLink($email)
       {
            $checkIfTokenExists = ResetPasswordToken::where('email',$email)->first();
            if($checkIfTokenExists) $checkIfTokenExists->delete();
            // $token = strtoupper(Str::random(4)); // يعيد أحرف عشوائية مثل: A7F2
            do {
                $token = strtoupper(Str::random(4));
            } while (ResetPasswordToken::where('token', $token)->exists());
            
            $url = config('app.url') ."/api/passwordreset?token=".$token."&email=".$email;
            // $url =   "http://localhost:3000/passwordreset?token=".$token."&email=".$email;
            $saveToken = ResetPasswordToken::create([
                "email"=>$email,
                "token"=>$token,
                "expired_at"=>now()->addMinutes(60),
            ]);
            if($saveToken)
            {

                // dd($url);
                return $url;
            }
       }

}
