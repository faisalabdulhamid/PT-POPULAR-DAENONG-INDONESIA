<?php

namespace App\Providers;

use App\Entities\BahanBaku;
use App\Entities\Pesanan;
use App\Observers\BahanBakuObserver;
use App\Observers\PesananObserver;
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
