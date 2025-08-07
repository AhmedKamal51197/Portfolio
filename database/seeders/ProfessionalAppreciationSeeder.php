<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionalAppreciationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create a ProfessionalAppreciation with all fields filled
        $professional=\App\Models\ProfessionalAppreciationGroup::create([
            'title_ar' => 'عنوان التقدير المهني باللغة العربية',
            'title_en' => 'Professional Appreciation Title in English',
            
        ]);
        // add cards
        $professional->cards()->createMany([
            [
                'position' => 1,
                'description_ar' => 'وصف البطاقة 1 باللغة العربية.',
                'description_en' => 'Description of Card 1 in English.',
                'icon' => 'icon.png',
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
            

        ]);
    }
}
