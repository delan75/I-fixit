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
        // First, drop the existing enum column
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('vehicle_code');
        });

        // Then, add it back with the correct values
        Schema::table('cars', function (Blueprint $table) {
            $table->string('vehicle_code')->nullable()->after('operational_status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // First, drop the string column
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('vehicle_code');
        });

        // Then, add back the original enum column
        Schema::table('cars', function (Blueprint $table) {
            $table->enum('vehicle_code', ['code_2', 'code_3', 'code_4'])->nullable()->after('operational_status');
        });
    }
};
