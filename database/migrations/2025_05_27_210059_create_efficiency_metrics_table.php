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
          Schema::create('efficiency_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('week'); // الأسبوع
            $table->integer('used_resources'); // الموارد المستهلكة (مثل: إجمالي ساعات العمل)
            $table->integer('achieved_results'); // عدد المهام المنجزة
            $table->decimal('efficiency_percentage', 5, 2); // النسبة
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('efficiency_metrics');
    }
};
