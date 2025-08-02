<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
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
            'client_name' => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'client_email' => ['required', 'email', 'max:255',],
            'client_phone' => ['required', 'string', 'max:20'],
            'client_country' => ['required', 'string', 'max:100', new NotNumbersOnly()],
        ];
    }
}
