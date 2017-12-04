<?php

namespace App\Http\Controllers;

use App\Entities\Pegawai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PegawaiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $pegawai = Pegawai::paginate(10);

            return response()->json($pegawai, 200);
        }
        
        $title = 'Pegawai';
        $script = asset('js/pegawai.js');

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
            'email' => 'required|email|unique:pegawai',
            'password' => 'required|min:6',
            'no_telepon' => 'required|min:12|unique:pegawai',
            'alamat' => 'required',
            'divisi' => 'required|in:marketing,admin,purchasing,produksi,exsim',
        ]);

        $pegawai = new Pegawai();
        $pegawai->nama = $request->nama;
        $pegawai->email = $request->email;
        $pegawai->password = bcrypt($request->password);
        $pegawai->no_telepon = $request->no_telepon;
        $pegawai->alamat = $request->alamat;
        $pegawai->divisi = $request->divisi;
        $pegawai->save();

        return response()->json([
            'message' => 'Data Berhasil Ditambahkan',
        ], 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function show(Pegawai $pegawai)
    {
        return response()->json($pegawai);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function edit(Pegawai $pegawai)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pegawai $pegawai)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'min:6',
            'no_telepon' => 'required|min:12',
            'alamat' => 'required',
            'divisi' => 'required|in:marketing,admin,purchasing,produksi,exsim',
        ]);

        if(!is_null($request->password)){
            $pegawai->password = bcrypt($request->password);    
        }

        $pegawai->nama = $request->nama;
        $pegawai->no_telepon = $request->no_telepon;
        $pegawai->alamat = $request->alamat;
        $pegawai->divisi = $request->divisi;
        $pegawai->save();

        return response()->json([
            'message' => 'Data Berhasil Diubah',
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Pegawai  $pegawai
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pegawai $pegawai)
    {
        $pegawai->delete();

        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 201);
    }
}
