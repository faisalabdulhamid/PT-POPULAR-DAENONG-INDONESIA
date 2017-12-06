<?php

namespace App\Http\Controllers;

use App\Entities\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PesananController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $pesanan = Pesanan::paginate(10);

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
            // 'tanggal' => 'required|date',
            'total_bayar' => 'required',
            'status' => 'required',
            '*.*.produk_id' => 'required',
            '*.*.jumlah' => 'required',
            '*.*.sub_total' => 'required',
        ]);

        DB::transaction(function() use($request){
            $pesanan = new Pesanan();
            $pesanan->pelanggan_id = $request->pelanggan;
            $pesanan->tanggal = $request->tanggal;
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
        $pesanan = Pesanan::with(['produks' => function($query){
            $query->select('nama', 'harga', 'warna', 'jumlah');
        }])->get()->find($id);
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
    public function update(Request $request, Pesanan $pesanan)
    {
        $this->validate($request, [
            'pelanggan' => 'required',
            'tanggal' => 'required|date',
            'total_bayar' => 'required',
            'status' => 'required',
            'produk' => 'required'
        ]);

        DB::transaction(function() use($pesanan, $request){
            $pesanan->pelanggan_id = $request->pelanggan;
            $pesanan->tanggal = $request->tanggal;
            $pesanan->total_bayar = $request->total_bayar;
            $pesanan->status = $request->status;
            $pesanan->save();

            $pesanan->produks()->sync($request->produk);
            
        });

        return response()->json([
            'message' => 'Data Berhasil Diubah'
        ], 201);
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
