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
        Schema::create('daily_operations', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('shift', ['صباحي', 'مسائي', 'ليلي']);
            $table->string('type'); // نوع المهمة (سباكة، نظافة، ادامة، ...)
            $table->string('location'); // الموقع (قاعة 4، صحيات الجامع، ...)
            $table->enum('status', ['مكتمل', 'قيد التنفيذ', 'ملغى']);
            $table->text('notes')->nullable(); // ملاحظات إضافية
            $table->string('responsible_persons')->nullable(); // أسماء المنفذين (نص مفصول بفواصل)
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('daily_operations');
    }
};