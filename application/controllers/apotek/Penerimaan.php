<?php
class Penerimaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apotek/M_penerimaan');
    }
    public function index()
    {
        $where = array(
            'layanan_tujuan' => 'Balai Pengobatan',
        );

        // $data['record'] = $this->M_penerimaan->get_data('data_pelayanan_pasien', $where)->result();
        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/penerimaan/tambah');
    }
}
