<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class FourBroadCastsRequest extends FormRequest
{
    use \App\Traits\ImageTrait;
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
        
        $id =request()->route('id');
        
        return [
            'title_ar' => [
                'required',
                'string',
                'max:255',
                new NotNumbersOnly(),
                Rule::unique('instegram_broadcasts', 'title_ar')->ignore($id),
            ],
            
            'title_en' => [
                'required',
                'string',
                'max:255',
                new NotNumbersOnly(),
                Rule::unique('instegram_broadcasts', 'title_en')->ignore($id),
            ],
            'broadcast_link' => 'required|url',
            
            'image' => 'mimes:jpeg,png,jpg,gif,svg,webp|max:600', // Optional image validation
            
        ];
    }
}
