<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MyVisionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       
      
        \App\Models\MyVisionMission::create([
            'title_ar' => 'رؤيتنا',
            'title_en' => 'Our Vision',
            'description_ar' => 'نحن نهدف إلى تحقيق التميز في كل ما نقوم به.',
            'description_en' => 'We aim to achieve excellence in everything we do.',
            'icon' => 'vision_icon.png',
            'type' => 'vision',
        ]);
    }
}
