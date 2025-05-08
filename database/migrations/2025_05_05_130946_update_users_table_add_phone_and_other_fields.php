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
        Schema::table('users', function (Blueprint $table) {
            // Check if columns exist before adding them
            if (!Schema::hasColumn('users', 'first_name')) {
                $table->string('first_name')->after('id')->nullable();
            }

            if (!Schema::hasColumn('users', 'last_name')) {
                $table->string('last_name')->after('first_name')->nullable();
            }

            // Check if phone column exists
            if (!Schema::hasColumn('users', 'phone')) {
                $table->string('phone')->after('email')->nullable();
            }

            // We'll handle unique constraint separately to avoid issues with duplicate values

            // Check if role column exists
            if (!Schema::hasColumn('users', 'role')) {
                $table->string('role')->after('phone')->default('user');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['first_name', 'last_name', 'phone', 'role']);
        });
    }
};
