<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provinsi extends Model
{

    function kota()
    {
        return $this->hasMany('App\Kota', 'id_provinsi');
    }
}
