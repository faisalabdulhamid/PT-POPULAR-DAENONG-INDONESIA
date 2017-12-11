<?php

namespace App\Observers;

use App\Entities\Produksi;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProduksiObserver
{
    public function creating(Produksi $bahan_baku)
    {
        $bahan_baku->tanggal = Carbon::now();
    	$bahan_baku->pegawai_id = Auth::user()->id;
    }

    public function created(Produksi $bahan_baku)
    {
    	# code...
    }

    public function deleting(Produksi $bahan_baku)
    {
    	# code...
    }


}
