<?php
class Login extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('login/M_login');
        $this->load->model('M_cek_saldo');
        $this->load->model('admin/M_laporan');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/login', 'sim_klinik/konten/login/tampil');
        $this->cek();
    }
    public function store()
    {
        $userpass = $this->input->post('password');
        $cek = $this->M_login->cek_login();
        if ($cek->num_rows() > 0) {
            foreach ($cek->result() as $row) {
                $id_user = $row->no_user_pegawai;
                $username = $row->username;
                $nama = $row->nama;
                $akses = $row->jenis_akses;
                $password = $row->password;
            }
            if (password_verify($userpass, $password)) {
                $data_session = array(
                    'id_user' => $id_user,
                    'username' => $username,
                    'nama' => $nama,
                    'akses' => $akses
                );
                $this->session->set_userdata($data_session);
                if($row->jenis_akses == 'Manager'){
                    redirect('laporan/rekapTagihan');
                }
                else if($row->jenis_akses== 'Admin'){
                    redirect('admin/pasien');
                }
                else if ($row->jenis_akses == 'Loket') 
                {
                    redirect(base_url("loket/pendaftaran"));
                } 
                else if ($row->jenis_akses == 'Apotek') 
                {
                    redirect(base_url("apotek/penjualan_obat"));
                }
                else if ($row->jenis_akses == 'Administrasi')
                {
                    redirect(base_url("administrasi/tagihan"));
                }
                else if ($row->jenis_akses == 'Rawat Inap')
                {
                    redirect(base_url("rawat_inap/transaksi"));
                }
            } else {
                $this->session->set_flashdata('login','Dilogin');
                redirect('/');
            }
        } else {
            $this->session->set_flashdata('login','Dilogin');
            
            redirect('/');
        }
    }

    function cek(){
        //Dokumentasi Contoh
        // 1. Untuk Menghitung Saldo Tanggal 2 Januari, dibutuhkan Saldo Terakhir pada tanggal 1 Januari
        // 2. Perhitungan Dilakukan pada hari setelahnya yaitu tanggal 3 januari
        // 3. Ketika Login pada tanggal 3 januari, maka akan melakukan perhitungan mulai tanggal terakhir tersimpan
        //    hingga tanggal 2 januari

        //Mengambil Data Terakhir Tersimpan Pada Tabel Temp Saldo
        $data = $this->M_cek_saldo->getLastRecordCekSaldo();
        $string_start_date = '';
        foreach($data as $i){
            $string_start_date = $i->tanggal;
        }

        $date_temp = strtotime(date($string_start_date));
        $endTimeStamp = strtotime("-1 day",strtotime(date('Y-m-d')));

        while ($date_temp < $endTimeStamp) { //Loop PerHari, $date_temp dimulai dari tanggal terakhir yang tersimpan dalam Tabel Temp Saldo
            $day = date("Y-m-d", $date_temp); //Tanggal Ambil Saldo Pada Tabel Temp Saldo
            $grand_saldo = $this->M_cek_saldo->getCekSaldoByDate($day); //Saldo Awal, Berasal Dari Temporary Saldo
            $date_temp = strtotime("+1 day", $date_temp); //Menambah 1 Hari
            $next_day = date("Y-m-d", $date_temp); //Tanggal Ambil Transaksi Harian 
            $laporan_ri_harian = $this->M_laporan->laporan_ri_harian($next_day); //Ambil Dari Laporan Harian

            //Inisialisasi Grand Total
            $GT_pemasukan_bersih = 0;
            $GT_akomodasi_obat = 0;
            $GT_akomodasi_alkes = 0;
            $GT_akomodasi_lain = 0;
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

            //Loop:
            foreach($laporan_ri_harian as $row){
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
                $akomodasi_obat = (int) $row->akomodasi_obat;
                $akomodasi_alkes = (int) $row->akomodasi_alkes;
                $akomodasi_lain = (int) $row->akomodasi_lain_lain;
                $jumlah_setoran = (int) $row->jumlah_setoran;
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
                } else if ($row->tipe_pelayanan == "Akomodasi") { //End If Rawat Jalan Start Akomodasi
                    $AK_akomodasi_obat += $akomodasi_obat;
                    $AK_akomodasi_alkes += $akomodasi_alkes;
                    $AK_akomodasi_lain += $akomodasi_lain;
                } else if ($row->tipe_pelayanan == "Setor Uang") {
                    $SETORAN_jumlah_setoran += $jumlah_setoran;
                }
            }
            //Grand Total
            $GT_pemasukan_bersih = $RI_pemasukan_bersih + $IGD_pemasukan_bersih + $RJ_pemasukan_bersih;
            $GT_akomodasi_obat = $AK_akomodasi_obat;
            $GT_akomodasi_alkes = $AK_akomodasi_alkes;
            $GT_akomodasi_lain = $AK_akomodasi_lain;
            $GT_jumlah_setoran = $SETORAN_jumlah_setoran;

            $grand_saldo += $GT_pemasukan_bersih - ($GT_akomodasi_obat + $GT_akomodasi_alkes + $GT_akomodasi_lain) - $GT_jumlah_setoran;

            // Insert Ke Tabel Cek Saldo
            $data = array(
                'tanggal' => $next_day,
                'saldo_ri' => $grand_saldo
            );
            $this->M_cek_saldo->input_saldo($data);
        }
    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
