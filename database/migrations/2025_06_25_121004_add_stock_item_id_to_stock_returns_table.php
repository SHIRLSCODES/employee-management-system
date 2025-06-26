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
        Schema::table('stock_returns', function (Blueprint $table) {
            $table->foreignId('stock_item_id')->nullable()->constrained()->onDelete('set null')->after('stock_requisition_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('stock_returns', function (Blueprint $table) {
            $table->dropForeign(['stock_item_id']);
            $table->dropColumn('stock_item_id');
        });
    }
};
