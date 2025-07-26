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
        Schema::create('professional_appreciation_cards', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cardable_id');
            $table->string('cardable_type');
            $table->unsignedInteger('position');
            $table->string('description_ar')->nullable();
            $table->string('description_en')->nullable();
            $table->string('icon')->nullable();

            // ✅ Unique index with a short name
            $table->unique(['cardable_id', 'cardable_type', 'position'], 'cardable_position_unique');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('professional_appreciation_cards');
    }
};
