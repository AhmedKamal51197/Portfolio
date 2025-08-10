<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class MyVisionMissionRequest extends FormRequest
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
            'title_ar' => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'title_en' => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'description_ar' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'description_en' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'type' => ['required', 'in:vision,mission'], // Ensure type is either 'vision' or 'mission'
            'icon' => [ 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:600'], // 600KB max size
        ];
    }
}
