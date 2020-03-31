<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Provinsi;

class TesController extends Controller
{
    function coba($nama)
    {
        return 'coba '. $nama;
    }

    function cobaview($nama)
    {
        return view('beranda', ['nama' => $nama]);
    }

    function provinsi()
    {
        $prov = provinsi::with('kota')->get();

        dd($prov[0]->kota());
    }
}


