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
        Schema::create('general_cleaning_tasks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('shift', ['صباحي', 'مسائي', 'ليلي']);
            $table->string('task_type'); // مثل: تفريغ حاويات، فرش سجاد، تنظيف قاعة
            $table->string('location');
            $table->integer('quantity')->nullable(); // يُجبر على الرقم عند بعض المهام فقط
            $table->enum('status', ['مكتمل', 'قيد التنفيذ', 'ملغى']);
            $table->text('notes')->nullable();
            $table->string('responsible_persons')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('general_cleaning_tasks');
    }
};