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
        Schema::create('menu', function (Blueprint $table) {
            $table->string('MENU_ID', 30)->primary();      // Primary key
            $table->string('MENU_NAME', 300);              // Nama menu
            $table->string('MENU_LINK', 300);              // Link atau URL untuk menu
            $table->string('MENU_ICON', 300);              // Ikon untuk menu
            $table->string('CREATE_BY', 30)->nullable();   // Siapa yang membuat data
            $table->timestamp('CREATE_DATE')->nullable();  // Tanggal pembuatan
            $table->string('DELETE_MARK', 1)->nullable();  // Penanda jika dihapus
            $table->string('UPDATE_BY', 30)->nullable();   // Siapa yang update data
            $table->timestamp('UPDATE_DATE')->nullable();  // Tanggal update
        });
    
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menu');
    }
};
