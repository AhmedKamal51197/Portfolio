<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSocialMediaRequest extends FormRequest
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
            'name_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'name_en' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'link' => ['required', 'url'],
            'icon' => [ 'image', 'mimes:jpg,jpeg,png,gif,webp', 'max:2048'], // 2MB max size
            'status' => ['required','integer', 'in:0,1'], // Assuming status is a boolean field
        ];
    }
}
