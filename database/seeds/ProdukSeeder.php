<?php

use Illuminate\Database\Seeder;
use App\Entities\Produk;
use App\Entities\Pesanan;
use App\Entities\BahanBaku;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jumlah = [2000, 3000, 4000][rand(0,1)];
        $limit = [2,3,4,5][rand(0,1)];

        $bahan = BahanBaku::inRandomOrder()->limit($limit)->pluck('id');
        $produk = new Produk();
        $produk->nama = 'Poly Cotton Frenchterry';
		$produk->warna = 'Merah';
		$produk->gramasi = ['20 s', '25 s', '30 s', '35 s', '40 s'][rand(0,1)];
		$produk->harga = '46000';
		$produk->save();
		$produk->bahanBakus()->attach($bahan, ['jumlah' => $jumlah]);

		$produk = new Produk();
        $produk->nama = 'Cotton Combed';
		$produk->warna = 'Biru';
		$produk->gramasi = ['20 s', '25 s', '30 s', '35 s', '40 s'][rand(0,1)];
		$produk->harga = '40000';
		$produk->save();
		$produk->bahanBakus()->attach($bahan, ['jumlah' => $jumlah]);

		$produk = new Produk();
        $produk->nama = 'Rayon';
		$produk->warna = 'Hijau';
		$produk->gramasi = ['20 s', '25 s', '30 s', '35 s', '40 s'][rand(0,1)];
		$produk->harga = '34000';
		$produk->save();
		$produk->bahanBakus()->attach($bahan, ['jumlah' => $jumlah]);
    }
}
