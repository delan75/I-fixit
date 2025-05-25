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
        Schema::create('customer_communications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->uuid('user_id'); // Staff member who made the communication
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreignId('car_id')->nullable()->constrained()->onDelete('set null'); // Related car if applicable

            // Communication details
            $table->enum('type', ['phone', 'email', 'sms', 'in_person', 'whatsapp', 'other']);
            $table->enum('direction', ['inbound', 'outbound']);
            $table->string('subject')->nullable();
            $table->text('content');
            $table->text('outcome')->nullable(); // Result of the communication

            // Follow-up information
            $table->boolean('requires_follow_up')->default(false);
            $table->date('follow_up_date')->nullable();
            $table->text('follow_up_notes')->nullable();
            $table->boolean('follow_up_completed')->default(false);

            // Communication metadata
            $table->datetime('communication_date');
            $table->integer('duration_minutes')->nullable(); // For phone calls
            $table->json('attachments')->nullable(); // File paths or references
            $table->enum('priority', ['low', 'medium', 'high'])->default('medium');
            $table->enum('status', ['pending', 'completed', 'cancelled'])->default('completed');

            $table->timestamps();

            // Indexes
            $table->index(['customer_id', 'communication_date']);
            $table->index('type');
            $table->index('requires_follow_up');
            $table->index('follow_up_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customer_communications');
    }
};
