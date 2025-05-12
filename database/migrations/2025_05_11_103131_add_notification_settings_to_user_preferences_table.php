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
        Schema::table('user_preferences', function (Blueprint $table) {
            // Add notification type settings
            if (!Schema::hasColumn('user_preferences', 'notification_repair_phase')) {
                $table->boolean('notification_repair_phase')->default(true)->after('notification_app');
            }

            if (!Schema::hasColumn('user_preferences', 'notification_dealership_phase')) {
                $table->boolean('notification_dealership_phase')->default(true)->after('notification_repair_phase');
            }

            if (!Schema::hasColumn('user_preferences', 'notification_budget_exceeded')) {
                $table->boolean('notification_budget_exceeded')->default(true)->after('notification_dealership_phase');
            }

            if (!Schema::hasColumn('user_preferences', 'notification_opportunity')) {
                $table->boolean('notification_opportunity')->default(true)->after('notification_budget_exceeded');
            }

            // Add threshold settings
            if (!Schema::hasColumn('user_preferences', 'repair_phase_days_threshold')) {
                $table->integer('repair_phase_days_threshold')->default(30)->after('notification_opportunity');
            }

            if (!Schema::hasColumn('user_preferences', 'dealership_phase_days_threshold')) {
                $table->integer('dealership_phase_days_threshold')->default(30)->after('repair_phase_days_threshold');
            }

            if (!Schema::hasColumn('user_preferences', 'budget_exceeded_percentage')) {
                $table->integer('budget_exceeded_percentage')->default(10)->after('dealership_phase_days_threshold');
            }

            // Update user_id to use UUID if it's not already
            if (Schema::getColumnType('user_preferences', 'user_id') !== 'string') {
                // This is a complex operation that would require data migration
                // For now, we'll just add a note that this needs to be handled separately
                // $table->uuid('user_id')->change();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_preferences', function (Blueprint $table) {
            // Drop notification type settings
            if (Schema::hasColumn('user_preferences', 'notification_repair_phase')) {
                $table->dropColumn('notification_repair_phase');
            }

            if (Schema::hasColumn('user_preferences', 'notification_dealership_phase')) {
                $table->dropColumn('notification_dealership_phase');
            }

            if (Schema::hasColumn('user_preferences', 'notification_budget_exceeded')) {
                $table->dropColumn('notification_budget_exceeded');
            }

            if (Schema::hasColumn('user_preferences', 'notification_opportunity')) {
                $table->dropColumn('notification_opportunity');
            }

            // Drop threshold settings
            if (Schema::hasColumn('user_preferences', 'repair_phase_days_threshold')) {
                $table->dropColumn('repair_phase_days_threshold');
            }

            if (Schema::hasColumn('user_preferences', 'dealership_phase_days_threshold')) {
                $table->dropColumn('dealership_phase_days_threshold');
            }

            if (Schema::hasColumn('user_preferences', 'budget_exceeded_percentage')) {
                $table->dropColumn('budget_exceeded_percentage');
            }
        });
    }
};
