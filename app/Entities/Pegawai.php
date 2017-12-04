<?php

namespace App\Entities;

use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Pegawai extends Authenticatable
{
    use HasApiTokens, Notifiable;
    
    protected $table = 'pegawai';

    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];

    public function bahanBakus()
    {
    	return $this->hasMany(BahanBaku::class, 'pegawai_id');
    }

    public function pesanans()
    {
    	return $this->hasMany(Pesanan::class, 'pegawai_id');
    }
}
