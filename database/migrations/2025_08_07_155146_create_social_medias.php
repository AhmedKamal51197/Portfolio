<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('social_medias', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar')->comment('Name of the social media platform');
            $table->string('name_en')->comment('Name of the social media platform in English');
            $table->string('link')->nullable()->comment('Link to the social media platform');
            $table->string('icon')->nullable()->comment('Icon of the social media platform');
            $table->integer('status')->default(1)->comment('Status of the social media platform, 1 for active, 0 for inactive');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('social_medias');
    }
};
