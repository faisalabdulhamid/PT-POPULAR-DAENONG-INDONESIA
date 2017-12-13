<?php

namespace App\Http\Controllers;

use App\Entities\Pelanggan;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(['auth']);
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
            $pelanggan = Pelanggan::orderBy('nama_perusahaan')->paginate(10);

            return response()->json($pelanggan, 200);
        }

        $title = 'Pelanggan';
        $script = asset('js/pelanggan.js');

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
            'nama_perusahaan' => 'required',
            'email' => 'required|unique:pelanggan|email',
            'no_telepon' => 'required|unique:pelanggan|min:12',
            'alamat' => 'required',
        ]);

        $pelanggan = new Pelanggan();
        $pelanggan->nama_perusahaan = $request->nama_perusahaan;
        $pelanggan->email = $request->email;
        $pelanggan->no_telepon = $request->no_telepon;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return response()->json([
            'message' => 'Data Berhasil Ditambahkan'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pelanggan = Pelanggan::with(['pesanan' => function($query){
            $query->orderBy('tanggal')->withoutGlobalScope('notProduksi');
        }])->get()->find($id);
        return response()->json($pelanggan);   
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function edit(Pelanggan $pelanggan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pelanggan $pelanggan)
    {
        $this->validate($request, [
            'nama_perusahaan' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required|min:12',
            'alamat' => 'required',
        ]);

        $pelanggan->nama_perusahaan = $request->nama_perusahaan;
        $pelanggan->email = $request->email;
        $pelanggan->no_telepon = $request->no_telepon;
        $pelanggan->alamat = $request->alamat;
        $pelanggan->save();

        return response()->json([
            'message' => 'Data Berhasil Diubah'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Pelanggan  $pelanggan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pelanggan $pelanggan)
    {
        $pelanggan->delete();

        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 201);
    }
}
