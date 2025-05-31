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
       Schema::create('actual_results', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('completed_tasks');        // مكتمل
            $table->integer('in_progress_tasks');      // قيد التنفيذ
            $table->integer('cancelled_tasks');        // ملغى
            $table->decimal('completion_percentage', 5, 2); // النسبة المئوية
            $table->timestamps();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('actual_results');
    }
};
