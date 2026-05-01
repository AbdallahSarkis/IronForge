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
        Schema::create('coach_member', function (Blueprint $table) {
              $table->id();
              $table->foreignId('coach_id')->constrained()->cascadeOnDelete();
              $table->foreignId('user_id')->constrained()->cascadeOnDelete();
              $table->text('goal')->nullable();
              $table->timestamps();
              $table->unique(['coach_id', 'user_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coach_member');
    }
};
