<?php
// defined("BASEPATH") or die("No Direct Access Allowed");

Class RekapTagihan extends CI_Controller{
    function __construct(){
        parent::__construct();
        if($this->session->userdata('akses') == ""){
            redirect('login');
        }else if($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Administrasi' || $this->session->userdata('akses') == 'Rawat Inap'){
            
        }else{
            show_404();
        }
        $this->load->model('administrasi/M_tagihan');
    }

    function index(){
        $data['record'] = $this->M_tagihan->getRekap()->result(); 
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/administrasi/tagihan/rekap_tagihan',$data);
    }
}