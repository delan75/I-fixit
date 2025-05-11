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
        Schema::create('user_preferences', function (Blueprint $table) {
            $table->id();
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->json('preferred_makes')->nullable();
            $table->json('preferred_models')->nullable();
            $table->integer('min_year')->nullable();
            $table->integer('max_year')->nullable();
            $table->decimal('min_profit', 10, 2)->nullable();
            $table->decimal('max_investment', 10, 2)->nullable();
            $table->boolean('notification_email')->default(true);
            $table->boolean('notification_sms')->default(false);
            $table->boolean('notification_app')->default(true);
            $table->boolean('notification_repair_phase')->default(true);
            $table->boolean('notification_dealership_phase')->default(true);
            $table->boolean('notification_budget_exceeded')->default(true);
            $table->boolean('notification_opportunity')->default(true);
            $table->integer('repair_phase_days_threshold')->default(30);
            $table->integer('dealership_phase_days_threshold')->default(30);
            $table->integer('budget_exceeded_percentage')->default(10);
            $table->timestamps();

            // Add index for better performance
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_preferences');
    }
};
