<?php
defined("BASEPATH") or die("No Direct Access Allowed");

Class RekapTagihan extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('akses') == ""){
            redirect('login');
        }else if($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Administrasi' 
        || $this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == "Loket"){
            
        }else{
            show_404();
        }
        $this->load->model('administrasi/M_tagihan');
    }

    function index(){
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/administrasi/tagihan/rekap_tagihan');
    }
    function tampil_data_tagihan()
    {
        require('assets/sb_admin_2/vendor/fast_load_datatable/ssp.class.php');

        // DB table to use
        $table = 'rekap_tagihan';

        // Table's primary key
        $primaryKey = 'no_ref_pelayanan';
        $filter = $_GET['filter'];
        if($filter == 'Belum Lunas' || $filter == 'Lunas'){
            $whereAll = "status_pembayaran ='$filter'";
        }
        

        $columns = array(
            array('db' => 'tgl_pelayanan', 'dt' => 0),
            array('db' => 'no_ref_pelayanan', 'dt' => 1),
            array('db' => 'no_rm', 'dt' => 2),
            array('db' => 'nama', 'dt' => 3),
            array('db' => 'tipe_pelayanan', 'dt' => 4),
            array('db' => 'status_pembayaran', 'dt' => 5)
        );

        // koneksiDatatable ambil dari custom helper
        if($filter == 'Belum Lunas' || $filter == 'Lunas'){
            echo json_encode(SSP::simple($_GET, koneksiDatatable(), $table, $primaryKey, $columns, $whereAll));
        }else{
            echo json_encode(SSP::simple($_GET, koneksiDatatable(), $table, $primaryKey, $columns));
        }
    }

    
}
