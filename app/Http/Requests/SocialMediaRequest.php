<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class SocialMediaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'facebook_link' => [ 'url', 'max:255'],
            'instagram_link'=> [ 'url', 'max:255'],
            'whatsApp_link' => [ 'url', 'max:255'],
            'telegram_link' => [ 'url', 'max:255'],
            'tictok_link' => [ 'url', 'max:255'],
            'youtube_link' => [ 'url', 'max:255'],
            'mail_link' => [ 'url', 'max:255'],
        ];
    }
}
