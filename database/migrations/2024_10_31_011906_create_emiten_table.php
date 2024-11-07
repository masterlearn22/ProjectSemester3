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
        Schema::create('emiten', function (Blueprint $table) {
           $table->string('STOCK_CODE')->primary();
            $table->string('NAMA_PERUSAHAAN');
            $table->bigInteger('SHARED');
            $table->string('SEKTOR');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emiten');
    }
};
