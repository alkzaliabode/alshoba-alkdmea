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
         Schema::create('effectiveness_metrics', function (Blueprint $table) {
            $table->id();
            $table->string('week'); // مثل: الأسبوع 1 أو Week 1
            $table->integer('planned_goals'); // الأهداف المخطط لها
            $table->integer('achieved_results'); // الإنجاز الفعلي
            $table->decimal('effectiveness_percentage', 5, 2); // الفعالية (%)
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('effectiveness_metrics');
    }
};
