<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Pengiriman extends Model
{
    protected $table = 'pengiriman';
    protected $hidden = ['created_at', 'updated_at'];
    protected $appends = ['pesanan', 'berat_produk', 'truk'];

    public function produksi()
    {
    	return $this->belongsTo(Produksi::class, 'produksi_id');
    }

    public function scopeHistory($query)
    {
        return $query->whereNotNull('tanggal_kirim');
    }

    public function scopeBelumKirim($query)
    {
        return $query->whereNull('tanggal_kirim');
    }

    public function getPesananAttribute()
    {
    	$produksi = $this->produksi()->withOutGlobalScope('notPengiriman')->first();
    	return $produksi->pesanan()->withOutGlobalScope('notProduksi')->first();
    }

    public function getBeratProdukAttribute()
    {
    	$produksi = $this->produksi()->withOutGlobalScope('notPengiriman')->first();
    	$pesanan = $produksi->pesanan()->withOutGlobalScope('notProduksi')->first();
    	$jlm = 0;
    	foreach ($pesanan->produks as $value) {
    		$jlm = $jlm + $value->pivot->jumlah;
    	}
		return $jlm;
    }

    public function getTrukAttribute()
    {
    	$truk = 'Kontainer';
    	if ($this->berat_produk < 20000) {
    		$truk = 'Engkel';
    	}
    	return $truk;
    }
}
