<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('actual_results', function (Blueprint $table) {
            // إضافة عمود unit_type
            if (!Schema::hasColumn('actual_results', 'unit_type')) {
                $table->string('unit_type')->after('date');
            }

            // إضافة مفتاح خارجي إلى جدول unit_goals
            if (!Schema::hasColumn('actual_results', 'unit_goal_id')) {
                $table->foreignId('unit_goal_id')
                    ->nullable()
                    ->constrained('unit_goals')
                    ->onDelete('cascade');
            }
        });
    }

    public function down(): void
    {
        Schema::table('actual_results', function (Blueprint $table) {
            if (Schema::hasColumn('actual_results', 'unit_type')) {
                $table->dropColumn('unit_type');
            }

            if (Schema::hasColumn('actual_results', 'unit_goal_id')) {
                $table->dropForeign(['unit_goal_id']);
                $table->dropColumn('unit_goal_id');
            }
        });
    }
};
