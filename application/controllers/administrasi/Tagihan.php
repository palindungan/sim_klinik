<?php
class Tagihan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('administrasi/M_tagihan');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/administrasi', 'sim_klinik/konten/administrasi/tagihan/tambah');
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_tagihan->get_select($no_ref,$nama,'no_ref_pelayanan');
        echo json_encode($query);
    }

}
