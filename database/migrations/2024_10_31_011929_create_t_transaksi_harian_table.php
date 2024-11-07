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
        Schema::create('t_transaksi_harian',function (Blueprint $table) {
                $table->id('NO_RECORDS');
                $table->string('STOCK_CODE',4);
                $table->date('DATE_TRANSACTION');
                $table->integer('OPEN');
                $table->integer('HIGH');
                $table->integer('LOW');
                $table->integer('CLOSE');
                $table->integer('CHANGE');
                $table->bigInteger('VOLUME');
                $table->bigInteger('VALUE');
                $table->integer('FREQUENCY');

                $table->foreign('STOCK_CODE')->references('STOCK_CODE')->on('emiten')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            }
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('t_transaksi_harian');
    }
};
