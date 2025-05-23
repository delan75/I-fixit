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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->char('user_id', 36)->nullable();
            $table->string('activity_type');
            $table->text('description');
            $table->string('model_type')->nullable();
            $table->string('model_id', 36)->nullable(); // Support for UUIDs
            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index(['model_type', 'model_id']);
            $table->index('activity_type');
            $table->index('user_id');
            $table->index('created_at');
        });

        // Note: We're skipping the foreign key constraint for now
        // You can add it later with a separate migration if needed
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
