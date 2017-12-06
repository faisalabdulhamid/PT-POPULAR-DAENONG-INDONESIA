<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';

    protected $hidden = [
    	'created_at', 'updated_at', 'pivot'
    ];

    public function bahanBaku()
    {
    	return $this->belongsToMany(BahanBaku::class, 'detail_produk', 'produk_id', 'bahan_baku_id')->withPivot('jumlah');
    }

    public function pesanans()
    {
    	return $this->belongsToMany(Pesanan::class, 'detail_pesanan', 'produk_id', 'pesanan_id');
    }
}
