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
       Schema::create('performance_evaluations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employee_id')->constrained()->onDelete('cascade');
            $table->date('evaluation_date');
            $table->integer('tasks_completed');         // عدد المهام المنجزة
            $table->integer('goals_assigned');          // عدد المهام المخططة له
            $table->decimal('efficiency', 5, 2);        // الإنجاز / الوقت أو الموارد
            $table->decimal('effectiveness', 5, 2);     // الإنجاز / الهدف
            $table->text('notes')->nullable();          // ملاحظات إضافية
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('performance_evaluations');
    }
};