<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FourBroadcasts extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'البث المباشر 1',
            'title_en' => 'Live Broadcast 1',
            'image' => 'four_broadcasts_1.png',
        ]);

        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'البث المباشر 2',
            'title_en' => 'Live Broadcast 2',
            'image' => 'four_broadcasts_2.png',
        ]);

        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'البث المباشر 3',
            'title_en' => 'Live Broadcast 3',
            'image' => 'four_broadcasts_3.jpg',
        ]);

        \App\Models\InstegramBroadcast::create([
            'title_ar' => 'البث المباشر 4',
            'title_en' => 'Live Broadcast 4',
            'image' => 'four_broadcasts_4.png',
        ]);
    }
}
