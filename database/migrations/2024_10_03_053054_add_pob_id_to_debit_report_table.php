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
        Schema::table('debit_reports', function (Blueprint $table) {
            //
            $table->unsignedBigInteger('pob_id');  // Add the pob_id field, nullable if necessary
            $table->foreign('pob_id')->references('id')->on('p_o_b_s')->onDelete('cascade');  // Set up foreign key relationship
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('debit_reports', function (Blueprint $table) {
            //
            $table->dropForeign(['pob_id']);  // Drop the foreign key first
            $table->dropColumn('pob_id');     // Then drop the column
        });
    }
};
