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
        Schema::table('cars', function (Blueprint $table) {
            // Add finance tracking fields
            $table->enum('purchase_finance_type', ['cash', 'finance'])->default('cash')->after('purchase_price');
            $table->string('finance_institution')->nullable()->after('purchase_finance_type');
            $table->decimal('finance_amount', 12, 2)->nullable()->after('finance_institution');
            $table->decimal('finance_interest_rate', 5, 2)->nullable()->after('finance_amount');
            $table->integer('finance_term_months')->nullable()->after('finance_interest_rate');
            $table->decimal('monthly_payment', 10, 2)->nullable()->after('finance_term_months');
            $table->date('finance_start_date')->nullable()->after('monthly_payment');
            $table->date('finance_end_date')->nullable()->after('finance_start_date');
            $table->text('finance_notes')->nullable()->after('finance_end_date');

            // Add location tracking fields
            $table->string('current_location')->nullable()->after('finance_notes');
            $table->string('previous_location')->nullable()->after('current_location');
            $table->date('location_changed_date')->nullable()->after('previous_location');
            $table->text('location_notes')->nullable()->after('location_changed_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cars', function (Blueprint $table) {
            $table->dropColumn([
                'purchase_finance_type',
                'finance_institution',
                'finance_amount',
                'finance_interest_rate',
                'finance_term_months',
                'monthly_payment',
                'finance_start_date',
                'finance_end_date',
                'finance_notes',
                'current_location',
                'previous_location',
                'location_changed_date',
                'location_notes'
            ]);
        });
    }
};
