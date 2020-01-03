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
        $data['record'] = $this->M_pasien->tampil_pasien('data_pelayanan_pasien_default')->result();
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
        $tujuan_pelayanan = $pelayanan->layanan_tujuan;
        $data['pasien'] = $this->M_pasien->ambil_nama('pasien',$no_rm)->row();


            $obat_penanganan =  $this->M_pasien->ambil_no_obat('penjualan_obat_apotik',$id)->row();
            $no_obat = $obat_penanganan->no_penjualan_obat_a;
            $data['detail_obat'] = $this->M_pasien->detail_obat($no_obat)->result();
        
        
        $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/pasien/detail',$data);
    }
}
