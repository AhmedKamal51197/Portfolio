<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluationWithoutVideoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\Evaluation::create([
            'client_name_ar' => 'اسم العميل باللغة العربية',
            'client_name_en' => 'Client Name in English',
            'image' => 'evaluation3_image.jpg',
            'evaluate_ar' => 'تقييم باللغة العربية',
            'evaluate_en' => 'Evaluation in English',
        ]);
        \App\Models\Evaluation::create([
            'client_name_ar' => 'اسم عميل آخر باللغة العربية',
            'client_name_en' => 'Another Client Name in English',
            'image' => 'another_evaluation4_image.jpg',
            'evaluate_ar' => 'تقييم آخر باللغة العربية',
            'evaluate_en' => 'Another Evaluation in English',
        ]);
        
        // You can add more evaluations if needed
        // \App\Models\Evaluation::create([...]);
    }
}
