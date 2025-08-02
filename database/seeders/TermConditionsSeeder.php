<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TermConditionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\TermsAndConditions::create([
            'title_ar' => 'الشروط والأحكام',
            'title_en' => 'Terms and Conditions',
            'content_ar' => 'محتوى الشروط والأحكام باللغة العربية.',
            'content_en' => 'Content of the terms and conditions in English.',
        ]);
    }
}
