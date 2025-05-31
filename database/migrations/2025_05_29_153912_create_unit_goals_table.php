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
        Schema::create('unit_goals', function (Blueprint $table) {
           $table->id();
            $table->foreignId('department_goal_id')->constrained('department_goals')->onDelete('cascade');
            $table->string('unit_name');   // ✅ مطلوب
            $table->string('goal_text');   // ✅ مطلوب
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unit_goals');
    }
};
