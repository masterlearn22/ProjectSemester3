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
        Schema::create('users', function (Blueprint $table) {
            $table->id('ID_USER');
            $table->string('name', 60);
            $table->string('username', 60);
            $table->string('password', 60);
            $table->string('email', 60);
            $table->string('profile_photo')->nullable(); // Pindahkan ke sini
            $table->string('no_hp', 30);
            $table->string('wa', 15);
            $table->string('pin', 15);
            $table->string('ID_JENIS_USER', 30)->nullable();
            $table->string('STATUS_USER', 30)->nullable();
            $table->timestamps();
        
            $table->foreign('ID_JENIS_USER')->references('ID_JENIS_USER')->on('JENIS_USER');
        });
        

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->string('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('profile_photo');
        });
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
