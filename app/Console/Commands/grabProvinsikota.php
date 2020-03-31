<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use GuzzleHttp\Client;
use App\Provinsi;
use App\Kota;

class grabProvinsikota extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'ambil:provinsi';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command untuk mengambil list provinsi dan kota melalui API';

    protected $baseUrl = "http://api.lanuma.web.id/";

    protected $api;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->api = new client([
            'base_uri' => $this->baseUrl,
            'timeout' => '30'
        ]);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $provinsi = json_decode($this->api->request("GET", 'provinsi/')->getBody());
        $kota = json_decode($this->api->request("GET", 'kota/')->getBody());

        foreach ($provinsi as $prov)
        {
            $provinsi_model = new Provinsi;
            $provinsi_model->id = $prov->kode;
            $provinsi_model->nama_provinsi = $prov->nama;
            $provinsi_model->save();
        }

        foreach ($kota as $kot)
        {
            list($prov_id, $kota_id) = $this->split_id($kot->kode);
            $kota_model = new Kota;
            $kota_model->id = $kot->kode;
            $kota_model->id_provinsi = $prov_id;
            $kota_model->nama_kota = $kot->nama;
            $kota_model->save();
        }
        //        echo ($kota->getBody());
    }

    //1122
    private function split_id($id)
    {
        return str_split($id, 2);
    }
}
