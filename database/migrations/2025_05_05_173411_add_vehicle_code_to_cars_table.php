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
            $table->enum('vehicle_code', ['code_2', 'code_3', 'code_4'])->nullable()->after('operational_status');
            $table->boolean('form_completed')->default(false)->after('notes');
            $table->integer('form_step')->default(1)->after('form_completed');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn('vehicle_code');
            $table->dropColumn('form_completed');
            $table->dropColumn('form_step');
        });
    }
};
