<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Entities\Pegawai::class, 10)->create();
        factory(App\Entities\Pelanggan::class, 100)->create();
        factory(App\Entities\Supplier::class, 10)->create();

        $this->call(BahanBakuSeeder::class);

        $this->call(ProdukSeeder::class);


        // factory(App\Entities\Pesanan::class, 10)->create();
        factory(App\Entities\Pesanan::class, 10)->create()->each(function($pesanan){
        	$produk = App\Entities\Produk::inRandomOrder()->limit([2,3,4][rand(0,1)])->pluck('id');
        	$pesanan->produks()->attach($produk, ['jumlah' => [1,2,3][rand(0,1)]]);
        });


    }
}
