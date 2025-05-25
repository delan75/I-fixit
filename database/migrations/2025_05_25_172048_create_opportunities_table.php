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
        Schema::create('opportunities', function (Blueprint $table) {
            $table->id();
            $table->integer('api_opportunity_id')->unique(); // ID from Django API

            // Basic vehicle information
            $table->string('source'); // Auction site name
            $table->string('listing_url');
            $table->string('make');
            $table->string('model');
            $table->integer('year');

            // Auction details
            $table->datetime('auction_end_date')->nullable();
            $table->decimal('current_bid', 12, 2)->nullable();
            $table->string('lot_number')->nullable();
            $table->string('auction_location')->nullable();

            // Vehicle details
            $table->string('stock_number')->nullable();
            $table->string('odometer')->nullable();
            $table->string('vehicle_code')->nullable();
            $table->boolean('has_keys')->default(false);
            $table->boolean('has_spare_key')->default(false);
            $table->boolean('vehicle_starts')->default(false);
            $table->boolean('has_battery')->default(false);
            $table->boolean('has_spare_wheel')->default(false);
            $table->string('color')->nullable();
            $table->date('auction_date')->nullable();

            // Assessment details
            $table->text('damage_description')->nullable();
            $table->json('image_urls')->nullable();
            $table->decimal('estimated_repair_cost', 12, 2)->nullable();
            $table->decimal('estimated_market_value', 12, 2)->nullable();
            $table->decimal('potential_profit', 12, 2)->nullable();

            // Opportunity tracking
            $table->integer('opportunity_score');
            $table->enum('status', ['new', 'viewed', 'interested', 'bidding', 'won', 'lost', 'expired'])->default('new');

            // User interaction tracking
            $table->boolean('is_favorite')->default(false);
            $table->text('user_notes')->nullable();
            $table->datetime('last_viewed_at')->nullable();
            $table->uuid('viewed_by')->nullable();
            $table->foreign('viewed_by')->references('id')->on('users')->nullOnDelete();

            $table->timestamps();

            // Indexes
            $table->index(['make', 'model', 'year']);
            $table->index('opportunity_score');
            $table->index('status');
            $table->index('auction_end_date');
            $table->index('source');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('opportunities');
    }
};
