<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SocialMedia::create([
            'facebook_link' => 'https://www.facebook.com',
            'instagram_link' => 'https://www.instagram.com',
            'whatsApp_link' => 'https://www.whatsapp.com',
            'telegram_link' => 'https://www.telegram.com',
            'tictok_link' => 'https://www.tiktok.com',
            'youtube_link' => 'https://www.youtube.com',
            'mail_link' => 'https://www.gmail.com',
        ]);
    }
}
