<?php

namespace App\Http\Controllers;

use App\Entities\Pengiriman;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PengirimanController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
        $this->middleware('ajax')->except(['index', 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->wantsJson()) {
            $pengiriman = Pengiriman::belumKirim()->paginate(10);

            return response()->json($pengiriman, 200);
        }
        
        $title = 'Pengiriman';
        $script = asset('js/pengiriman.js');

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

        return response()->json([
            'message' => 'Pengiriman Berhasil'], 
            201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (request()->wantsJson()) {
            $pengiriman = Pengiriman::history()->paginate(10);

            return response()->json($pengiriman, 200);
        }
        
        $title = 'History Pengiriman';
        $script = asset('js/history-pengiriman.js');

        return view('index', compact('title', 'script'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)//history
    {
        
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
        $pengiriman = Pengiriman::find($id);
        $pengiriman->tanggal_kirim = Carbon::now();
        $pengiriman->save();
        return response()->json([
            'message' => 'Pengiriman Berhasil'], 
            201);
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
