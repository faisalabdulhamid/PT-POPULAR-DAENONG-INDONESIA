<?php

namespace App\Http\Controllers;

use App\Entities\Supplier;
use App\Http\Requests\SupplierRequest;
use App\Http\Requests\SupplierUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SupplierController extends Controller
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
    public function store(Request $request)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email|unique:supplier',
            'no_telepon' => 'required|unique:supplier|min:12',
            'alamat' => 'required',
            '*.*.bahan_baku_id' => 'required',
        ]);

        DB::transaction(function () use($request){
            $supplier = new Supplier();
            $supplier->nama = $request->nama;
            $supplier->email = $request->email;
            $supplier->no_telepon = $request->no_telepon;
            $supplier->alamat = $request->alamat;
            $supplier->save();

            foreach ($request->bahan_baku as $value) {
                $supplier->bahanBaku()->attach($value['bahan_baku_id']);
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
    public function show($id)
    {
        $supplier = new Supplier();
        $item = $supplier->with('bahanBaku')->get()->find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Entities\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $sup  = $supplier;
        $supplier = new Supplier();
        $item = $supplier->with(['bahanBaku' => function($query){
            $query->select('bahan_baku_id');
        }])->get()->find($id);
        
        return response()->json($item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Entities\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $this->validate($request, [
            'nama' => 'required',
            'email' => 'required|email',
            'no_telepon' => 'required|min:12',
            'alamat' => 'required',
            '*.*.bahan_baku_id' => 'required',
        ]);

        DB::transaction(function () use($supplier, $request){
            $supplier->nama = $request->nama;
            $supplier->email = $request->email;
            $supplier->no_telepon = $request->no_telepon;
            $supplier->alamat = $request->alamat;
            $supplier->save();
            $supplier->bahanBaku()->sync($request->bahan_baku);
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
