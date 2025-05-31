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
       Schema::create('employee_task', function (Blueprint $table) {
    $table->id();
    $table->foreignId('employee_id')->constrained()->onDelete('cascade');
    $table->foreignId('task_id');
    $table->string('task_type'); // تحديد نوع المهمة: general_cleaning أو sanitation
    $table->timestamps();

    // تأكد من عدم التكرار على نفس الموظف لنفس المهمة
    $table->unique(['employee_id', 'task_id', 'task_type']);
});

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_task');
    }
};

