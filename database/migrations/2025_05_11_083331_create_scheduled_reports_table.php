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
        Schema::create('scheduled_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_type_id')->constrained()->onDelete('cascade');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->string('frequency'); // daily, weekly, monthly
            $table->json('filters')->nullable();
            $table->time('time')->nullable(); // Time of day to generate
            $table->string('day_of_week')->nullable(); // For weekly reports
            $table->unsignedTinyInteger('day_of_month')->nullable(); // For monthly reports
            $table->string('recipients')->nullable(); // Comma-separated list of email addresses
            $table->string('export_format')->default('pdf'); // pdf, xlsx, csv
            $table->boolean('is_active')->default(true);
            $table->timestamp('last_run_at')->nullable();
            $table->timestamp('next_run_at')->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index('report_type_id');
            $table->index('user_id');
            $table->index('frequency');
            $table->index('is_active');
            $table->index('next_run_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scheduled_reports');
    }
};
