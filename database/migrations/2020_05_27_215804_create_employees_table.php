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
         Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('job_title')->nullable();
            $table->string('department')->nullable(); // النظافة، الصحية، الصيانة...
            $table->enum('shift', ['صباحي', 'مسائي', 'ليلي'])->nullable();
            $table->string('phone')->nullable();
            $table->string('status')->default('فعال'); // فعال، موقوف، منقول
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('employees');
    }
};
