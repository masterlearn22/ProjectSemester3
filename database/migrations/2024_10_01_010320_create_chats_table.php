<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('chats', function (Blueprint $table) {
            $table->id(); // Primary key untuk chat
            $table->text('message');
            $table->unsignedBigInteger('ID_USER'); // Foreign key untuk user
            $table->timestamps(); // Menyimpan waktu pesan dibuat dan di-update

            // Definisi foreign key untuk ID_USER
            $table->foreign('ID_USER')->references('ID_USER')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('chats');
    }
};

