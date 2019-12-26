<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('rawat_inap/M_transaksi');
    }
    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_data('data_pelayanan_pasien')->result();
        $this->template->load('sim_klinik/template/rawat_inap', 'sim_klinik/konten/rawat_inap/transaksi/tambah', $data);
    }
}
