<?php

namespace App\Http\Controllers;

use App\Entities\Supplier;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\SupplierUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(request()->wantsJson())
        {
            $supplier = Supplier::paginate(10);

            return response()->json($supplier, 200);
        }

        $title = 'Supplier';
        $script = asset('js/supplier.js');

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
    public function store(SupplierRequest $request)
    {
        // $this->validate($request, [
        //     'nama' => 'required',
        //     'email' => 'required|email|unique:supplier',
        //     'no_telepon' => 'required|unique:supplier|min:12',
        //     'alamat' => 'required',
        //     'bahan_baku' => 'required',
        // ]);

        DB::transaction(function () use($request){
            $supplier = new Supplier();
            $supplier->nama = $request->nama;
            $supplier->email = $request->email;
            $supplier->no_telepon = $request->no_telepon;
            $supplier->alamat = $request->alamat;
            $supplier->save();

            foreach ($request->bahan_baku as $value) {
                $supplier->bahanBakus()->attach($value['bahan_baku_id'], [
                    'jumlah' => $value['jumlah']
                ]);
            }
        });
        


        return response()->json([
            'message' => 'Data Berhasil Ditambahkan',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Entities\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        return response()->json($supplier->with('bahanBakus')->get());
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $item = $supplier->with('bahanBaku')->get();

        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(SupplierUpdateRequest $request, Supplier $supplier)
    {

        DB::transaction(function () use($supplier, $request){
            $supplier->nama = $request->nama;
            $supplier->email = $request->email;
            $supplier->no_telepon = $request->no_telepon;
            $supplier->alamat = $request->alamat;
            $supplier->save();
            $supplier->bahanBakus()->sync($request->bahan_baku);
        });


        return response()->json([
            'message' => 'Data Berhasil Diubah'
        ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Entities\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return response()->json([
            'message' => 'Data Berhasil Dihapus'
        ], 201);
    }
}
