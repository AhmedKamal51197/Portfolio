<?php

namespace App\Http\Requests;

use App\Rules\NotNumbersOnly;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCommunityImpactRequest extends FormRequest
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
        $imageRules = [ 'image', 'mimes:jpeg,png,jpg,gif,svg,webp', 'max:600'];

        return [
            'title_ar' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'title_en' => ['required', 'string', 'max:255', new NotNumbersOnly()],
            'image_array' => ['required', 'array', 'min:1', 'max:4'],
            'image_array.*' => $imageRules,
            'cards' => ['required', 'array', 'min:4', 'max:4'],
            'cards.*.position' => ['required', 'integer', 'in:1,2,3,4', 'distinct'],
            'cards.*.description_ar' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'cards.*.description_en' => ['required', 'string', 'max:1000', new NotNumbersOnly()],
            'cards.*.icon' => $imageRules,
        ];
    }

    public function messages(): array
    {
        return app()->getLocale() === 'ar'
            ? [
                // Cards
                'cards.required' => 'يجب إدخال بيانات البطاقات.',
                'cards.array' => 'يجب أن تكون البطاقات في شكل قائمة.',
                'cards.min' => 'يجب إدخال أربع بطاقات بالضبط.',
                'cards.max' => 'يجب إدخال أربع بطاقات بالضبط.',

                'cards.*.position.required' => 'يجب تحديد ترتيب البطاقة.',
                'cards.*.position.integer' => 'يجب أن يكون ترتيب البطاقة رقماً.',
                'cards.*.position.in' => 'ترتيب البطاقة يجب أن يكون 1 أو 2 أو 3 أو 4 فقط.',
                'cards.*.position.distinct' => 'لا يمكن تكرار نفس ترتيب البطاقة أكثر من مرة.',

                'cards.*.description_ar.required' => 'الوصف العربي مطلوب.',
                'cards.*.description_en.required' => 'الوصف الإنجليزي مطلوب.',
                // 'cards.*.icon.required' => 'الأيقونة مطلوبة.',
                'cards.*.icon.image' => 'الملف يجب أن يكون صورة.',
                'cards.*.icon.mimes' => 'نوع الصورة غير مدعوم.',
                'cards.*.icon.max' => 'حجم الصورة يجب ألا يتجاوز 600 كيلوبايت.',

                // Images
                // 'image_array.required' => 'الصور مطلوبة.',
                'image_array.array' => 'يجب أن تكون الصور في شكل قائمة.',
                'image_array.min' => 'يجب إدخال صورة واحدة على الأقل.',
                'image_array.max' => 'الحد الأقصى لعدد الصور هو 4.',
                'image_array.*.required' => 'يجب رفع كل صورة.',
                'image_array.*.image' => 'يجب أن تكون الصورة من نوع صورة.',
                'image_array.*.mimes' => 'نوع الصورة غير مدعوم.',
                'image_array.*.max' => 'حجم الصورة يجب ألا يتجاوز 600 كيلوبايت.',
            ]
            : [
                // Cards
                'cards.required' => 'Cards data is required.',
                'cards.array' => 'Cards must be an array.',
                'cards.min' => 'Exactly four cards must be provided.',
                'cards.max' => 'Exactly four cards must be provided.',

                'cards.*.position.required' => 'Card position is required.',
                'cards.*.position.integer' => 'Card position must be a number.',
                'cards.*.position.in' => 'Position must be one of: 1, 2, 3, or 4.',
                'cards.*.position.distinct' => 'Duplicate card positions are not allowed.',

                'cards.*.description_ar.required' => 'Arabic description is required.',
                'cards.*.description_en.required' => 'English description is required.',
                // 'cards.*.icon.required' => 'Card icon is required.',
                'cards.*.icon.image' => 'The file must be an image.',
                'cards.*.icon.mimes' => 'Unsupported image type.',
                'cards.*.icon.max' => 'Image must not exceed 600 KB.',

                // Images
                // 'image_array.required' => 'Images are required.',
                'image_array.array' => 'Images must be an array.',
                'image_array.min' => 'At least one image must be provided.',
                'image_array.max' => 'A maximum of 4 images are allowed.',
                'image_array.*.required' => 'Each image is required.',
                'image_array.*.image' => 'Each file must be an image.',
                'image_array.*.mimes' => 'Unsupported image type.',
                'image_array.*.max' => 'Image must not exceed 600 KB.',
            ];
    }

    public function attributes(): array
    {
        return [
            'title_ar' => __('Arabic title'),
            'title_en' => __('English title'),
            'image_array' => __('images'),
            'image_array.*' => __('image'),
            'cards' => __('cards'),
            'cards.*.position' => __('card position'),
            'cards.*.description_ar' => __('card description (ar)'),
            'cards.*.description_en' => __('card description (en)'),
            'cards.*.icon' => __('card icon'),
        ];
    }
}
