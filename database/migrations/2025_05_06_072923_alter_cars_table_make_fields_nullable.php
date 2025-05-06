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
            $table->decimal('purchase_price', 10, 2)->nullable()->change();
            $table->string('auction_house')->nullable()->change();
            $table->string('auction_lot_number')->nullable()->change();
            $table->text('damage_description')->nullable()->change();
            $table->enum('damage_severity', ['light', 'moderate', 'severe'])->nullable()->change();
            $table->enum('operational_status', ['running', 'non-running'])->nullable()->change();
            $table->enum('current_phase', ['bidding', 'fixing', 'dealership', 'sold'])->nullable()->change();
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
