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
        Schema::create('exercises', function (Blueprint $table) {
              $table->id();
              $table->foreignId('workout_id')->constrained()->cascadeOnDelete();
              $table->string('name');
              $table->unsignedTinyInteger('sets')->default(1);
              $table->unsignedSmallInteger('reps')->default(1);
              $table->string('intensity')->nullable();
              $table->string('muscles')->nullable();
              $table->text('description')->nullable();
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercises');
    }
};
