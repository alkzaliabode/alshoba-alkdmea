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
         Schema::table('resource_trackings', function (Blueprint $table) {
            $table->string('unit_type')->after('date')->nullable();

            // تعديل أسماء الأعمدة
            $table->renameColumn('number_of_employees', 'employees_count');
            $table->renameColumn('working_hours_per_employee', 'hours_per_employee');
        });
    }

    public function down(): void
    {
        Schema::table('resource_trackings', function (Blueprint $table) {
            $table->dropColumn('unit_type');

            // إعادة الأسماء القديمة
            $table->renameColumn('employees_count', 'number_of_employees');
            $table->renameColumn('hours_per_employee', 'working_hours_per_employee');
        });
    }
};
