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
        Schema::create('coaches', function (Blueprint $table) {
              $table->id();
              $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
              $table->string('name');
              $table->string('specialty')->nullable();
              $table->decimal('rating', 3, 1)->default(5.0);
              $table->unsignedInteger('sessions')->default(0);
              $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coaches');
    }
};
