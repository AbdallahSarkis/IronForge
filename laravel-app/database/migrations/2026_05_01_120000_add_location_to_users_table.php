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
            $table->string('location_address')->nullable()->after('date_of_birth');
            $table->decimal('location_latitude', 10, 7)->nullable()->after('location_address');
            $table->decimal('location_longitude', 10, 7)->nullable()->after('location_latitude');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['location_address', 'location_latitude', 'location_longitude']);
        });
    }
};
