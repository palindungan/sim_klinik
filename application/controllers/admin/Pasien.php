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

        if($tujuan_pelayanan == "Poli KIA")
        {
            // ambil detail penanganan kia
            $kia_penanganan =  $this->M_pasien->ambil_no_kia('kia_penanganan',$id)->row();
            $no_kia_p = $kia_penanganan->no_kia_p;
            $data['tindakan_kia'] = $this->M_pasien->detail_tindakan_kia($no_kia_p)->result();
        }
        else if($tujuan_pelayanan == "Balai Pengobatan")
        {
            // ambil detail penanganan BP
            $bp_penanganan =  $this->M_pasien->ambil_no_bp('bp_penanganan',$id)->row();
            $no_bp_p = $bp_penanganan->no_bp_p;
            $data['tindakan_bp'] = $this->M_pasien->detail_tindakan_bp($no_bp_p)->result();
        }
        else if($tujuan_pelayanan == "Laboratorium")
        {
            // ambil detail penanganan lab
            $lab_transaksi =  $this->M_pasien->ambil_lab_transaksi('lab_transaksi',$id)->row();
            $no_lab_t = $lab_transaksi->no_lab_t;
            $data['tindakan_lab'] = $this->M_pasien->detail_lab_transaksi($no_lab_t)->result();
        }
        else if($tujuan_pelayanan == "UGD")
        {
            // ambil detail penanganan UGD
            $ugd_penanganan =  $this->M_pasien->ambil_no_ugd('ugd_penanganan',$id)->row();
            $no_ugd_p = $ugd_penanganan->no_ugd_p;
            $data['tindakan_ugd'] = $this->M_pasien->detail_tindakan_ugd($no_ugd_p)->result();
        }
        
        
        $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/pasien/detail',$data);
    }
}
