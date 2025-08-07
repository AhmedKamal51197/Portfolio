<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TrainigProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
     
        $trainigProgram = \App\Models\TrainingProgram::create([
            'title_ar' => 'برنامج التدريب',
            'title_en' => 'Training Program',
            'description_ar' => 'وصف برنامج التدريب باللغة العربية.',
            'description_en' => 'Description of the training program in English.',
        ]);

        $trainigProgram->cards()->createMany([
            [
                'position' => 1,
                'description_ar' => 'وصف البطاقة 1 باللغة العربية.',
                'description_en' => 'Description of Card 1 in English.',
                'icon' => 'icon1.png',
            ],
            [
                'position' => 2,
                'description_ar' => 'وصف البطاقة 2 باللغة العربية.',
                'description_en' => 'Description of Card 2 in English.',
                'icon' => 'icon2.png',
            ],
            [
                'position' => 3,
                'description_ar' => 'وصف البطاقة 3 باللغة العربية.',
                'description_en' => 'Description of Card 3 in English.',
                'icon' => 'icon3.png',
            ],
            [
                'position' => 4,
                'description_ar' => 'وصف البطاقة 4 باللغة العربية.',
                'description_en' => 'Description of Card 4 in English.',
                'icon' => 'icon4.png',
            ],
            [
                'position' => 5,
                'description_ar' => 'وصف البطاقة 5 باللغة العربية.',
                'description_en' => 'Description of Card 5 in English.',
                'icon' => 'icon5.png',
            ],
            [
                'position' => 6,
                'description_ar' => 'وصف البطاقة 6 باللغة العربية.',
                'description_en' => 'Description of Card 6 in English.',
                'icon' => 'icon6.png',
            ],
            [
                'position' => 7,
                'description_ar' => 'وصف البطاقة 7 باللغة العربية.',
                'description_en' => 'Description of Card 7 in English.',
                'icon' => 'icon7.png',
            ],
            

        ]);
    }
}
