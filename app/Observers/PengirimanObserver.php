<?php

namespace App\Observers;

use App\Entities\Pengiriman;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class PengirimanObserver
{
    public function creating(Pengiriman $pengiriman)
    {
        $pengiriman->tanggal_selesai = Carbon::now();
    	// $pengiriman->pegawai_id = Auth::user()->id;
    }

    public function updating(Pengiriman $pengiriman)
    {
    	$pengiriman->tanggal_kirim = Carbon::now();
        $pengiriman->pegawai_id = Auth::user()->id;
    }

    public function deleting(Pengiriman $pengiriman)
    {
    	# code...
    }


}
