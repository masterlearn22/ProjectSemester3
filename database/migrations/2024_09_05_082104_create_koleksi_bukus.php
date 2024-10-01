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
        Schema::create('koleksi_bukus', function (Blueprint $table) {
            $table->id('id_buku');
            $table->unsignedBigInteger('id_kategori');  // Foreign key column
            $table->string('kode');
            $table->string('judul');
            $table->string('pengarang');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_kategori')->references('id_kategori')->on('kategori')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('koleksi_bukus');
    }
};
