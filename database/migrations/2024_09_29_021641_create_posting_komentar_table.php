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
        Schema::create('posting_komentar', function (Blueprint $table) {
            $table->string('komen_id', 30)->primary();
            $table->string('posting_id', 30);
            $table->string('id_user', 30)->nullable();
            $table->text('komentar_text');
            $table->string('komentar_gambar', 200)->nullable();
            $table->string('create_by', 30);
            $table->timestamp('create_date')->useCurrent();
            $table->string('delete_mark', 1)->default('0');
            $table->string('update_by', 30)->nullable();
            $table->timestamp('update_date')->nullable();
            
            $table->foreign('posting_id')->references('posting_id')->on('posting');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posting_komentar');
    }
};
