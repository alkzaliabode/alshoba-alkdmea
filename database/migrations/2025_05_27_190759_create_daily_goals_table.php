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
        
           Schema::create('daily_goals', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('cleaning_department_goal'); // قسم النظافة
            $table->integer('maintenance_department_goal'); // قسم الصيانة
            $table->integer('total_goal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_goals');
    }
};
