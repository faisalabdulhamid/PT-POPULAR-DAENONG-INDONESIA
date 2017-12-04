<?php

namespace App\Http\Controllers;

use App\Entities\BahanBaku;
use Illuminate\Http\Request;

class BahanBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $bahan = BahanBaku::paginate(10);

            return response()
                ->json($bahan);
        }

        $title = 'Bahan Baku';
        $script = asset('js/bahan-baku.js');

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
            'berat' => 'required',
            'gramasi' => 'required',
        ]);

        $bahanBaku = new BahanBaku();
        $bahanBaku->nama = $request->nama;
        $bahanBaku->berat = $request->berat;
        $bahanBaku->gramasi = $request->gramasi;
        $bahanBaku->save();

        return response()->json([
            'message' => 'Data Berhasil Ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\BahanBaku  $bahanBaku
     * @return \Illuminate\Http\Response
     */
    public function show(BahanBaku $bahanBaku)
    {
        return response()->json($bahanBaku);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\BahanBaku  $bahanBaku
     * @return \Illuminate\Http\Response
     */
    public function edit(BahanBaku $bahanBaku)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\BahanBaku  $bahanBaku
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BahanBaku $bahanBaku)
    {
        $this->validate($request, [
            'nama' => 'required',
            'berat' => 'required',
            'gramasi' => 'required',
        ]);

        $bahanBaku->nama = $request->nama;
        $bahanBaku->berat = $request->berat;
        $bahanBaku->gramasi = $request->gramasi;
        $bahanBaku->save();

        return response()->json([
            'message' => 'Data Berhasil Diubah'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\BahanBaku  $bahanBaku
     * @return \Illuminate\Http\Response
     */
    public function destroy(BahanBaku $bahanBaku)
    {
        $bahanBaku_>delete();

        return response()->json([
            'message' => 'Data Berhasil Diubah'
        ], 201);
    }
}
