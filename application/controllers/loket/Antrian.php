<?php
class Antrian extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('loket/M_antrian');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/antrian/tampil');
    }
}
