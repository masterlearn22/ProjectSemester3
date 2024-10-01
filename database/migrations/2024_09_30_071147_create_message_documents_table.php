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
        Schema::create('message_documents', function (Blueprint $table) {
            $table->string('no_mdok', 30)->primary();
            $table->string('file', 200);
            $table->string('description', 150);
            $table->string('message_id', 30);
            $table->string('create_by', 30);
            $table->timestamp('create_date');
            $table->boolean('delete_mark')->default(false);
            $table->string('update_by', 30);
            $table->timestamps();
            
            $table->foreign('message_id')->references('message_id')->on('messages');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_documents');
    }
};
