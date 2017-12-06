<?php

namespace App\Http\Controllers;

use App\Entities\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) 
        {
            $produk = Produk::paginate(10);

            return response()->json($produk, 200);
        }

        $title = 'Produk';
        $script = asset('js/produk.js');

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
            'nama' => 'required',
            'warna' => 'required',
            'gramasi' => 'required',
            'harga' => 'required',
            '*.*.bahan_baku_id' => 'required',
            '*.*.jumlah' => 'required'
        ]);

        DB::transaction(function() use ($request){
            $produk = new Produk();
            $produk->nama = $request->nama;
            $produk->warna  = $request->warna;
            $produk->gramasi = $request->gramasi;
            $produk->harga = $request->harga;
            $produk->save();

            foreach ($request->bahan_baku as $value) {
                $produk->bahanBakus()->attach($value['bahan_baku_id'], ['jumlah' => $value['jumlah']]);
            }
            
        });
        

        return response()->json([
            'message' => 'Data Berhasil Ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $produk = new Produk();
        $item = $produk->with(['bahanBaku' => function($query){
            $query->select('bahan_baku_id', 'nama', 'jumlah');
        }])->get()->find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = new Produk();
        $item = $produk->with(['bahanBaku' => function($query){
            $query->select('bahan_baku_id', 'jumlah');
        }])->get()->find($id);
        
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produk $produk)
    {
        $this->validate($request, [
            'nama' => 'required',
            'warna' => 'required',
            'gramasi' => 'required',
            'harga' => 'required',
            '*.*.bahan_baku_id' => 'required',
            '*.*.jumlah' => 'required',
        ]);

        DB::transaction(function() use ($produk, $request){
            $produk->nama = $request->nama;
            $produk->warna  = $request->warna;
            $produk->gramasi = $request->gramasi;
            $produk->harga = $request->harga;
            $produk->save();

            $produk->bahanBaku()->sync($request->bahan_baku);
        });

        return response()->json([
            'message' => 'Data Berhasil Diubah'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        $produk->delete();

        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 201);
    }
}
