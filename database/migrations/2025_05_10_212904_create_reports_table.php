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
        // First, check if report_types table exists, if not create it
        if (!Schema::hasTable('report_types')) {
            Schema::create('report_types', function (Blueprint $table) {
                $table->id();
                $table->string('name');
                $table->string('slug')->unique();
                $table->string('description')->nullable();
                $table->string('icon')->nullable();
                $table->string('chart_type')->default('bar'); // bar, line, pie, etc.
                $table->boolean('is_active')->default(true);
                $table->timestamps();
            });
        }

        // Now create the reports table
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_type_id')->constrained()->onDelete('cascade');
            $table->uuid('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('title');
            $table->json('filters')->nullable();
            $table->json('data')->nullable();
            $table->string('file_path')->nullable(); // For exported reports
            $table->string('file_type')->nullable(); // PDF, Excel, CSV
            $table->timestamp('generated_at')->nullable();
            $table->timestamps();

            // Add indexes for better performance
            $table->index('report_type_id');
            $table->index('user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');

        // Don't drop the report_types table here, as it might be used by other migrations
        // The original report_types migration will handle dropping it if needed
    }
};
