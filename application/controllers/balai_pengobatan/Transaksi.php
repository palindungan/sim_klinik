<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('balai_pengobatan/M_transaksi');
    }
    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_join()->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/balai_pengobatan/transaksi/tambah',$data);
    }
    

}
