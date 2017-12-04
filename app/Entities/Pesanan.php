<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function produks()
    {
    	return $this->belongsToMany(Produk::class, 'detail_pesanan', 'pesanan_id', 'produk_id');
    }

    public function pelanggan()
    {
    	// return $this->belongTo(Pelanggan::class, 'pelanggan_id');
    	return $this->hasOne(Pelanggan::class, 'pelanggan_id');
    }

    public function pegawai()
    {
    	return $this->belongTo(Pegawai::class, 'pegawai_id');
    }
}
