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
        Schema::create('JENIS_USER', function (Blueprint $table) {
            $table->string('ID_JENIS_USER')->primary(); // Primary Key
            $table->string('JENIS_USER'); // Nama Jenis User
            $table->string('CREATE_BY', 30)->nullable(); // Siapa yang membuat
            $table->timestamp('CREATE_DATE')->nullable(); // Kapan dibuat
            $table->string('DELETE_MARK', 1)->nullable(); // Mark apakah sudah dihapus
            $table->string('UPDATE_BY', 30)->nullable(); // Siapa yang mengupdate
            $table->timestamp('UPDATE_DATE')->nullable(); // Kapan diupdate
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('JENIS_USER');
    }
};
