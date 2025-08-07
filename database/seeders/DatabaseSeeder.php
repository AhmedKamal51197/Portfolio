<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\HeroSection;
use App\Models\PrivacyPolicy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        $this->call([
            // HeroSectionSeeder::class,
            // MyVisionSeeder::class,
            // MyMissionSeeder::class,
            // ProfessionalAppreciationSeeder::class,
            // AdoptedMethodologiesSeeder::class,
            // TrainigProgramSeeder::class,
            // CommunityImpactSeeder::class,
            // EvaluationSeeder::class,
            // EvaluationWithoutVideoSeeder::class,
            // InstegramBannerSeeder::class,
            // InstegramBroadCastsSeeder::class,
            // CurrentProjectSeeder::class,
            // MailSeeder::class,
            // PrivacyPolicySeeder::class,
            // TermConditionsSeeder::class,
            SocialMediasSeeder::class,

        ]);
    }
}
