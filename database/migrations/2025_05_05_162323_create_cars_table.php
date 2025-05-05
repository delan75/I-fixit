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
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('make');
            $table->string('model');
            $table->integer('year');
            $table->string('vin')->nullable();
            $table->string('registration_number')->nullable();
            $table->string('color')->nullable();
            $table->string('body_type');
            $table->string('engine_size')->nullable();
            $table->string('fuel_type');
            $table->string('transmission');
            $table->integer('mileage');
            $table->json('features')->nullable(); // For special features like sunroof, custom rims, etc.
            $table->date('purchase_date');
            $table->decimal('purchase_price', 10, 2);
            $table->string('auction_house')->nullable();
            $table->string('auction_lot_number')->nullable();
            $table->text('damage_description');
            $table->enum('damage_severity', ['light', 'moderate', 'severe']);
            $table->enum('operational_status', ['running', 'non-running']);
            $table->enum('current_phase', ['bidding', 'fixing', 'dealership', 'sold']);
            $table->date('repair_start_date')->nullable();
            $table->date('repair_end_date')->nullable();
            $table->date('dealership_date')->nullable();
            $table->date('sold_date')->nullable();
            $table->decimal('transportation_cost', 10, 2)->default(0);
            $table->decimal('registration_papers_cost', 10, 2)->default(0);
            $table->decimal('number_plates_cost', 10, 2)->default(0);
            $table->decimal('dealership_discount', 10, 2)->default(0);
            $table->decimal('other_costs', 10, 2)->default(0);
            $table->text('other_costs_description')->nullable();
            $table->decimal('estimated_repair_cost', 10, 2)->default(0);
            $table->decimal('estimated_market_value', 10, 2)->nullable();
            $table->text('notes')->nullable();
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
