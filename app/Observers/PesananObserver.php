<?php

namespace App\Observers;

use App\Entities\Pesanan;
use Illuminate\Support\Facades\Auth;

class PesananObserver
{
    public function creating(Pesanan $pesanan)
    {
    	$pesanan->pegawai_id = Auth::user()->id;
    }

}
