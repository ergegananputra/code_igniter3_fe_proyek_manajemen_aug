<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Lokasi extends CI_Controller {
    public function __construct() {
        parent::__construct();
    
        $this->load->model('LokasiModel');
        $this->load->library('form_validation');
        $this->load->helper('url');
    }

    public function index() {
        $data['title'] = 'Manajemen Lokasi';
        $data['lokasis'] = $this->get_all();
        
        $this->load->view('templates/header', $data);
        $this->load->view('lokasi/index', $data);
        $this->load->view('templates/footer');
    }

    public function create() {
        $data['title'] = 'Tambah Lokasi';
        
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('negara', 'Negara', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('kota', 'Kota', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->view_form($data);
        } else {
            $this->store();
        }
    }

    public function edit($id) {
        $data['title'] = 'Edit Lokasi';
        $data['lokasi'] = $this->get_lokasi($id);
        
        $this->form_validation->set_rules('nama_lokasi', 'Nama Lokasi', 'required');
        $this->form_validation->set_rules('negara', 'Negara', 'required');
        $this->form_validation->set_rules('provinsi', 'Provinsi', 'required');
        $this->form_validation->set_rules('kota', 'Kota', 'required');
        
        if ($this->form_validation->run() === FALSE) {
            $this->view_form($data);
        } else {
            $this->update($id);
        }
    }
    
    public function delete($id) {
        $url = API_HOST . '/lokasi';
        $request = json_encode(['id' => $id]);
        $response = call_api($url, ['Content-Type: application/json'] , 'DELETE', $request);
        $result = json_decode($response, true);

        if ($result["data"] != null) {
            $this->session->set_flashdata('success', 'Lokasi berhasil dihapus');
            redirect('lokasi');
        } else {
            $error_message = $result["message"];
            $this->session->set_flashdata('error', 'Lokasi gagal dihapus. '. $error_message);
            redirect('lokasi');
        }
    }


    private function view_form($data) {
        $this->load->view('templates/header', $data);
        $this->load->view('lokasi/form', $data);
        $this->load->view('templates/footer');
    }

    private function store() {
        $lokasi = [
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'negara' => $this->input->post('negara'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota')
        ];

        $url = API_HOST . '/lokasi';
        $request = json_encode($lokasi);
        $response = call_api($url, ['Content-Type: application/json'] , 'POST', $request);

        $result = json_decode($response, true);
        if ($result["data"] != null) {
            $this->session->set_flashdata('success', 'Lokasi berhasil ditambahkan');
            redirect('lokasi');
        } else {
            $error_message = $result["message"];
            $this->session->set_flashdata('error', 'Lokasi gagal ditambahkan. '. $error_message);
            redirect('lokasi/create');
        }
    }

    private function update($id) {
        $isEdit = $this->input->post('isEdit');
        if ($isEdit == 'false') {
            $this->session->set_flashdata('error', 'Proyek tidak ditemukan.');
            redirect('proyek');
        }

        $lokasi = [
            'id' => $id,
            'nama_lokasi' => $this->input->post('nama_lokasi'),
            'negara' => $this->input->post('negara'),
            'provinsi' => $this->input->post('provinsi'),
            'kota' => $this->input->post('kota')
        ];

        $url = API_HOST . '/lokasi';
        $request = json_encode($lokasi);
        $response = call_api($url, ['Content-Type: application/json'] , 'PUT', $request);

        $result = json_decode($response, true);
        if ($result["data"] != null) {
            $this->session->set_flashdata('success', 'Lokasi berhasil diubah');
            redirect('lokasi');
        } else {
            $error_message = $result["message"];
            $this->session->set_flashdata('error', 'Lokasi gagal diubah. '. $error_message);
            redirect('lokasi/edit/' . $id);
        }
    }

    private function get_lokasi($id) {
        $url = API_HOST . '/lokasi/' . $id;
        $response = call_api($url);
        $lokasi = json_decode($response, true);

        return new LokasiModel($lokasi["data"]);
    }



    public function get_all() {
        $url = API_HOST . '/lokasi';
        $response = call_api($url);
        $lokasi = json_decode($response, true);

        if ($lokasi["data"] == null) {
            return null;
        }

        $lokasis = [];
        foreach ($lokasi["data"] as $lokasi) {
            $lokasis[] = (object) $lokasi;
        }

        return $lokasis;
    }
}
