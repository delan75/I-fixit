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
        Schema::table('images', function (Blueprint $table) {
            $table->string('status')->default('active')->after('imageable_type');
            $table->uuid('created_by')->nullable()->after('status');
            $table->uuid('updated_by')->nullable()->after('created_by');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('images', function (Blueprint $table) {
            $table->dropColumn(['status', 'created_by', 'updated_by']);
            $table->dropSoftDeletes();
        });
    }
};
