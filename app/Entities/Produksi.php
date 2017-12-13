<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'produksi';
    protected $appends = [];

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

    public function pengiriman()
    {
        return $this->hasMany(Pengiriman::class, 'produksi_id');
    }

    public static function boot()
    {
        parent::boot();

        static::addGlobalScope('notPengiriman', function(Builder $builder){
            $builder->has('pengiriman', 0);
        });
    }
}
