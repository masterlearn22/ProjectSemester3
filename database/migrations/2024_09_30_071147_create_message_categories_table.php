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
        Schema::create('message_categories', function (Blueprint $table) {
            $table->string('no_mk', 30)->primary();
            $table->string('description', 50);
            $table->string('create_by', 30);
            $table->timestamp('create_date');
            $table->boolean('delete_mark')->default(false);
            $table->string('update_by', 30);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('message_categories');
    }
};
