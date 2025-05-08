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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->string('vin')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('color')->nullable();
            $table->string('body_type')->nullable();
            $table->string('engine_size')->nullable();
            $table->string('fuel_type')->nullable();
            $table->string('transmission')->nullable();
            $table->integer('mileage')->nullable();
            $table->json('features')->nullable(); 
            $table->date('purchase_date')->default(DB::raw('CURRENT_DATE'))->nullable(); 
            $table->decimal('purchase_price', 10, 2)->nullable();
            $table->string('auction_house')->nullable();
            $table->string('auction_lot_number')->nullable();
            $table->text('damage_description')->nullable();
            $table->enum('damage_severity', ['light', 'moderate', 'severe'])->nullable();
            $table->enum('operational_status', ['running', 'non-running'])->nullable();
            $table->enum('current_phase', ['bidding', 'fixing', 'dealership', 'sold'])->nullable();
            $table->date('repair_start_date')->nullable();
            $table->date('repair_end_date')->nullable();
            $table->date('dealership_date')->nullable();
            $table->date('sold_date')->nullable();
            $table->decimal('transportation_cost', 10, 2)->default(0)->nullable();
            $table->decimal('registration_papers_cost', 10, 2)->default(0)->nullable();
            $table->decimal('number_plates_cost', 10, 2)->default(0)->nullable();
            $table->decimal('dealership_discount', 10, 2)->default(0)->nullable();
            $table->decimal('other_costs', 10, 2)->default(0)->nullable();
            $table->text('other_costs_description')->nullable();
            $table->decimal('estimated_repair_cost', 10, 2)->default(0)->nullable();
            $table->decimal('estimated_market_value', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->boolean('form_completed')->default(false); // Optional: track completion
            $table->timestamps();

            // Add indexes for better performance
            $table->index(['make', 'model', 'year']);
            $table->index('current_phase');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cars');
    }
};
