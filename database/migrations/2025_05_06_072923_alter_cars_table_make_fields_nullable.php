<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Use direct SQL statements for modifying columns
        // This avoids issues with Doctrine DBAL not supporting enum types

        // Regular columns that don't use enum
        Schema::table('cars', function (Blueprint $table) {
            $table->decimal('purchase_price', 10, 2)->nullable()->change();
            $table->string('auction_house')->nullable()->change();
            $table->string('auction_lot_number')->nullable()->change();
            $table->text('damage_description')->nullable()->change();
            $table->date('repair_start_date')->nullable()->change();
            $table->date('repair_end_date')->nullable()->change();
            $table->date('dealership_date')->nullable()->change();
            $table->date('sold_date')->nullable()->change();
            $table->decimal('transportation_cost', 10, 2)->nullable()->change();
            $table->decimal('registration_papers_cost', 10, 2)->nullable()->change();
            $table->decimal('number_plates_cost', 10, 2)->nullable()->change();
            $table->decimal('dealership_discount', 10, 2)->nullable()->change();
            $table->decimal('other_costs', 10, 2)->nullable()->change();
            $table->text('other_costs_description')->nullable()->change();
            $table->decimal('estimated_repair_cost', 10, 2)->nullable()->change();
            $table->decimal('estimated_market_value', 10, 2)->nullable()->change();
            $table->text('notes')->nullable()->change();
        });

        // Use direct SQL for enum columns
        DB::statement("ALTER TABLE cars MODIFY damage_severity ENUM('light', 'moderate', 'severe') NULL");
        DB::statement("ALTER TABLE cars MODIFY operational_status ENUM('running', 'non-running') NULL");
        DB::statement("ALTER TABLE cars MODIFY current_phase ENUM('bidding', 'fixing', 'dealership', 'sold') NULL");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            //
        });
    }
};
