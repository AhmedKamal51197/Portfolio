<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CurrentProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $currentProject = \App\Models\CurrentProject::create([
            'title_ar' => 'المشروع الحالي',
            'title_en' => 'Current Project',
        ]);

        // Adding cards
        $currentProject->cards()->createMany([
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
        ]);
    }
}
