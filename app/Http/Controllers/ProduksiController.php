<?php

namespace App\Http\Controllers;

use App\Entities\Produksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ProduksiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {

            $data = Produksi::with(['pesanan' => function($q){
                $q->withoutGlobalScope('notProduksi');
            }])->get();
            $produksi = $data->map(function($query){
                $batas = Carbon::parse($query->pesanan->batas_waktu);
                $batas_waktu = Carbon::parse($query->tanggal);

                return [
                    'id' => $query->id,
                    'tanggal' => $query->tanggal,
                    'nama_pelanggan' => $query->pesanan->nama_pelanggan,
                    'tanggal_pesan' => $query->pesanan->tanggal,
                    'batas_waktu' => $query->pesanan->batas_waktu,
                    'waktu_sisa' => $batas_waktu->diffInDays($batas),
                ];
            });

            return response()->json($produksi);
        }
        $title = 'Produksi';
        $script = asset('js/produksi.js');

        return view('index', compact('title', 'script'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pengiriman = new \App\Entities\Pengiriman();
        $pengiriman->produksi_id = $request->pesanan_id;
        $pengiriman->save();
        return response()->json(['message'=>'Pesanan Berhasil Dikirim Ke Produksi']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($jadwal)
    {
        if (request()->wantsJson()) {

            $data = Produksi::with(['pesanan' => function($q){
                $q->withoutGlobalScope('notProduksi');
            }])->get();
            
            $produksi = $data->map(function($query){
                $tanggal_mulai = Carbon::parse($query->tanggal);
                $batas = Carbon::parse($query->pesanan->batas_waktu);
                $batas_waktu = Carbon::parse($query->tanggal);
                $produks = $query->pesanan->produks;

                $data_produks = [];
                foreach ($produks as $key => $value) {
                    $data_produks[] = $value->pivot->jumlah;
                }

                $jumlah_produk_perhari = 17333;
                $jumlah_produks = array_sum($data_produks);
                
                $durasi = ceil($jumlah_produks/$jumlah_produk_perhari);

                return [
                    'id' => $query->id,
                    'nama_pelanggan' => $query->pesanan->nama_pelanggan,
                    'batas_waktu' => $query->pesanan->batas_waktu,
                    'waktu_sisa' => $batas_waktu->diffInDays($batas),

                    'durasi' => $durasi,
                    'rasio' => $batas_waktu->diffInDays($batas)/$durasi,
                    'urutan' => '',
                    'waktu_selesai' => $tanggal_mulai->addDays($durasi)->format('Y-m-d'),
                ];
            });



            return response()->json($produksi);
        }
        $title = 'Produksi';
        $script = asset('js/jadwal-produksi.js');

        return view('index', compact('title', 'script'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
