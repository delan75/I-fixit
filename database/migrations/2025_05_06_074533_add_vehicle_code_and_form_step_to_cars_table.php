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
            // Check if form_step column doesn't exist before adding it
            if (!Schema::hasColumn('cars', 'form_step')) {
                $table->integer('form_step')->default(1)->after('form_completed');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            // Only drop form_step
            $table->dropColumn('form_step');
        });
    }
};
