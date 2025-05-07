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
     * This migration removes the old integer ID columns after
     * the UUID migration is complete.
     */
    public function up(): void
    {
        // For cars table, we need to handle the columns carefully
        // First, check if both old and new columns exist
        $hasUserIdColumn = Schema::hasColumn('cars', 'user_id');
        $hasUserUuidColumn = Schema::hasColumn('cars', 'user_uuid');
        $hasCreatedByColumn = Schema::hasColumn('cars', 'created_by');
        $hasCreatedByUuidColumn = Schema::hasColumn('cars', 'created_by_uuid');
        $hasUpdatedByColumn = Schema::hasColumn('cars', 'updated_by');
        $hasUpdatedByUuidColumn = Schema::hasColumn('cars', 'updated_by_uuid');

        // If both columns exist, we need to drop the old one first
        if ($hasUserIdColumn && $hasUserUuidColumn) {
            Schema::table('cars', function (Blueprint $table) {
                $table->dropColumn('user_id');
            });
            DB::statement('ALTER TABLE cars CHANGE user_uuid user_id CHAR(36)');
        }

        if ($hasCreatedByColumn && $hasCreatedByUuidColumn) {
            Schema::table('cars', function (Blueprint $table) {
                $table->dropColumn('created_by');
            });
            DB::statement('ALTER TABLE cars CHANGE created_by_uuid created_by CHAR(36)');
        }

        if ($hasUpdatedByColumn && $hasUpdatedByUuidColumn) {
            Schema::table('cars', function (Blueprint $table) {
                $table->dropColumn('updated_by');
            });
            DB::statement('ALTER TABLE cars CHANGE updated_by_uuid updated_by CHAR(36)');
        }

        // For suppliers table, handle columns carefully
        $hasCreatedByColumnSuppliers = Schema::hasColumn('suppliers', 'created_by');
        $hasCreatedByUuidColumnSuppliers = Schema::hasColumn('suppliers', 'created_by_uuid');
        $hasUpdatedByColumnSuppliers = Schema::hasColumn('suppliers', 'updated_by');
        $hasUpdatedByUuidColumnSuppliers = Schema::hasColumn('suppliers', 'updated_by_uuid');

        if ($hasCreatedByColumnSuppliers && $hasCreatedByUuidColumnSuppliers) {
            Schema::table('suppliers', function (Blueprint $table) {
                $table->dropColumn('created_by');
            });
            DB::statement('ALTER TABLE suppliers CHANGE created_by_uuid created_by CHAR(36)');
        }

        if ($hasUpdatedByColumnSuppliers && $hasUpdatedByUuidColumnSuppliers) {
            Schema::table('suppliers', function (Blueprint $table) {
                $table->dropColumn('updated_by');
            });
            DB::statement('ALTER TABLE suppliers CHANGE updated_by_uuid updated_by CHAR(36)');
        }

        // For audit_logs table, handle columns carefully
        if (Schema::hasTable('audit_logs')) {
            $hasUserIdColumnAuditLogs = Schema::hasColumn('audit_logs', 'user_id');
            $hasUserUuidColumnAuditLogs = Schema::hasColumn('audit_logs', 'user_uuid');

            if ($hasUserIdColumnAuditLogs && $hasUserUuidColumnAuditLogs) {
                Schema::table('audit_logs', function (Blueprint $table) {
                    $table->dropColumn('user_id');
                });
                DB::statement('ALTER TABLE audit_logs CHANGE user_uuid user_id CHAR(36)');
            }
        }

        // Finally, handle the users table
        $hasIdColumnUsers = Schema::hasColumn('users', 'id');
        $hasUuidColumnUsers = Schema::hasColumn('users', 'uuid');

        if ($hasIdColumnUsers && $hasUuidColumnUsers) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('id');
            });
            DB::statement('ALTER TABLE users CHANGE uuid id CHAR(36)');
        }
    }

    /**
     * Reverse the migrations.
     *
     * This is a destructive migration and cannot be easily reversed.
     * A database backup is recommended before running these migrations.
     */
    public function down(): void
    {
        // This migration cannot be reversed easily
        // It would require recreating integer IDs and remapping all relationships
    }
};
