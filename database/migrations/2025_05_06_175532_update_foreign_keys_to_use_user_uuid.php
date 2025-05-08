<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * This migration adds UUID columns to tables with foreign keys to users,
     * populates them with the corresponding user UUIDs, and then updates
     * the foreign key constraints to reference the UUID.
     */
    public function up(): void
    {
        // Get a mapping of user IDs to UUIDs
        $userIdToUuid = DB::table('users')
            ->select('id', 'uuid')
            ->get()
            ->pluck('uuid', 'id')
            ->toArray();

        // Update cars table
        if (Schema::hasTable('cars')) {
            // Add UUID columns
            Schema::table('cars', function (Blueprint $table) {
                if (Schema::hasColumn('cars', 'user_id')) {
                    $table->uuid('user_uuid')->nullable()->after('user_id');
                }
                if (Schema::hasColumn('cars', 'created_by')) {
                    $table->uuid('created_by_uuid')->nullable()->after('created_by');
                }
                if (Schema::hasColumn('cars', 'updated_by')) {
                    $table->uuid('updated_by_uuid')->nullable()->after('updated_by');
                }
            });

            // Populate UUID columns
            DB::table('cars')->cursor()->each(function ($car) use ($userIdToUuid) {
                $updates = [];

                if (isset($car->user_id) && isset($userIdToUuid[$car->user_id])) {
                    $updates['user_uuid'] = $userIdToUuid[$car->user_id];
                }

                if (isset($car->created_by) && isset($userIdToUuid[$car->created_by])) {
                    $updates['created_by_uuid'] = $userIdToUuid[$car->created_by];
                }

                if (isset($car->updated_by) && isset($userIdToUuid[$car->updated_by])) {
                    $updates['updated_by_uuid'] = $userIdToUuid[$car->updated_by];
                }

                if (!empty($updates)) {
                    DB::table('cars')
                        ->where('id', $car->id)
                        ->update($updates);
                }
            });

            // Add foreign key constraints
            Schema::table('cars', function (Blueprint $table) {
                if (Schema::hasColumn('cars', 'user_uuid')) {
                    $table->foreign('user_uuid')->references('uuid')->on('users');
                }
                if (Schema::hasColumn('cars', 'created_by_uuid')) {
                    $table->foreign('created_by_uuid')->references('uuid')->on('users');
                }
                if (Schema::hasColumn('cars', 'updated_by_uuid')) {
                    $table->foreign('updated_by_uuid')->references('uuid')->on('users');
                }
            });
        }

        // Update suppliers table
        if (Schema::hasTable('suppliers')) {
            // Add UUID columns
            Schema::table('suppliers', function (Blueprint $table) {
                if (Schema::hasColumn('suppliers', 'created_by')) {
                    $table->uuid('created_by_uuid')->nullable()->after('created_by');
                }
                if (Schema::hasColumn('suppliers', 'updated_by')) {
                    $table->uuid('updated_by_uuid')->nullable()->after('updated_by');
                }
            });

            // Populate UUID columns
            DB::table('suppliers')->cursor()->each(function ($supplier) use ($userIdToUuid) {
                $updates = [];

                if (isset($supplier->created_by) && isset($userIdToUuid[$supplier->created_by])) {
                    $updates['created_by_uuid'] = $userIdToUuid[$supplier->created_by];
                }

                if (isset($supplier->updated_by) && isset($userIdToUuid[$supplier->updated_by])) {
                    $updates['updated_by_uuid'] = $userIdToUuid[$supplier->updated_by];
                }

                if (!empty($updates)) {
                    DB::table('suppliers')
                        ->where('id', $supplier->id)
                        ->update($updates);
                }
            });

            // Add foreign key constraints
            Schema::table('suppliers', function (Blueprint $table) {
                if (Schema::hasColumn('suppliers', 'created_by_uuid')) {
                    $table->foreign('created_by_uuid')->references('uuid')->on('users');
                }
                if (Schema::hasColumn('suppliers', 'updated_by_uuid')) {
                    $table->foreign('updated_by_uuid')->references('uuid')->on('users');
                }
            });
        }

        // Update audit_logs table if it exists
        if (Schema::hasTable('audit_logs')) {
            // Add UUID column
            Schema::table('audit_logs', function (Blueprint $table) {
                if (Schema::hasColumn('audit_logs', 'user_id')) {
                    $table->uuid('user_uuid')->nullable()->after('user_id');
                }
            });

            // Populate UUID column
            DB::table('audit_logs')->cursor()->each(function ($log) use ($userIdToUuid) {
                if (isset($log->user_id) && isset($userIdToUuid[$log->user_id])) {
                    DB::table('audit_logs')
                        ->where('id', $log->id)
                        ->update(['user_uuid' => $userIdToUuid[$log->user_id]]);
                }
            });

            // Add foreign key constraint
            Schema::table('audit_logs', function (Blueprint $table) {
                if (Schema::hasColumn('audit_logs', 'user_uuid')) {
                    $table->foreign('user_uuid')->references('uuid')->on('users');
                }
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove UUID columns and constraints from cars table
        if (Schema::hasTable('cars')) {
            Schema::table('cars', function (Blueprint $table) {
                if (Schema::hasColumn('cars', 'user_uuid')) {
                    $table->dropForeign(['user_uuid']);
                    $table->dropColumn('user_uuid');
                }
                if (Schema::hasColumn('cars', 'created_by_uuid')) {
                    $table->dropForeign(['created_by_uuid']);
                    $table->dropColumn('created_by_uuid');
                }
                if (Schema::hasColumn('cars', 'updated_by_uuid')) {
                    $table->dropForeign(['updated_by_uuid']);
                    $table->dropColumn('updated_by_uuid');
                }
            });
        }

        // Remove UUID columns and constraints from suppliers table
        if (Schema::hasTable('suppliers')) {
            Schema::table('suppliers', function (Blueprint $table) {
                if (Schema::hasColumn('suppliers', 'created_by_uuid')) {
                    $table->dropForeign(['created_by_uuid']);
                    $table->dropColumn('created_by_uuid');
                }
                if (Schema::hasColumn('suppliers', 'updated_by_uuid')) {
                    $table->dropForeign(['updated_by_uuid']);
                    $table->dropColumn('updated_by_uuid');
                }
            });
        }

        // Remove UUID column and constraint from audit_logs table
        if (Schema::hasTable('audit_logs')) {
            Schema::table('audit_logs', function (Blueprint $table) {
                if (Schema::hasColumn('audit_logs', 'user_uuid')) {
                    $table->dropForeign(['user_uuid']);
                    $table->dropColumn('user_uuid');
                }
            });
        }
    }
};
