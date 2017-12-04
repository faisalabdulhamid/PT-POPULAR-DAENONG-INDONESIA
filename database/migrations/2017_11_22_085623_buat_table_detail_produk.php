<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BuatTableDetailProduk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_produk', function (Blueprint $table) {
            // $table->increments('id');
            // $table->timestamps();
            $table->unsignedInteger('jumlah');
            
            $table->unsignedInteger('bahan_baku_id');
            $table->unsignedInteger('produk_id');
            $table->foreign('bahan_baku_id')
                ->references('id')
                ->on('bahan_baku')
                ->onDelete('cascade');
            $table->foreign('produk_id')
                ->references('id')
                ->on('produk')
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
        Schema::dropIfExists('detail_produk');
    }
}
