<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Session\Store;
use Illuminate\Support\Facades\DB;
use App\Artikel;
use Storage;

class ArtikelController extends Controller
{
    function index()
    {
//        return DB::table('artikel')->get();
        // SELECT * FROM artikel
//        $artikel = Artikel::all();
        $artikel = Artikel::where('status')->get();
        $lokasi_gambar = Storage::disk('gambar_dir')->url('/');
        //querty builder
        $artikel = Artikel::all();

        return view('list_artikel', ['artikel' => $artikel, 'lokasi_gambar' => $lokasi_gambar]);
    }

    function newArtikel()
    {
        return view('artikel_baru');
    }

    function simpanArtikel(Request $request, $id=null)
    {
        $judul = $request->judul;
        $konten = $request->konten;
        $status = $request->status;

            //query builder
//        $simpan = DB::table('artikel')->insert([
//            'judul_artikel' => $judul,
//            'content_artikel' => $konten,
//            'status' => $status
//        ]);

        $simpan = new Artikel;
        if (null !== $id){
            $simpan = Artikel::find($id);
        } else{
            $simpan = new Artikel;
        }

        if ($request->hasFile('gambar')){
            $gambar = $request->file('gambar');
            $store = Storage::disk('gambar_dir')->put('/', $gambar);
//            $store = Storage::disk('gambar_dir')->putFileAs('/', $gambar);
            $simpan->gambar = basename($store);
        }

        $simpan->judul_artikel = $judul;
        $simpan->content_artikel = $konten;
        $simpan->status = $status;
        $simpan->save();

        if($simpan){
            return redirect()->route('artikel.index');
        }
    }

    function edit($id)
    {
        $edit = Artikel::find($id);

        return view('show_artikel', ['edit' => $edit, 'id' => $id]);
    }

    function delete($id)
    {
        $artikel = Artikel::find($id);

        if ($artikel->delete()){
            $store = Storage::disk('gambar_dir')->delete('/', $artikel->gambar);
            return redirect()->route('artikel.index');
        }
    }
}
