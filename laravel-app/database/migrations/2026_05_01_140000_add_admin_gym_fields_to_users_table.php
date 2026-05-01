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
        Schema::table('users', function (Blueprint $table) {
            $table->string('gym_name')->nullable()->after('coach_gym_locations');
            $table->time('gym_open_time')->nullable()->after('gym_name');
            $table->time('gym_close_time')->nullable()->after('gym_open_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['gym_name', 'gym_open_time', 'gym_close_time']);
        });
    }
};
