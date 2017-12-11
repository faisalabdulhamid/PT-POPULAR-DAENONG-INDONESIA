<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'produksi';
    protected $appends = ['nama_pesanan'];

    protected $hidden = [
    	'created_at', 'updated_at'
    ];

    public function pegawai()
    {
    	return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function pesanan()
    {
    	return $this->belongsTo(Pesanan::class, 'pesanan_id');
    }

    public function getNamaPesananAttribute()
    {
    	return $this->pesanan()->first();
    }
}
