<?php

use Illuminate\Database\Seeder;
use App\Entities\BahanBaku;
use App\Entities\Supplier;
use App\Entities\Pegawai;

class BahanBakuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rand = [1, 2, 3][rand(0,1)];
        $jumlah = [7000, 8000, 9000][rand(0,1)];

        $pegawai = Pegawai::inRandomOrder()->first();
        $supplier = Supplier::inRandomOrder()->limit($rand)->pluck('id');
        $bahan = new BahanBaku();
        $bahan->nama = 'Benang Polyester';
        $bahan->berat = [4, 7, 9][rand(0, 1)];
        $bahan->gramasi = ['20 s', '25 s', '30 s', '35 s', '40 s'][rand(0, 1)];
        $bahan->pegawai_id = $pegawai->id;
        $bahan->save();
        $bahan->suppliers()->attach($supplier, ['jumlah'=>$jumlah]);

        $pegawai = Pegawai::inRandomOrder()->first();
        $supplier = Supplier::inRandomOrder()->limit($rand)->pluck('id');
        $bahan = new BahanBaku();
        $bahan->nama = 'Benang Cotton';
        $bahan->berat = ['4', '7', '9'][rand(0, 1)];
        $bahan->gramasi = ['20 s', '25 s', '30 s', '35 s', '40 s'][rand(0, 1)];
        $bahan->pegawai_id = $pegawai->id;
        $bahan->save();
        $bahan->suppliers()->attach($supplier, ['jumlah'=>$jumlah]);

        $pegawai = Pegawai::inRandomOrder()->first();
        $supplier = Supplier::inRandomOrder()->limit($rand)->pluck('id');
        $bahan = new BahanBaku();
        $bahan->nama = 'Benang Spandex';
        $bahan->berat = ['4', '7', '9'][rand(0, 1)];
        $bahan->gramasi = ['20 s', '25 s', '30 s', '35 s', '40 s'][rand(0, 1)];
        $bahan->pegawai_id = $pegawai->id;
        $bahan->save();
        $bahan->suppliers()->attach($supplier, ['jumlah'=>$jumlah]);

    }
}
