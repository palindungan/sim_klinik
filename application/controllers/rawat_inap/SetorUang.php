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
        ini_set('max_execution_time', 0); // 0 = Unlimited

        //Get Saldo Kemarin
        $yesterday = date("Y-m-d",strtotime("-1 day",strtotime(date('Y-m-d'))));
        $saldo_kemarin =  $this->M_cek_saldo->getCekSaldoByDate($yesterday); //Diambil Record Hari Kemarin Dari Tabel Saldo Temp
        //Mengambil Data
        $day = date('Y-m-d');

        //Inisialisasi Grand Total
        $grand_saldo = 0;
        $GT_pemasukan_bersih = 0;
        $GT_akomodasi = 0;
        $GT_jumlah_setoran = 0;

        //Inisisalisasi Rawat Inap
        $RI_pemasukan_bersih = 0;
        //Inisialisasi IGD
        $IGD_pemasukan_bersih = 0;
        //Inisialisasi Rawat Jalan
        $pemasukan_bersih_bp_ke_ri = 2000;
        $RJ_pemasukan_bersih = 0;
        //Inisialisasi Akomodasi
        $AK_akomodasi_obat = 0;
        $AK_akomodasi_alkes = 0;
        $AK_akomodasi_lain = 0;
        //Inisialisasi Setoran
        $SETORAN_jumlah_setoran = 0;

        //RI Pelayanan
        $ri_pelayanan = $this->M_laporan->laporan_ri_harian_new_pelayanan($day);
        //Loop:
        foreach($ri_pelayanan as $row){
            // Validasi Value Karena Bukan Tipe Integer
            $uang_masuk = (int) $row->uang_masuk;
            $gizi = (int) $row->gizi;
            $gda = (int) $row->gda;
            $lab = (int) $row->lab;
            $biaya_ambulance = (int) $row->biaya_ambulance;
            $total_bp_paket = (int) $row->total_bp_paket;
            $total_bp_non_paket = (int) $row->total_bp_non_paket;
            $total_bp =  $total_bp_paket + $total_bp_non_paket;
            $total_kia = (int) $row->total_kia;
            $ekg = (int) $row->ekg;
            $lain_lain = (int) $row->lain_lain;
            $obat_oral_ri = (int) $row->obat_oral_ri;

            if ($row->nama_pasien == "") {
                $pemasukan_bersih = 0;
            } else {
                $pemasukan_bersih = $uang_masuk - $gizi - $gda - $lab - $biaya_ambulance - $total_bp - $total_kia - $ekg - $lain_lain - $obat_oral_ri;
            }
            
            $japel = (int) $row->japel;
            $visite = (int) $row->visite;
            $klinik_bersih = $pemasukan_bersih - $japel - $visite;

            if ($row->tipe_pelayanan == "Rawat Inap") {
                $RI_pemasukan_bersih += $pemasukan_bersih;
            }else if ($row->tipe_pelayanan == "IGD") {
                $IGD_pemasukan_bersih += $pemasukan_bersih;
            } else if ($row->tipe_pelayanan == "Rawat Jalan") { //End If IGD, Start IG Rawat Jalan
                $RJ_pemasukan_bersih += $pemasukan_bersih;
                if($total_bp_paket > 0){
                    $RJ_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri;
                }

                if($total_kia > 0){
                    $RJ_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri;
                }
            }            
        }

        //Query RI Akomodasi
        $ri_akomodasi = $this->M_laporan->laporan_ri_harian_new_akomodasi_ri($day);
        foreach($ri_akomodasi as $row){
            $jumlah_trx_akomodasi++;
            $AK_akomodasi_obat += (int) $row->sum_obat;
            $AK_akomodasi_alkes += (int) $row->sum_alkes;
            $AK_akomodasi_lain += (int) $row->sum_lain_lain;
        }

        //Laporan RI Setoran Rawat Inap
        $laporan_ri_harian_new_setoran_ri = $this->M_laporan->laporan_ri_harian_new_setoran_ri($day);
        foreach($laporan_ri_harian_new_setoran_ri as $row){
            $jumlah_trx_setoran++;
            $SETORAN_jumlah_setoran += (int) $row->jumlah_setoran;
        }
    

        //Grand Total
        $GT_pemasukan_bersih = $RI_pemasukan_bersih + $IGD_pemasukan_bersih + $RJ_pemasukan_bersih;
        $GT_akomodasi = $AK_akomodasi_obat + $AK_akomodasi_alkes + $AK_akomodasi_lain;
        $GT_jumlah_setoran = $SETORAN_jumlah_setoran;

        $grand_saldo += $GT_pemasukan_bersih - ($GT_akomodasi + $GT_jumlah_setoran);
        return $saldo_kemarin + $grand_saldo;
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