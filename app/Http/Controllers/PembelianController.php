<?php

namespace App\Http\Controllers;

use App\Entities\Pembelian;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembelianController extends Controller
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
            $pembelian = Pembelian::paginate(10);
            return response()->json($pembelian);
        }
        $title = 'Pembelian';
        $script = asset('js/pembelian.js');

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
            'supplier_id' => 'required',
            '*.*.bahan_baku_id' => 'required',
            '*.*.jumlah' => 'required',
        ]);

        DB::transaction(function()use($request){
            $pembelian = new Pembelian();
            $pembelian->supplier_id = $request->supplier_id;
            $pembelian->save();
            foreach ($request->bahan_baku as $key => $value) {
                $pembelian->bahanBaku()->attach($value['bahan_baku_id'], ['jumlah'=> $value['jumlah']]);
            }
            
        });
        
        return response()->json([
            'message' => 'Data Berhasil Ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pembelian = Pembelian::with(['bahanBaku' => function($query){
            $query->select('nama', 'jumlah', 'satuan');
        }])->get()->find($id);
        return response()->json($pembelian);
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
