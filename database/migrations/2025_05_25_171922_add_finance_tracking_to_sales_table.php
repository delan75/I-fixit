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
        Schema::table('sales', function (Blueprint $table) {
            // Add buyer finance tracking fields
            $table->enum('buyer_finance_type', ['cash', 'finance', 'trade_in'])->default('cash')->after('notes');
            $table->string('buyer_finance_institution')->nullable()->after('buyer_finance_type');
            $table->decimal('finance_approved_amount', 12, 2)->nullable()->after('buyer_finance_institution');
            $table->decimal('deposit_amount', 10, 2)->nullable()->after('finance_approved_amount');
            $table->decimal('outstanding_balance', 10, 2)->nullable()->after('deposit_amount');
            $table->date('finance_approval_date')->nullable()->after('outstanding_balance');
            $table->date('full_payment_date')->nullable()->after('finance_approval_date');
            $table->text('finance_notes')->nullable()->after('full_payment_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn([
                'buyer_finance_type',
                'buyer_finance_institution',
                'finance_approved_amount',
                'deposit_amount',
                'outstanding_balance',
                'finance_approval_date',
                'full_payment_date',
                'finance_notes'
            ]);
        });
    }
};
