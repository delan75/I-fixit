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
        Schema::table('cars', function (Blueprint $table) {
            // Check if columns don't exist before adding them
            if (!Schema::hasColumn('cars', 'vehicle_code')) {
                $table->enum('vehicle_code', ['code_2', 'code_3', 'code_4'])->nullable()->after('operational_status');
            }

            // These columns are already added in other migrations, so we'll skip them
            // if (!Schema::hasColumn('cars', 'form_completed')) {
            //     $table->boolean('form_completed')->default(false)->after('notes');
            // }
            // if (!Schema::hasColumn('cars', 'form_step')) {
            //     $table->integer('form_step')->default(1)->after('form_completed');
            // }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Only drop the vehicle_code column
            if (Schema::hasColumn('cars', 'vehicle_code')) {
                $table->dropColumn('vehicle_code');
            }
            // We don't drop form_completed and form_step as they're managed by other migrations
        });
    }
};
