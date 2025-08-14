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
        Schema::create('instegram_broadcasts', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar')->nullable();
            $table->string('title_en')->nullable();
            $table->string('all_broadcast_link')->nullable();
            $table->string('banner_title_ar')->nullable();
            $table->string('banner_title_en')->nullable();
            $table->text('banner_description_ar')->nullable();
            $table->text('banner_description_en')->nullable();
            $table->string('broadcast_link')->nullable();
            $table->string('image')->nullable(); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('instegram_broadcasts');
    }
};
