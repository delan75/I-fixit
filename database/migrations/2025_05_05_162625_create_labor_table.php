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
        Schema::create('labor', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('service_type');
            $table->text('description');
            $table->string('provider_name');
            $table->string('provider_contact')->nullable();
            $table->decimal('hours', 8, 2)->nullable();
            $table->decimal('hourly_rate', 10, 2)->nullable();
            $table->decimal('total_cost', 10, 2);
            $table->date('service_date');
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
        Schema::dropIfExists('labor');
    }
};
