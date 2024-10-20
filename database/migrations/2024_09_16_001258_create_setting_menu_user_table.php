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
        Schema::create('SETTING_MENU_USER', function (Blueprint $table) {
            $table->unsignedBigInteger('MENU_ID')->nullable();
            // Gunakan string untuk NO_SETTING sebagai primary key
            $table->string('NO_SETTING', 30)->primary();
            
            // Gunakan string untuk ID_JENIS_USER sebagai foreign key ke tabel jenis_user
            $table->string('ID_JENIS_USER')->nullable(); // Foreign key ke tabel jenis_user
            
            // Gunakan string untuk MENU_ID sebagai foreign key ke tabel menu
            
            // Tambahkan kolom lainnya
            $table->string('CREATE_BY', 30)->nullable();   // Siapa yang membuat data
            $table->timestamp('CREATE_DATE')->nullable();  // Tanggal pembuatan
            $table->string('DELETE_MARK', 1)->nullable();  // Penanda jika dihapus
            $table->string('UPDATE_BY', 30)->nullable();   // Siapa yang update data
            $table->timestamp('UPDATE_DATE')->nullable();  // Tanggal update
        
            // Tambahkan foreign key ke tabel JENIS_USER
            $table->foreign('ID_JENIS_USER')->references('ID_JENIS_USER')->on('JENIS_USER')->onDelete('cascade');
            
            // Tambahkan foreign key ke tabel menu
            $table->foreign('MENU_ID')->references('MENU_ID')->on('menu')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('SETTING_MENU_USER');
    }
};