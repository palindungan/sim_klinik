<?php
class LabCheckup extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('loket/M_labCheckup');
    }
    public function index()
    {
        // $data['record'] = $this->M_labCheckup->tampil_data('lab_checkup')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/lab_checkup/tampil');
    }
}
