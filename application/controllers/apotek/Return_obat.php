<?php
class Return_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        // if($this->session->userdata('akses') == ""){
        //     redirect('login');
        // }else if($this->session->userdata('akses') == 'Apotek' || $this->session->userdata('akses') == 'Administrasi'){ 
            
        // }else{
        //     show_404();
        // }
        $this->load->model('apotek/M_return_obat');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/return_obat/tambah');
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_return_obat->tampil_data('data_obat')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }
}