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
    public function detail($id)
    {
        $data['pelayanan'] = $this->M_pasien->detail_pelayanan('pelayanan',$id)->result();
        $data['pasien'] = $this->M_pasien->detail_pasien('pasien',$id)->result();
        $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/pasien/detail',$data);
    }
}
