<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCardRequest extends FormRequest
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
            'cards' => ['required', 'array', 'min:1', 'max:1'], // ⬅️ تعديل هنا
            'cards.*.position' => ['required', 'integer', 'in:1,2,3,4', 'distinct'],
            'cards.*.description_ar' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'cards.*.description_en' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'cards.*.icon' => ['required', 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:600'],
        ];
    }
    public function messages(): array
    {
        return app()->getLocale() === 'ar'
            ? [
                'cards.required' => 'يجب إدخال بيانات البطاقات.',
                'cards.array' => 'يجب أن تكون البطاقات في شكل قائمة.',
                'cards.min' => 'يجب إدخال بيانات بطاقة واحدة فقط في كل مرة للتعديل.',
                'cards.max' => 'يجب إدخال بيانات بطاقة واحدة فقط في كل مرة للتعديل.',

                'cards.*.position.required' => 'يجب تحديد ترتيب البطاقة.',
                'cards.*.position.integer' => 'يجب أن يكون ترتيب البطاقة رقماً.',
                'cards.*.position.in' => 'ترتيب البطاقة يجب أن يكون 1 أو 2 أو 3 أو 4 فقط.',
                'cards.*.position.distinct' => 'لا يمكن تكرار نفس ترتيب البطاقة أكثر من مرة.',

                'cards.*.description_ar.required' => 'الوصف العربي مطلوب.',
                'cards.*.description_en.required' => 'الوصف الإنجليزي مطلوب.',
                'cards.*.icon.required' => 'الأيقونة مطلوبة.',
                'cards.*.icon.image' => 'الملف يجب أن يكون صورة.',
                'cards.*.icon.mimes' => 'نوع الصورة غير مدعوم.',
                'cards.*.icon.max' => 'حجم الصورة يجب ألا يتجاوز 600 كيلوبايت.',
            ]
            : [
                'cards.required' => 'Cards data is required.',
                'cards.array' => 'Cards must be an array.',
                'cards.min' => 'Exactly one card must be provided.',
                'cards.max' => 'Exactly one card must be provided.',

                'cards.*.position.required' => 'Card position is required.',
                'cards.*.position.integer' => 'Card position must be a number.',
                'cards.*.position.in' => 'Position must be one of: 1, 2, 3, or 4 .',
                'cards.*.position.distinct' => 'Duplicate card positions are not allowed.',

                'cards.*.description_ar.required' => 'Arabic description is required.',
                'cards.*.description_en.required' => 'English description is required.',
                'cards.*.icon.required' => 'Card icon is required.',
                'cards.*.icon.image' => 'The file must be an image.',
                'cards.*.icon.mimes' => 'Unsupported image type.',
                'cards.*.icon.max' => 'Image must not exceed 600 KB.',
            ];
    }
    public function attributes(): array
    {
        return [
            'cards' => __('cards'),
            'cards.*.position' => __('card position'),
            'cards.*.description_ar' => __('card description (ar)'),
            'cards.*.description_en' => __('card description (en)'),
            'cards.*.icon' => __('card icon'),
        ];
    }
}
