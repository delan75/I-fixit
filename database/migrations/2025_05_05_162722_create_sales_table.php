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
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->date('listing_date');
            $table->decimal('asking_price', 10, 2);
            $table->string('platform'); // Dealership, online marketplace, etc.
            $table->decimal('selling_price', 10, 2)->nullable();
            $table->date('sale_date')->nullable();
            $table->string('buyer_name')->nullable();
            $table->string('buyer_contact')->nullable();
            $table->decimal('commission', 10, 2)->nullable();
            $table->decimal('fees', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            // Add index for better performance
            $table->index('car_id');

            // Add unique constraint to ensure one sale per car
            $table->unique('car_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
