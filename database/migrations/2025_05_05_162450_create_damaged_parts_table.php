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
        Schema::create('damaged_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('car_id')->constrained()->onDelete('cascade');
            $table->string('part_name');
            $table->string('part_location'); // e.g., front, rear, driver side, passenger side
            $table->text('damage_description');
            $table->decimal('estimated_repair_cost', 10, 2);
            $table->boolean('needs_replacement');
            $table->string('image_path')->nullable();
            $table->boolean('is_repaired')->default(false);
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
        Schema::dropIfExists('damaged_parts');
    }
};
