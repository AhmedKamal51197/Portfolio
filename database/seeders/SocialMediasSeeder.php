<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SocialMedia::create([
            'name_en' => 'WhatsApp',
            'name_ar' => 'واتساب',
            'link' => 'https://www.whatsapp.com',
            'icon' => 'whatsapp.png',
        ]);
        \App\Models\SocialMedia::create([
            'name_en' => 'Facebook',
            'name_ar' => 'فيسبوك',
            'link' => 'https://www.facebook.com',
            'icon' => 'facebook.png',
        ]);
        

        \App\Models\SocialMedia::create([
            'name_en' => 'Instegram',
            'name_ar' => 'انستجرام',
            'link' => 'https://www.instagram.com',
            'icon' => 'instagram.png',
        ]);

        \App\Models\SocialMedia::create([
            'name_en' => 'Telegram',
            'name_ar' => 'تيليجرام',
            'link' => 'https://www.telegram.com',
            'icon' => 'telegram.png',
        ]);
        \App\Models\SocialMedia::create([
            'name_en' => 'Gmail',
            'name_ar' => 'جيميل',
            'link' => 'https://www.gmail.com',
            'icon' => 'gmail.png',
        ]);
        
        \App\Models\SocialMedia::create([
            'name_en' => 'TikTok',
            'name_ar' => 'تيك توك',
            'link' => 'https://www.tiktok.com',
            'icon' => 'tiktok.png',
        ]);
        \App\Models\SocialMedia::create([
            'name_en' => 'YouTube',
            'name_ar' => 'يوتيوب',
            'link' => 'https://www.youtube.com',
            'icon' => 'youtube.png',
        ]);




    }
}
