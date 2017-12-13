<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePengirimenTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengiriman', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('produksi_id');
            $table->unsignedInteger('pegawai_id')->nullable();
            $table->date('tanggal_selesai');
            $table->date('tanggal_kirim')->nullable();

            $table->timestamps();

            $table->foreign('produksi_id')
                ->references('id')
                ->on('produksi')
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
        Schema::dropIfExists('pengiriman');
    }
}
