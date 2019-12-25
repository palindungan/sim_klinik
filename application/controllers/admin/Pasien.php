<?php
class Pasien extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_pasien');
    }
    public function index()
    {
        $data['record'] = $this->M_pasien->tampil_data('pasien')->result();
        $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/pasien/tampil',$data);
    }
}
