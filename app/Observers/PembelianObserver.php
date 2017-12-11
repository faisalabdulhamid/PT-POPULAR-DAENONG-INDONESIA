<?php

namespace App\Observers;

use App\Entities\Pembelian;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PembelianObserver
{
    public function creating(Pembelian $pesanan)
    {
    	$pesanan->pegawai_id = Auth::user()->id;
    	$pesanan->tanggal = Carbon::now();
    }

}
