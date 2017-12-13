<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDetailPembelian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_pembelian', function (Blueprint $table) {
            $table->unsignedInteger('bahan_baku_id');
            $table->unsignedInteger('pembelian_id');

            $table->unsignedInteger('jumlah');

            $table->foreign('pembelian_id')
                ->references('id')
                ->on('pembelian')
                ->onDelete('cascade');
            $table->foreign('bahan_baku_id')
                ->references('id')
                ->on('bahan_baku')
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
        Schema::dropIfExists('detail_pembelian');
    }
}
