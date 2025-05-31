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
        Schema::create('sanitation_facility_tasks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->enum('shift', ['صباحي', 'مسائي', 'ليلي']);
            $table->string('task_type'); // تنظيف، صيانة، استبدال، تعقيم
            $table->string('facility_name'); // الموقع أو اسم الصحيات
            $table->string('details'); // مثل: صيانة خلاط + رأس دوش
            $table->enum('status', ['مكتمل', 'قيد التنفيذ', 'ملغى']);
            $table->text('notes')->nullable();
            $table->string('responsible_persons')->nullable(); // أسماء الفنيين
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('sanitation_facility_tasks');
    }
};