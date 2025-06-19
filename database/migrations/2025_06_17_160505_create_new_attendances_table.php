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
        Schema::dropIfExists('attendances');

        // Recreate attendances table
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->string('attendable_type');
            $table->unsignedBigInteger('attendable_id');
            $table->date('attendance_date');
            $table->string('branch')->nullable();
            $table->time('check_in')->nullable();
            $table->time('check_out')->nullable();
            $table->timestamps();

            // Optional: unique constraint to prevent duplicate attendance for same entity and date
            $table->unique(['attendable_type', 'attendable_id', 'attendance_date'], 'attendances_attendable_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
