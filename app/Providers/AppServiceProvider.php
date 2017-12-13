<?php

namespace App\Providers;

use App\Entities\BahanBaku;
use App\Entities\Pembelian;
use App\Entities\Pengiriman;
use App\Entities\Pesanan;
use App\Entities\Produksi;
use App\Observers\BahanBakuObserver;
use App\Observers\PembelianObserver;
use App\Observers\PengirimanObserver;
use App\Observers\PesananObserver;
use App\Observers\ProduksiObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        BahanBaku::observe(BahanBakuObserver::class);
        
        Pesanan::observe(PesananObserver::class);
        Pembelian::observe(PembelianObserver::class);
        Produksi::observe(ProduksiObserver::class);
        Pengiriman::observe(PengirimanObserver::class);

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
