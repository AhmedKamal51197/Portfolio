<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InstegramBannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create an InstegramBanner with all fields filled
        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'عنوان البانر باللغة العربية',
            'title_en' => 'Banner Title in English',
            'all_broadcast_link' => 'https://www.instagram.com/',
            'banner_title_ar' => 'عنوان البانر باللغة العربية',
            'banner_title_en' => 'Banner Title in English',
            'banner_description_ar' => 'وصف البانر باللغة العربية',
            'banner_description_en' => 'Banner Description in English',
            'broadcast_link' => 'https://www.instagram.com/',
            'image' => 'banner_image.jpg',
        ]);
    }
}
