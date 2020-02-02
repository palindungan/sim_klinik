<?php
class History_akomodasi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // if ($this->session->userdata('akses') == "") {
        //     redirect('login');
        // } else if ($this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == 'Administrasi') {
        // } else {
        //     show_404();
        // }
        $this->load->model('rawat_inap/M_akomodasi');
    }

    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/rawat_inap/akomodasi/history');
    }

    public function tampil_data_akomodasi()
    {
        require('assets/sb_admin_2/vendor/fast_load_datatable/ssp.class.php');

        // DB table to use
        $table = 'akomodasi_rawat_inap';

        // Table's primary key
        $primaryKey = 'no_akomodasi_rawat_i';

        $columns = array(
            array('db' => 'tgl_transaksi', 'dt' => 0),
            array('db' => 'no_akomodasi_rawat_i', 'dt' => 1),
            array('db' => 'grand_total', 'dt' => 2),
        );

        // koneksiDatatable ambil dari custom helper
        echo json_encode(
            SSP::simple($_GET, koneksiDatatable(), $table, $primaryKey, $columns)
        );
    }

    public function detail_akomodasi($id)
    {
        $where_no_akomodasi = array(
            'no_akomodasi_rawat_i' => $id
        );

        $data['record'] = $this->M_akomodasi->get_data('daftar_detail_akomodasi_rawat_inap_lain', $where_no_akomodasi)->result();

        // ambil detail akomodasi alkes
        $data['detail_record_lain'] = $this->M_akomodasi->get_data('daftar_detail_akomodasi_rawat_inap_lain', $where_no_akomodasi)->result();
        $data['detail_record_logistik'] = $this->M_akomodasi->get_data('daftar_detail_akomodasi_rawat_inap_logistik', $where_no_akomodasi)->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/rawat_inap/akomodasi/detail', $data);
    }
}