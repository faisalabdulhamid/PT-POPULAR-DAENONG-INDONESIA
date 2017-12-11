<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProduksisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('produksi', function (Blueprint $table) {
            $table->increments('id');
            $table->date('tanggal')->nullable();
            $table->unsignedInteger('pesanan_id');
            $table->unsignedInteger('pegawai_id');
            $table->timestamps();

            $table->foreign('pesanan_id')
                ->references('id')
                ->on('pesanan')
                ->onDelete('cascade');

            $table->foreign('pegawai_id')
                ->references('id')
                ->on('pegawai')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('produksi');
    }
}
