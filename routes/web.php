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

Route::get('/', function () {
    return view('auth/login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


Route::group(['prefix' => 'admin', 'middleware' => ['auth']], function () {
    Route::resource('kategori', 'KategoriController');
    Route::resource('barang', 'BarangController');
    Route::resource('konsumen', 'KonsumenController');
    Route::resource('peminjaman', 'PeminjamanController');
    Route::resource('pengembalian', 'PengembalianController');
});

Route::get('/peminjaman/getIdkonsumen', 'PeminjamanController@getIdKonsumen');

// eksport pengembalian
Route::get('/pdf/{id}', 'PengembalianController@pdf')->name('pdf');
Route::post('filter/pengembalian', 'PengembalianController@laporan1')->name('filter/pengembalian');
Route::post('laporan/pengembalian/pdf', 'PengembalianController@laporan2')->name('laporan/pengembalian/pdf');
Route::post('laporan/pdf', 'PengembalianController@laporan3')->name('laporan/pdf');
