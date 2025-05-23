<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Instead of using change() with DB::raw, which causes issues,
        // we'll use a different approach to set the default value
        DB::statement('ALTER TABLE cars MODIFY purchase_date DATE DEFAULT CURRENT_DATE');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Use direct SQL to remove the default value
        DB::statement('ALTER TABLE cars MODIFY purchase_date DATE DEFAULT NULL');
    }
};
