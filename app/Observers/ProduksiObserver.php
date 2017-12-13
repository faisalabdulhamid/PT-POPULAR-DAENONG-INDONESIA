<?php

namespace App\Observers;

use App\Entities\Produksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProduksiObserver
{
    public function creating(Produksi $produksi)
    {
        $produksi->tanggal = Carbon::now();
    	$produksi->pegawai_id = Auth::user()->id;
    }

    public function created(Produksi $produksi)
    {
    	# code...
    }

    public function deleting(Produksi $produksi)
    {
    	# code...
    }


}
