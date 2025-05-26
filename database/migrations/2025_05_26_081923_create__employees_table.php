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
            $table->string('employee_no')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('nin')->unique();
            $table->string('email')->unique();
            $table->string('phone_number');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->text('address'); 
            $table->string('department');
            $table->string('designation');
            $table->string('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
