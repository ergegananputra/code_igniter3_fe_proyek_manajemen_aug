<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProyekModel extends CI_Model{
    public $id;
    public $nama_proyek;
    public $client;
    public $tgl_mulai;
    public $tgl_selesai;
    public $pimpinan_proyek;
    public $keterangan;
    public $created_at;
    public $lokasis = [];

    public function __construct($data = null) {
        parent::__construct();
        if ($data) {
            $this->initialize($data);
        }
    }

    public function initialize($data) {
        $this->id = $data['id'];
        $this->nama_proyek = $data['nama_proyek'];
        $this->client = $data['client'];
        $this->tgl_mulai = $data['tgl_mulai'];
        $this->tgl_selesai = $data['tgl_selesai'];
        $this->pimpinan_proyek = $data['pimpinan_proyek'];
        $this->keterangan = $data['keterangan'];
        $this->created_at = $data['created_at'];

        $lokasis = [];
        foreach ($data['lokasis'] as $lokasi) {
            $lokasiModel = new LokasiModel();
            $lokasiModel->initialize($lokasi);
            $lokasis[] = $lokasiModel;
        }

        $this->lokasis = $lokasis;
    }
}