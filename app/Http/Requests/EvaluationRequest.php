<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
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
            'client_name_en' => ['required', 'string', 'max:255',new NotNumbersOnly()],
            'client_name_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:600'],
            'video' => ['required','file','mimes:mp4,mov,avi,wmv','max:20240'], // 10MB max
            
        ];
    }
}
