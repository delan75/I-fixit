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
            // Add first_name and last_name columns
            $table->string('first_name')->after('id')->nullable();
            $table->string('last_name')->after('first_name')->nullable();

            // Add phone column with unique constraint
            $table->string('phone')->after('email')->unique()->nullable();

            // Add role column
            $table->string('role')->after('phone')->default('user');
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
