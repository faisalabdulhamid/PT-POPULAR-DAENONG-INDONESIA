<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;

class Pelanggan extends Model
{
    protected $table = 'pelanggan';

    protected $hidden = [
    	'created_at', 'updated_at'
    ];

    public function pesanan()
    {
    	// return $this->hasMany(Pesanan::class, 'pelanggan_id');
    	return $this->hasOne(Pesanan::class, 'pelanggan_id');
    }
}
