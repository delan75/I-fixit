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
        Schema::create('painting', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->enum('painting_type', ['full', 'partial']);
            $table->text('areas_covered')->nullable();
            $table->string('provider_name');
            $table->string('provider_contact')->nullable();
            $table->decimal('material_cost', 10, 2)->nullable();
            $table->decimal('labor_cost', 10, 2)->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->date('start_date');
            $table->date('completion_date')->nullable();
            $table->timestamps();

            // Add index for better performance
            $table->index('car_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('painting');
    }
};
