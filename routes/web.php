<?php

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');
Route::resource('pegawai', 'PegawaiController', [
	'only' => ['index', 'store', 'show', 'update', 'destroy'], 
	'names'=> ['index' => 'pegawai']
]);
Route::resource('pelanggan', 'PelangganController', [
	'only' => ['index', 'store', 'show', 'update', 'destroy'], 
	'names'=> ['index' => 'pelanggan']
]);
Route::resource('supplier', 'SupplierController',[
	'only' => ['index', 'store', 'show', 'update', 'destroy', 'edit'], 
	'names'=> ['index' => 'supplier']
]);//Supplier + Bahan Baku
Route::resource('produk', 'ProdukController', [
	'only' => ['index', 'store', 'show', 'edit', 'update', 'destroy'], 
	'names'=> ['index' => 'produk']
]);
Route::resource('bahan-baku', 'BahanBakuController', [
	'only' => ['index', 'store', 'show', 'update', 'destroy'], 
	'names'=> ['index' => 'bahan-baku']
]);
Route::resource('pesanan', 'PesananController',[
	'only' => ['index', 'store', 'show', 'update', 'destroy'], 
	'names'=> ['index' => 'pesanan']
]);
Route::resource('pembelian', 'PembelianController', [
	'only' => ['index', 'store', 'show'], 
	'names'=> ['index' => 'pembelian']
]);
Route::resource('produksi', 'ProduksiController', [
	'only' => ['index', 'store', 'show'], 
	'names'=> ['index' => 'produksi', 'show' => 'jadwal']
]);
Route::resource('pengiriman', 'PengirimanController', [
	'only' => ['index', 'update', 'show'], 
	'names'=> ['index' => 'pengiriman', 'show'=>'history']
]);


Route::group(['prefix'=>'select'], function(){
	Route::get('/bahan-baku', function(){
		$bahan = App\Entities\BahanBaku::all();
		return response()->json($bahan);
	});	
	Route::get('/supplier/{id}', function($id){
		$bahan = App\Entities\Supplier::has('bahanBaku')->whereHas('bahanBaku', function($q) use($id){
			$q->where('bahan_baku_id', $id);
		})->get();
		return response()->json($bahan);
	});
	Route::get('supplier', function(){
		$supplier = App\Entities\Supplier::all();
		return response()->json($supplier);
	});
	Route::get('/bahan-baku/{id}', function($id){
		$bahan = App\Entities\BahanBaku::whereHas('suppliers', function($q)use($id){
				$q->where('supplier_id', $id);
			})->get();
		return response()->json($bahan);
	});	
	Route::get('/pelanggan', function(){
		$pelanggan = App\Entities\Pelanggan::orderBy('nama_perusahaan')->get();
		return response()->json($pelanggan);
	});	
	Route::get('/produk', function(){
		$produk = App\Entities\Produk::all();
		return response()->json($produk);
	});
});

Route::get('users', function(){
	$user = Illuminate\Support\Facades\Auth::user();
	return response()->json($user);
})->middleware(['auth', 'ajax']);//->middleware('auth');