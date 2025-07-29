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
        Schema::table('community_impact_images', function (Blueprint $table) {
            $table->unsignedTinyInteger('position')->nullable()->after('image');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('community_impact_images', function (Blueprint $table) {
            //
        });
    }
};
