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
            'name' => 'WhatsApp',
            'link' => 'https://www.whatsapp.com',
        ]);
        \App\Models\SocialMedia::create([
            'name' => 'Facebook',
            'link' => 'https://www.facebook.com',
        ]);

    

        \App\Models\SocialMedia::create([
            'name' => 'Instagram',
            'link' => 'https://www.instagram.com',
        ]);

        \App\Models\SocialMedia::create([
            'name' => 'Telegram',
            'link' => 'https://www.telegram.com',
        ]);
        \App\Models\SocialMedia::create([
            'name' => 'LinkedIn',
            'link' => 'https://www.linkedin.com',
        ]);
         \App\Models\SocialMedia::create([
            'name' => 'YouTube',
            'link' => 'https://www.youtube.com',
        ]);
        \App\Models\SocialMedia::create([
            'name' => 'TikTok',
            'link' => 'https://www.tiktok.com',
        ]);
        \App\Models\SocialMedia::create([
            'name' => 'email',
            'link' => 'https://www.gmail.com',
        ]);




    }
}
