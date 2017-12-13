<?php

namespace App\Entities;

use App\Entities\BahanBaku;
use App\Entities\Pegawai;
use App\Entities\Supplier;
use Illuminate\Database\Eloquent\Model;

class Pembelian extends Model
{
    protected $table = 'pembelian';
    protected $appends = [
    	'nama_supplier',
    	// 'nama_bahan'
    ];

    protected $hidden = [
    	'created_at', 'updated_at', 'pegawai_id', 'supplier_id', 'bahan_baku_id'
    ];

    public function getNamaSupplierAttribute()
    {
        return $this->supplier()->first()->nama;
    }

    public function supplier()
    {
    	return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function pegawai()
    {
    	return $this->belongsTo(Pegawai::class, 'pegawai_id');
    }

    public function bahanBaku()
    {
        return $this->belongsToMany(BahanBaku::class, 'detail_pembelian', 'pembelian_id', 'bahan_baku_id')->withPivot('jumlah');
    }

    // public function getNamaBahanAttribute()
    // {
    // 	return $this->bahanBaku()->first()->nama;
    // }
}
