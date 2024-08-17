<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LokasiModel extends CI_Model {
    public $id;
    public $nama_lokasi;
    public $negara;
    public $provinsi;
    public $kota;
    public $created_at;
    public $proyeks;

    public function __construct($data = null) {
        parent::__construct();
        if ($data) {
            $this->initialize($data);
        }
    }

    public function initialize($data) {
        $this->id = $data['id'];
        $this->nama_lokasi = $data['nama_lokasi'];
        $this->negara = $data['negara'];
        $this->provinsi = $data['provinsi'];
        $this->kota = $data['kota'];
        $this->created_at = $data['created_at'];
    }
}