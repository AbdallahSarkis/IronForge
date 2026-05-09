<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('nutrition_profiles', function (Blueprint $table) {
            $table->float('height_cm')->nullable()->after('max_protein');
            $table->float('weight_kg')->nullable()->after('height_cm');
            $table->float('body_fat_percent')->nullable()->after('weight_kg');
            $table->float('muscle_mass_kg')->nullable()->after('body_fat_percent');
            $table->float('waist_cm')->nullable()->after('muscle_mass_kg');
        });
    }

    public function down(): void
    {
        Schema::table('nutrition_profiles', function (Blueprint $table) {
            $table->dropColumn(['height_cm', 'weight_kg', 'body_fat_percent', 'muscle_mass_kg', 'waist_cm']);
        });
    }
};
