<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class InstegramBannerRequest extends FormRequest
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
            'title_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'title_en' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'all_broadcast_link' => 'required|url',
            'banner_title_ar' => 'required|string|max:255',
            'banner_title_en' => 'required|string|max:255',
            'banner_description_ar' => 'required|string|max:500',
            'banner_description_en' => 'required|string|max:500',
            'broadcast_link' => 'required|url',
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:600', // Optional image validation
        ];
    }
}
