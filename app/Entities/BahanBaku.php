<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class BahanBaku extends Model
{
    protected $table = 'bahan_baku';

    protected $hidden = [
        'created_at', 'updated_at', 'pivot'
    ];
    
    public function pegawai()
    {
    	return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function suppliers()
    {
    	return $this->belongsToMany(Supplier::class, 'detail_bahan_baku', 'bahan_baku_id', 'supplier_id');
    }

    public function produks()
    {
    	return $this->belongsToMany(Produk::class, 'detail_produk', 'bahan_baku_id', 'produk_id');
    }
}
