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
       Schema::table('actual_results', function (Blueprint $table) {
        $table->foreignId('goal_id')->nullable()->constrained('daily_goals')->onDelete('set null');
        $table->enum('type', ['daily', 'weekly', 'monthly', 'yearly'])->default('daily');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('actual_results', function (Blueprint $table) {
            //
        });
    }
};
