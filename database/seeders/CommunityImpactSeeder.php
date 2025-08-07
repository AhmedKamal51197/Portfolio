<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommunityImpactSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $communityImpact = \App\Models\CommunityImpact::create([
            'title_ar' => 'أثر المجتمع',
            'title_en' => 'Community Impact',
        ]);
        // Adding images
        $communityImpact->images()->createMany([
            [
                'position' => 0,
                'image' => 'image1.jpg',
            ],
            [
                'position' => 1,
                'image' => 'image2.jpg',
            ],
            [
                'position' => 2,
                'image' => 'image3.jpg',
            ],
        ]);

        $communityImpact->cards()->createMany([
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
