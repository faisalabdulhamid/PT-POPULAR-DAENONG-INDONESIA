<?php

namespace App\Observers;

use App\Entities\BahanBaku;
use Illuminate\Support\Facades\Auth;

class BahanBakuObserver
{
    public function creating(BahanBaku $bahan_baku)
    {
    	$bahan_baku->pegawai_id = Auth::user()->id;
    }

    public function created(BahanBaku $bahan_baku)
    {
    	# code...
    }

    public function deleting(BahanBaku $bahan_baku)
    {
    	# code...
    }


}
