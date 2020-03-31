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
    return view('welcome');
});

//Route::get('/halo', function() {
//   return "<h1>Helo Laravel</h1>";
//});

Route::get('/halo/{nama?}', function($nama="nama belum ada") {
    return "<h1>Helo $nama, url route: " . route('sapa') . "</h1>";
})->name('sapa');

Route::get('/halo', function() {
    return route('halo');
})->name('halo');

Route::prefix('post')->name('post.')->group(function(){
   Route::get('artikel-1', function (){
      return 'ini artikel 1';
   })->name('art-1');

   Route::get('artikel-2', function (){
      return 'ini artikel 2';
   })->name('art-2');

   Route::get('artikel-3', function (){
       return 'ini artikel 3';
   })->name('art-3');
});

Route::get('ambil-url', function (){
    return route('post.art-1');
});

//Route::get('tes-controller/{nama}','TesController@coba');
Route::get('tes-controller/provinsi','TesController@provinsi');
Route::get('tes-view/{nama}', 'TesController@cobaview');

Route::prefix('artikel')->name('artikel.')->group(function (){
    Route::get('artikel','ArtikelController@index')->name('index');
    Route::get('new','ArtikelController@newArtikel')->name('newArtikel');
    Route::post('simpan/{id?}','ArtikelController@simpanArtikel')->name('simpanArtikel');
    Route::get('edit/{id}', 'ArtikelController@edit')->name('editArtikel');
    Route::get('delete/{id}', 'ArtikelController@delete')->name('deleteArtikel');
});
