<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'supplier';

    protected $hidden = [
    	'created_at', 'updated_at'
    ];

    public function bahanBaku()
    {
    	return $this->belongsToMany(BahanBaku::class, 'detail_bahan_baku', 'supplier_id', 'bahan_baku_id')->withPivot('jumlah');
    }
}
