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
        Schema::create('debit_reports', function (Blueprint $table) {
            $table->id();
            $table->foreignId('dam_id')->constrained()->onDelete('cascade');
            $table->float('limpas');
            $table->double('debit');
            $table->string('cuaca');
            $table->double('debit_ke_saluran_induk');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('debit_reports');
    }
};
