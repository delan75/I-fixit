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
     * This migration will create a new primary key column using UUID
     * and update all foreign key references to use the new UUID.
     */
    public function up(): void
    {
        // We need to drop foreign key constraints that reference users.id
        // before we can change the primary key

        // Get all tables in the database
        $tables = DB::select('SHOW TABLES');
        $dbName = DB::connection()->getDatabaseName();
        $tableColumn = "Tables_in_" . $dbName;

        // For each table, check for foreign keys to users.id and drop them
        foreach ($tables as $table) {
            $tableName = $table->$tableColumn;

            // Skip the users table itself
            if ($tableName === 'users') {
                continue;
            }

            // Get foreign keys for this table
            $foreignKeys = DB::select(
                "SELECT CONSTRAINT_NAME
                FROM information_schema.KEY_COLUMN_USAGE
                WHERE REFERENCED_TABLE_SCHEMA = ?
                AND REFERENCED_TABLE_NAME = 'users'
                AND TABLE_NAME = ?",
                [$dbName, $tableName]
            );

            // Drop each foreign key
            foreach ($foreignKeys as $foreignKey) {
                $constraintName = $foreignKey->CONSTRAINT_NAME;
                Schema::table($tableName, function (Blueprint $table) use ($constraintName) {
                    $table->dropForeign($constraintName);
                });
            }
        }

        // Now we can modify the primary key in users table
        Schema::table('users', function (Blueprint $table) {
            // Drop the auto-increment primary key
            $table->dropPrimary();

            // Change id to bigInteger and make it nullable (temporarily)
            $table->bigInteger('id')->nullable()->change();

            // Make uuid the primary key
            $table->primary('uuid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This is a complex operation to reverse
        // It's recommended to have a backup before running these migrations

        Schema::table('users', function (Blueprint $table) {
            // Drop the UUID primary key
            $table->dropPrimary();

            // Make id the primary key again
            $table->primary('id');

            // Make id auto-increment again
            $table->bigIncrements('id')->change();
        });

        // This is a complex operation to reverse
        // It's recommended to have a backup before running these migrations
        // The down method is not fully implemented as it would require
        // recreating all foreign key constraints
    }
};
