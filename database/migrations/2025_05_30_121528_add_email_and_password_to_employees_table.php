<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (!Schema::hasColumn('employees', 'email')) {
                $table->string('email')->unique()->after('name');
            }

            if (!Schema::hasColumn('employees', 'password')) {
                $table->string('password')->after('email');
            }
        });
    }

    public function down(): void
    {
        Schema::table('employees', function (Blueprint $table) {
            if (Schema::hasColumn('employees', 'email')) {
                $table->dropColumn('email');
            }

            if (Schema::hasColumn('employees', 'password')) {
                $table->dropColumn('password');
            }
        });
    }
};