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
        $data['antrian_bp'] = $this->M_antrian->tampil_data('antrian_balai_pengobatan')->result();
        $data['antrian_kia'] = $this->M_antrian->tampil_data('antrian_kesehatan_ibu_dan_anak')->result();
        $data['antrian_lab'] = $this->M_antrian->tampil_data('antrian_laboratorium')->result();
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/antrian/tampil', $data);
    }
}
