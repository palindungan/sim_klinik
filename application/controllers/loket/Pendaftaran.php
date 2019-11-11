<?php
class Pendaftaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('loket/M_pendaftaran');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/pendaftaran/tampil');
    }
    public function add()
    {
        $this->template->load('sim_klinik/template/loket','sim_klinik/konten/loket/pendaftaran/tambah');
    }
}
