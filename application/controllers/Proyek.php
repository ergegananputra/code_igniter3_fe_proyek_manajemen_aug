<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Proyek extends CI_Controller {

    public function __construct() {
        parent::__construct();
    
        $this->load->model('LokasiModel');
        $this->load->model('ProyekModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        $data['title'] = 'Beranda';
        $data['proyeks'] = $this->get_atll();

        $this->load->view('templates/header', $data);
        $this->load->view('proyek/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Proyek';
        $data['lokasis'] = $this->get_all_locations();

        $this->form_validation->set_rules('nama_proyek', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('client', 'Client', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required|callback_check_date');
        $this->form_validation->set_rules('pimpinan_proyek', 'Pimpinan Proyek', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->view_form($data);
        } else {
            $this->store();
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Proyek';
        $data['lokasis'] = $this->get_all_locations();
        $data['proyek'] = $this->get_proyek($id);

        $this->form_validation->set_rules('nama_proyek', 'Nama Proyek', 'required');
        $this->form_validation->set_rules('client', 'Client', 'required');
        $this->form_validation->set_rules('tgl_mulai', 'Tanggal Mulai', 'required');
        $this->form_validation->set_rules('tgl_selesai', 'Tanggal Selesai', 'required|callback_check_date');
        $this->form_validation->set_rules('pimpinan_proyek', 'Pimpinan Proyek', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan', 'required');

        if ($this->form_validation->run() === FALSE) {
            $this->view_form($data, true);
        } else {
            $this->update($id);
        }
    }

    
    private function update($id) {
        $isEdit = $this->input->post('isEdit');
        if ($isEdit == 'false') {
            $this->session->set_flashdata('error', 'Proyek tidak ditemukan.');
            redirect('proyek');
        }

        $data = [
            'id' => $id,
            'nama_proyek' => $this->input->post('nama_proyek', true),
            'client' => $this->input->post('client', true),
            'tgl_mulai' => $this->input->post('tgl_mulai', true),
            'tgl_selesai' => $this->input->post('tgl_selesai', true),
            'pimpinan_proyek' => $this->input->post('pimpinan_proyek', true),
            'keterangan' => $this->input->post('keterangan', true),
        ];
        $url = API_HOST . '/proyek';
        $request = json_encode($data);
        $response = call_api($url, ['Content-Type: application/json'] , 'PUT', $request);
        $proyek = json_decode($response, true);

        if ($proyek['data'] != null) {
            $this->session->set_flashdata('success', 'Proyek berhasil diubah.');
            
            ob_end_clean();
            redirect('proyek');
        } else {
            $errorMessage = $proyek['message'];
            $this->session->set_flashdata('error', 'Proyek gagal diubah. ' . $errorMessage);
            $this->edit($id);
        }
    }

    public function get_atll() {
        $url = API_HOST . '/proyek';

        $response = call_api($url);
        $proyeks = json_decode($response, true);

        $proyekModels = [];
        if ($proyeks["data"] == null) {
            return $proyekModels;
        }
        if (count($proyeks["data"]) == 0) {
            return $proyekModels;
        }
        foreach ($proyeks["data"] as $proyek) {
            $proyekModel = new ProyekModel($proyek);
            $proyekModels[] = $proyekModel;
        }

        return $proyekModels;
    }


    private function get_proyek($id) {
        $url = API_HOST . '/proyek/' . $id;

        $response = call_api($url);
        $proyek = json_decode($response, true);

        if ($proyek["data"] == null) {
            return null;
        }

        return new ProyekModel($proyek["data"]);
    }
    
    private function view_form($data, $isEdit = false) {
        $this->load->view('templates/header', $data);
        $this->load->view('proyek/form', $data);
        $this->load->view('templates/footer');
    }

    private function store() {
        $data = [
            'nama_proyek' => $this->input->post('nama_proyek', true),
            'client' => $this->input->post('client', true),
            'tgl_mulai' => $this->input->post('tgl_mulai', true),
            'tgl_selesai' => $this->input->post('tgl_selesai', true),
            'pimpinan_proyek' => $this->input->post('pimpinan_proyek', true),
            'keterangan' => $this->input->post('keterangan', true),
            'lokasi_id' => $this->input->post('lokasi', true),
            'nama_lokasi' => $this->input->post('nama_lokasi', true),
            'negara' => $this->input->post('negara', true),
            'provinsi' => $this->input->post('provinsi', true),
            'kota' => $this->input->post('kota', true)
        ];
        $url = API_HOST . '/proyek';
        $request = json_encode($data);
        $response = call_api($url, ['Content-Type: application/json'] , 'POST', $request);
        $proyek = json_decode($response, true);

        if ($proyek['data'] != null) {
            $this->session->set_flashdata('success', 'Proyek berhasil ditambahkan.');
            
            ob_end_clean();
            redirect('proyek');
        } else {
            $errorMessage = $proyek['message'];
            $this->session->set_flashdata('error', 'Proyek gagal ditambahkan. ' . $errorMessage);
            $this->create();
        }      
    }

    public function delete($id) {
        $url = API_HOST . '/proyek';
        $request = json_encode(['id' => $id]);

        $response = call_api($url, ['Content-Type: application/json'] , 'DELETE', $request);
        $proyek = json_decode($response, true);

        if ($proyek['data'] != null) {
            $this->session->set_flashdata('success', 'Proyek berhasil dihapus.');
        } else {
            $errorMessage = $proyek['message'];
            $this->session->set_flashdata('error', 'Proyek gagal dihapus. ' . $errorMessage);
        }

        ob_end_clean();
        redirect('proyek');
    }

    private function get_all_locations() {
        $url = API_HOST . '/lokasi';

        $response = call_api($url);
        $lokasis = json_decode($response, true);

        $lokasiModels = [];
        if ($lokasis["data"] == null) {
            return $lokasiModels;
        }
        if (count($lokasis["data"]) == 0) {
            return $lokasiModels;
        }
        foreach ($lokasis["data"] as $lokasi) {
            $lokasiModel = new LokasiModel($lokasi);
            $lokasiModels[] = $lokasiModel;
        }

        return $lokasiModels;
    }

    public function check_date($tgl_selesai) {
        $tgl_mulai = $this->input->post('tgl_mulai');
        if (strtotime($tgl_selesai) < strtotime($tgl_mulai)) {
            $this->form_validation->set_message('check_date', 'Tanggal Selesai tidak boleh sebelum Tanggal Mulai.');
            return FALSE;
        } else {
            return TRUE;
        }
    }

}