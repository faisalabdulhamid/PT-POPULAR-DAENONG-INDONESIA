<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBahanBakusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bahan_baku', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->tinyInteger('berat');
            $table->enum('gramasi', ['20 s', '25 s', '30 s', '35 s', '40 s']);
            $table->unsignedInteger('pegawai_id');
            $table->timestamps();

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
        Schema::dropIfExists('bahan_baku');
    }
}
