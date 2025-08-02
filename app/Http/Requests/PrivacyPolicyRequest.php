<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class PrivacyPolicyRequest extends FormRequest
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
            'title_ar'=>['required', 'string', 'max:255',new NotNumbersOnly()],
            'title_en'=>['required', 'string', 'max:255',new NotNumbersOnly()],
            'content_ar'=>['required', 'string', 'max:10000', new NotNumbersOnly()],
            'content_en'=>['required', 'string', 'max:10000', new NotNumbersOnly()],
        ];
    }
}
