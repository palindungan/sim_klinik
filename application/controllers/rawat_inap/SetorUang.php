<?php

Class SetorUang extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('rawat_inap/M_setor_uang');
        $this->load->model('administrasi/M_tagihan');
        $this->load->model('rawat_inap/M_akomodasi');
        $this->load->model('M_v_rawat_inap');
        
    }
    
    function index(){
        $data['record'] = $this->M_setor_uang->getDataSetorUang();
        
        //Mendapatkan Saldo Terakhir
        $count_transaction = $this->M_v_rawat_inap->countRecordWithTglKeluarParam();
        $data['jumlah_saldo'] = "";
        if($count_transaction==0){
            $data['jumlah_saldo'] = 0;
        }else if($count_transaction > 0){
            foreach($this->M_v_rawat_inap->getLastRecordWithTglKeluarParam() as $i){
                $data['jumlah_saldo'] = $i->temp_saldo;    
            }
        }

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/rawat_inap/setor_uang/v_setor_uang',$data);
    }
    function store(){
        //Mendapatkan No Referensi Pelayanan
        $no_ref_pelayanan = "";
        foreach($this->M_v_rawat_inap->getLastRecordWithTglKeluarParam() as $i){
            $tipe_saldo = $i->tipe_saldo;
            $no_ref_pelayanan = $i->no_ref_pelayanan;
            $no_akomodasi = $i->no_akomodasi;
        }
        if($tipe_saldo == "Pelayanan"){

            //Update Tabel Pelayanan
            $where_no_ref_pelayanan = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $data_update_pelayanan = array(
                'temp_saldo' => $this->input->post('sisa_saldo')
            );
            $this->M_tagihan->update_data($where_no_ref_pelayanan,'pelayanan',$data_update_pelayanan);
        }else{
            //Update Tabel Akomodasi
            $where = array(
                'no_akomodasi_rawat_i' => $no_akomodasi
            );
            $data_update = array(
                'temp_saldo' => $this->input->post('sisa_saldo')
            );
            $this->M_akomodasi->update_data($where,'akomodasi_rawat_inap',$data_update);
        }
        //Tambah History
        $data = array(
            'tanggal_setor' => date('Y-m-d H:i:s'),
            'jumlah_setor' => $this->input->post('jumlah_setor')
        );
        $this->M_setor_uang->inputSetorUang($data);
        
        //Success
        $this->session->set_flashdata('success','Ditambahkan');
        redirect('rawat_inap/setorUang');
    }
}