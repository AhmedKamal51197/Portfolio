<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MailRequest;
use App\Http\Resources\MailResource;
use App\Models\Mail;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class MailController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    public function index()
    {
        $mails = Mail::paginate(10);
        if ($mails->isEmpty()) {
            return $this->success(__('No data found'), data: []);
        }
        return $this->success(__('success'), data:MailResource::collection( $mails));
    }

    public function store(MailRequest $request)
    {
        $data = $request->validated();
        try {
            $mail = Mail::create($data);
            return $this->success(__('The mail was sent successfully.'), data: new MailResource($mail), status: 201);
        } catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
    }

    public function destroy( $id)
    {
        try {
            if (!is_numeric($id)) {
                return $this->failure(__('No data found'), 404);
            }
            $mail = Mail::findOrFail($id);
            $mail->delete();
            return $this->success(__('The mail was deleted successfully.'));
        }catch (ModelNotFoundException $th)
        {
            return $this->failure(__('No data found'), 404);
        }
         catch (\Exception $e) {
            return $this->failure(__('An error occurred while processing your request, please try again'), 500);
        }
       
    }
}
