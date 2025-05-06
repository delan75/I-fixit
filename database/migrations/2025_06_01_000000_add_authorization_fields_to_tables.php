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
        // Add created_by and updated_by to cars table
        Schema::table('cars', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('user_id')->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->softDeletes(); // Adds deleted_at column
            $table->string('status')->default('active')->after('form_step');
        });

        // Add created_by and updated_by to damaged_parts table
        Schema::table('damaged_parts', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('car_id')->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->softDeletes(); // Adds deleted_at column
            $table->string('status')->default('active')->after('is_repaired');
        });

        // Add created_by and updated_by to parts table
        Schema::table('parts', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('car_id')->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->softDeletes(); // Adds deleted_at column
            $table->string('status')->default('active')->after('supplier_id');
        });

        // Add created_by and updated_by to labor table
        Schema::table('labor', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('car_id')->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->softDeletes(); // Adds deleted_at column
            $table->string('status')->default('active')->after('completion_date');
        });

        // Add created_by and updated_by to painting table
        Schema::table('painting', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('car_id')->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->softDeletes(); // Adds deleted_at column
            $table->string('status')->default('active')->after('completion_date');
        });

        // Add created_by and updated_by to sales table
        Schema::table('sales', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('car_id')->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->softDeletes(); // Adds deleted_at column
            $table->string('status')->default('active')->after('notes');
        });

        // Add created_by and updated_by to suppliers table
        Schema::table('suppliers', function (Blueprint $table) {
            $table->foreignId('created_by')->nullable()->after('id')->constrained('users')->nullOnDelete();
            $table->foreignId('updated_by')->nullable()->after('created_by')->constrained('users')->nullOnDelete();
            $table->softDeletes(); // Adds deleted_at column
            $table->string('status')->default('active')->after('website');
        });

        // Add status field to users table for soft delete
        Schema::table('users', function (Blueprint $table) {
            $table->string('status')->default('active')->after('role');
            $table->softDeletes(); // Adds deleted_at column
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove columns from cars table
        Schema::table('cars', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_at', 'status']);
        });

        // Remove columns from damaged_parts table
        Schema::table('damaged_parts', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_at', 'status']);
        });

        // Remove columns from parts table
        Schema::table('parts', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_at', 'status']);
        });

        // Remove columns from labor table
        Schema::table('labor', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_at', 'status']);
        });

        // Remove columns from painting table
        Schema::table('painting', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_at', 'status']);
        });

        // Remove columns from sales table
        Schema::table('sales', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_at', 'status']);
        });

        // Remove columns from suppliers table
        Schema::table('suppliers', function (Blueprint $table) {
            $table->dropForeign(['created_by']);
            $table->dropForeign(['updated_by']);
            $table->dropColumn(['created_by', 'updated_by', 'deleted_at', 'status']);
        });

        // Remove columns from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['status', 'deleted_at']);
        });
    }
};
