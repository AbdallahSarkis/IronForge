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
        Schema::create('nutrition_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->foreignId('nutrition_specialist_user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->unsignedInteger('target_calories')->default(2200);
            $table->unsignedInteger('max_calories')->default(2500);
            $table->unsignedInteger('target_carbs')->default(250);
            $table->unsignedInteger('max_carbs')->default(300);
            $table->unsignedInteger('target_protein')->default(150);
            $table->unsignedInteger('max_protein')->default(190);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrition_profiles');
    }
};
