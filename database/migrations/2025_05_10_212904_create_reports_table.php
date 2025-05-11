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
    }
};
