<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


// Route::resource('pegawai', 'PegawaiController')->middleware(['auth:api']);
// Route::resource('pelanggan', 'PelangganController')->middleware(['auth:api']);
// Route::resource('supplier', 'SupplierController')->middleware(['auth:api']);//Supplier + Bahan Baku
// Route::resource('produk', 'ProdukController')->middleware(['auth:api']);
// Route::resource('bahan-baku', 'BahanBakuController')->middleware(['auth:api']);
// Route::resource('pesanan', 'PesananController')->middleware(['auth:api']);

// Route::group(['prefix'=>'select', 'middleware'=> 'auth:api'], function(){
// 	Route::get('/bahan-baku', function(){
// 		$bahan = App\Entities\BahanBaku::all();
// 		return response()->json($bahan);
// 	});	
// });
