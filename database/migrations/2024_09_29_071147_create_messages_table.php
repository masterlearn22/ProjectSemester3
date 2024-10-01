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
        Schema::create('messages', function (Blueprint $table) {
            $table->char('message_id', 36)->primary();
            $table->string('sender', 30);
            $table->string('message_reference', 30)->nullable();
            $table->string('subject', 300);
            $table->text('message_text');
            $table->string('message_status', 30);
            $table->string('no_mk', 30);
            $table->timestamp('create_date')->nullable();
            $table->boolean('delete_mark')->default(0);
            $table->string('update_by', 30);
            $table->string('recipient_email');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
