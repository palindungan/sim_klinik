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
    public function list($id)
    {
        $data['list'] = $this->M_pasien->list_kunjung('pelayanan',$id)->result();
        $pasien= $this->M_pasien->detail_pasien('pasien',$id)->row();
        $data['pasien'] = $pasien->nama;
        $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/pasien/list_kunjung',$data);
    }
    public function detail($id)
    {
        $data['pelayanan'] = $this->M_pasien->detail_pelayanan('pelayanan',$id)->row();
        $pelayanan = $this->M_pasien->detail_pelayanan('pelayanan',$id)->row();
        $no_rm = $pelayanan->no_rm;
        $data['pasien'] = $this->M_pasien->ambil_nama('pasien',$no_rm)->row();
        $kia_penanganan =  $this->M_pasien->ambil_no_kia('kia_penanganan',$id)->row();
        $no_kia_p = $kia_penanganan->no_kia_p;
        $data['tindakan_kia'] = $this->M_pasien->detail_tindakan_kia($no_kia_p)->result();
        $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/pasien/detail',$data);
    }
}
