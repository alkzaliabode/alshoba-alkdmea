<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
          Schema::create('main_goals', function (Blueprint $table) {
            $table->id();
            $table->string('goal_text');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('main_goals');
    }
};
