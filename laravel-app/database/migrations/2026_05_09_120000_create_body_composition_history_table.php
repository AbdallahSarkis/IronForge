<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('body_composition_history', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->date('recorded_date');
            $table->float('weight_kg');
            $table->float('height_cm');
            $table->float('bmi');
            $table->float('body_fat_percent')->nullable();
            $table->float('muscle_mass_kg')->nullable();
            $table->float('waist_cm')->nullable();
            $table->timestamps();
            $table->unique(['user_id', 'recorded_date']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('body_composition_history');
    }
};
