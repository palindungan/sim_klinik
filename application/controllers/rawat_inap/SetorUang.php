<?php

Class SetorUang extends CI_Controller{
    
    function __construct(){
        parent::__construct();
        $this->load->model('rawat_inap/M_setor_uang');
        $this->load->model('M_cek_saldo');
        $this->load->model('admin/M_laporan');
        }
    
    function index(){
        $data['record'] = $this->M_setor_uang->getDataSetorUang();
        
        //Mendapatkan Saldo Terakhir
        $data['jumlah_saldo'] = $this->getLastSaldoRI();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/rawat_inap/setor_uang/v_setor_uang',$data);
    }

    function getLastSaldoRI(){
        //Get Saldo Kemarin
        $yesterday = date("Y-m-d",strtotime("-1 day",strtotime(date('Y-m-d'))));
        $saldo_kemarin =  $this->M_cek_saldo->getCekSaldoByDate($yesterday); //Diambil Record Hari Kemarin Dari Tabel Saldo Temp
        //Mengambil Data
        $day = date('Y-m-d');
        $data =  $this->M_laporan->get_laporan_ri_by_date($day);
        //Inisialisasi
        $total_akomodasi = 0;
        $total_jumlah_setoran = 0;
        $total_pemasukan_bersih = 0;
        $dana_rj_masuk_ri = 0;

        foreach($data as $row){ //Loop Per hari

            //Validasi Value Karena Bukan Tipe Integer
            $uang_masuk = (int) $row->uang_masuk;
            $gizi_hari = (int) $row->gizi_hari;
            $gizi_porsi = (int) $row->gizi_porsi;
            $gizi = $gizi_hari + $gizi_porsi; //
            $gda = (int) $row->gda;
            $lab = (int) $row->lab;
            $biaya_ambulance = (int) $row->biaya_ambulance;
            $total_bp_paket = (int) $row->total_bp_paket;
            $total_bp_non_paket =  (int) $row->total_bp_non_paket;
            $total_bp = $total_bp_paket + $total_bp_non_paket;
            $total_kia = (int) $row->total_kia;
            $ekg = (int) $row->ekg;
            $lain_lain = (int) $row->lain_lain;
            $obat_oral_ri = (int) $row->obat_oral_ri;

            $pemasukan_bersih = $uang_masuk - $gizi - $gda - $lab - $biaya_ambulance - $total_bp - $total_kia - $ekg - $lain_lain - $obat_oral_ri;
            
            $akomodasi_obat = (int) $row->akomodasi_obat;
            $akomodasi_alkes = (int) $row->akomodasi_alkes;                
            $akomodasi_lain_lain = (int) $row->akomodasi_lain_lain;
            $jumlah_setoran = (int) $row->jumlah_setoran;
            
            //Pasien Rawat Jalan Dengan Pengobatan Paket, mendapat pemasukan bersih 2000
            if($row->tipe_pelayanan == 'Rawat Jalan' && $total_bp_paket > 0){
                $dana_rj_masuk_ri += 2000;
            }

            $total_pemasukan_bersih += $pemasukan_bersih;
            $total_akomodasi += $akomodasi_obat;
            $total_akomodasi += $akomodasi_alkes;
            $total_akomodasi += $akomodasi_lain_lain;
            $total_jumlah_setoran += $jumlah_setoran;

        }
        $saldo_ri_harian = $saldo_kemarin + $total_pemasukan_bersih + $dana_rj_masuk_ri - $total_akomodasi - $total_jumlah_setoran;
        return $saldo_ri_harian;
        

    }

    
    function store(){
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