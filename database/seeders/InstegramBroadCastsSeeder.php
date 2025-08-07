<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstegramBroadCastsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an InstegramBroadcast with all fields filled
        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'عنوان البث باللغة العربية',
            'title_en' => 'Broadcast Title in English',
            'broadcast_link' => 'https://www.instagram.com/',
            'image' => 'broadcast_image.jpg',
        ]);
        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'عنوان بث آخر باللغة العربية',
            'title_en' => 'Another Broadcast Title in English',
            'broadcast_link' => 'https://www.instagram.com/',
            'image' => 'broadcast2_image.jpg',
        ]);
        // You can add more broadcasts if needed
        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'عنوان بث آخر باللغة العربية',
            'title_en' => 'Another Broadcast Title in English',
            'broadcast_link' => 'https://www.instagram.com/',
            'image' => 'broadcast3_image.jpg',
        ]);
        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'عنوان بث آخر باللغة العربية',
            'title_en' => 'Another Broadcast Title in English',
            'broadcast_link' => 'https://www.instagram.com/',
            'image' => 'broadcast4_image.jpg',
        ]);
    }
}
