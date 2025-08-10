<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class TrainingProgramRequest extends FormRequest
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
            'title_ar' => [ 'string', 'max:255', new NotNumbersOnly()],
            'title_en' => [ 'string', 'max:255', new NotNumbersOnly()],
            'description_ar' => [ 'string', 'max:1000', new NotNumbersOnly()],
            'description_en' => [ 'string', 'max:1000', new NotNumbersOnly()],
    
            'cards' => [ 'array', 'min:1', 'max:10'], // ⬅️ تعديل هنا
    
            'cards.*.position' => ['required', 'integer' , 'distinct'],
            'cards.*.description_ar' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'cards.*.description_en' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'cards.*.icon' => [ 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:600'],
        ];
    }
    public function messages(): array
    {
        return app()->getLocale() === 'ar'
            ? [
                'cards.min' => 'يجب إدخال بطاقة واحدة علي الاقل.',
                'cards.required' => 'يجب إدخال بيانات بطاقة واحدة علي الاقل.',
                'cards.array' => 'يجب أن تكون البطاقات في شكل قائمة.',
                'cards.max' => 'يجب إدخال عشر بطاقات كحد أقصي.',

                'cards.*.position.required' => 'يجب تحديد ترتيب البطاقة.',
                'cards.*.position.integer' => 'يجب أن يكون ترتيب البطاقة رقماً.',
                'cards.*.position.in' => 'ترتيب البطاقة يجب أن يكون 1 أو 2 أو 3 أو  4 أو 5 أو 6 أو 7 أو 8 أو 9 أو 10 فقط.',
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
                'cards.min' => 'Exactly one card at least must be provided.',
                'cards.max' => 'Exactly ten cards must be provided.',

                'cards.*.position.required' => 'Card position is required.',
                'cards.*.position.integer' => 'Card position must be a number.',
                'cards.*.position.in' => 'Position must be one of: 1, 2, 3, 4, 5, 6, 7, 8, 9, or 10 .',
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
            'title_ar' => __('Arabic title'),
            'title_en' => __('English title'),
            'description_ar' => __('Arabic description'),
            'description_en' => __('English description'),
            'cards' => __('cards'),
            'cards.*.position' => __('card position'),
            'cards.*.description_ar' => __('card description (ar)'),
            'cards.*.description_en' => __('card description (en)'),
            'cards.*.icon' => __('card icon'),
        ];
    }
}
