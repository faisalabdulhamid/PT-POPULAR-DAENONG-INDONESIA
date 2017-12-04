<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

// Route::get('/', 'HomeController@index')->name('home');
Route::get('/', function(){
	return view('home');
})->name('home')->middleware(['auth']);

Route::get('pegawai', 'PegawaiController@index')->middleware(['auth'])->name('pegawai');
Route::get('pelanggan', 'PelangganController@index')->middleware(['auth'])->name('pelanggan');
Route::get('supplier', 'SupplierController@index')->middleware(['auth'])->name('supplier');
Route::get('produk', 'ProdukController@index')->middleware(['auth'])->name('produk');
Route::get('bahan-baku', 'BahanBakuController@index')->middleware(['auth'])->name('bahan-baku');
Route::get('pesanan', 'PesananController@index')->middleware(['auth'])->name('pesanan');