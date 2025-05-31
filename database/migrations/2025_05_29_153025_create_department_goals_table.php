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
    Schema::create('department_goals', function (Blueprint $table) {
        $table->id();
        $table->foreignId('main_goal_id')->constrained('main_goals')->onDelete('cascade');
        $table->string('goal_text'); // ✅ هذا السطر هو المطلوب
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('department_goals');
    }
};
