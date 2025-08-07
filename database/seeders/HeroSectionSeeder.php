<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HeroSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\HeroSection::create([
            'title_ar' => 'مرحبا بكم في موقعنا',
            'title_en' => 'Welcome to Our Website',
            'description_ar' => 'نحن نقدم أفضل الخدمات',
            'description_en' => 'We Offer the Best Services',
            'image' => 'hero_image.jpg',
           
        ]);
    }
}
