<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('rawat_inap/M_transaksi');
        date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_data('data_pelayanan_pasien_default')->result();
        $this->template->load('sim_klinik/template/rawat_inap', 'sim_klinik/konten/rawat_inap/transaksi/tambah', $data);
    }

    public function tampil_daftar_kamar()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('kamar_rawat_inap')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('rawat_inap_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_obat()
    {
        $where_qty_obat = array(
            'qty >' => 0
        );  
        $data_tbl['tbl_data'] = $this->M_transaksi->get_data('daftar_obat_rawat_inap',$where_qty_obat)->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function input_transaksi_form()
    {
        
    }
}
