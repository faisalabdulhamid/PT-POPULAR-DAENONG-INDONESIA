<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    protected $table = 'pesanan';
    protected $appends = ['nama_pelanggan'];

    protected $hidden = [
        'created_at', 'updated_at'
    ];

    public function produks()
    {
    	return $this->belongsToMany(Produk::class, 'detail_pesanan', 'pesanan_id', 'produk_id')->withPivot('jumlah');
    }

    public function pelanggan()
    {
    	return $this->belongsTo(Pelanggan::class, 'pelanggan_id');
    }

    public function pegawai()
    {
    	return $this->belongTo(Pegawai::class, 'pegawai_id');
    }

    public function getNamaPelangganAttribute()
    {
        // $pelanggan = ;
        return $this->pelanggan()->first()->nama_perusahaan;
    }

    public function produksi()
    {
        return $this->hasMany(Produksi::class, 'pesanan_id');
    }

    public static function boot()
    {
        parent::boot();

        // static::addGlobalScope('notProduksi', function(Builder $builder){
        //     $builder->has('produksi', 0);
        // });
    }
}
