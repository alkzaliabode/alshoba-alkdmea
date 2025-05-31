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
        Schema::create('resource_trackings', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->integer('number_of_employees'); // عدد الموظفين
            $table->decimal('working_hours_per_employee', 4, 2); // ساعات العمل للموظف
            $table->decimal('total_working_hours', 6, 2); // إجمالي ساعات العمل
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('resource_trackings');
    }
};
