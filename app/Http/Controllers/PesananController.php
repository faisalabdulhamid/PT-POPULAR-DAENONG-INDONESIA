<?php

namespace App\Http\Controllers;

use App\Entities\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('ajax')->except('index');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $pesanan = Pesanan::orderBy('tanggal')->paginate(10);

            return response()->json($pesanan);
        }

        $title = 'Pesanan';
        $script = asset('js/pesanan.js');

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
        $this->validate($request, [
            'pelanggan' => 'required',
            'batas_waktu' => 'required|date',
            'total_bayar' => 'required',
            'status' => 'required',
            '*.*.produk_id' => 'required',
            '*.*.jumlah' => 'required',
            '*.*.sub_total' => 'required',
        ]);

        DB::transaction(function() use($request){
            $pesanan = new Pesanan();
            $pesanan->pelanggan_id = $request->pelanggan;
            $pesanan->batas_waktu = $request->batas_waktu;
            $pesanan->total_bayar = $request->total_bayar;
            $pesanan->status = $request->status;
            $pesanan->save();

            foreach ($request->produk as $val) {
                $pesanan->produks()->attach($val['produk_id'], ['jumlah' => $val['jumlah'], 'sub_total'=>$val['sub_total']]);
            }
            
        });
        
        return response()->json([
            'message' => 'Data Berhasil Ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (Auth::user()->divisi == 'purchasing') {
            $data = Pesanan::find($id);

            $pesanan['nama_pelanggan'] = $data->pelanggan()->first()->nama_perusahaan;
            $pesanan['tanggal'] = $data->tanggal;
            $arr_produk = $data->produks()->get();

            $pesanan['bahan_baku'] = [];
            $bahan_baku = [];
            $produk = [];
            foreach ($arr_produk as $key => $value) {
                $row = [];
                $row['nama'] = $value->nama;
                $row['jumlah'] = $value->pivot->jumlah;
                

                foreach ($value->bahanBaku as $val) {
                    $d = [];
                    $d['nama'] = $val->nama;
                    $d['jumlah_total'] = $val->pivot->jumlah * $value->pivot->jumlah;
                    $d['jumlah'] = $val->pivot->jumlah;
                    $row['bahan_baku'][] = $d;

                }
                $produk[] = $row;
            }
            $pesanan['produks'] = $produk;
            // $pesanan['bahan_baku'] = $bahan_baku;



        }else{
            $pesanan = Pesanan::with(['produks' => function($query){
                $query->select('nama', 'harga', 'warna', 'jumlah');
            }])->get()->find($id);    
        }
        
        

        return response()->json($pesanan);    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pesanan $pesanan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $produksi = new \App\Entities\Produksi();
        $produksi->pesanan_id = $id;
        $produksi->save();
        return response()->json(['message'=>'Pesanan Berhasil Dikirim Ke Produksi'], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Pesanan  $pesanan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pesanan $pesanan)
    {
        $pesanan->delete();

        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 201);
    }
}
