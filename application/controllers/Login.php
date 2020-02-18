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
        $data = $this->M_cek_saldo->getLastRecordCekSaldo();
        $string_start_date = '';
        foreach($data as $i){
            $string_start_date = $i->tanggal;
        }

        // $date_temp = strtotime("+1 day",strtotime(date($string_start_date)));
        $date_temp = strtotime(date($string_start_date));
        $endTimeStamp = strtotime("-1 day",strtotime(date('Y-m-d')));
        
        $saldo_ri_harian = '';
        
        while ($date_temp < $endTimeStamp) { //Loop PerHari
            // Keterangan Proses //
            //1. Mengambil Saldo Terakhir Tabel Temp Saldo Pada Hari Sebelumnya
            //2. Kemudian ditambahkan dengan hari ini
            //3. Contoh Untuk membuat mencatat saldo tanggal 3 = saldo tanggal 2 + (pemasukan RI + pemasukan IGD + Pemasukan BP - Pengeluaran Akomodasi - Setor Uang) tanggal 3
            // End Keterangan Proses //

            //Ambil Saldo Temp Terakhir
            $data = $this->M_cek_saldo->getLastRecordCekSaldo();
            $saldo_temp_terakhir = 0;
            foreach($data as $i){
                $saldo_temp_terakhir = $i->saldo_ri;
            }   
            // echo $saldo_temp_terakhir;
            // echo date("Y-m-d", $date_temp).' ';

            //Menambah Tanggal
            $date_temp = strtotime("+1 day", $date_temp); //Menambah Tanggal
            $tanggal_transaksi = date("Y-m-d", $date_temp);
            // echo date("Y-m-d", $date_temp).'<br>';

            //Mengambil Data
            $data = $this->M_laporan->get_laporan_ri_by_date($tanggal_transaksi);
            
            //Inisialisasi
            $total_akomodasi = 0;
            $total_jumlah_setoran = 0;
            $total_pemasukan_bersih = 0;
            // $dana_rj_masuk_ri = 0;

            $uang_masukz = 0;
            $uang_masuk = 0;
            foreach($data as $row){ //Loop Per hari
                //Validasi Value Karena Bukan Tipe Integer
                $gizi_hari = (int) $row->gizi_hari;
                $gizi_porsi = (int) $row->gizi_porsi;
                $gizi = $gizi_hari + $gizi_porsi; //
                $gda = (int) $row->gda;
                $lab = (int) $row->lab;
                $biaya_ambulance = (int) $row->biaya_ambulance;
                $total_bp_paket = (int) $row->total_bp_paket;
                $total_bp_non_paket =  (int) $row->total_bp_non_paket;
                $total_bp = $total_bp_paket + $total_bp_non_paket;
                $total_kia_paket = (int) $row->total_kia_paket;
                $total_kia_non_paket =  (int) $row->total_kia_non_paket;
                $total_kia = $total_kia_paket + $total_kia_non_paket;
                $ekg = (int) $row->ekg;
                $lain_lain = (int) $row->lain_lain;

                

                if($row->tipe_pelayanan != 'Rawat Jalan'){
                    $uang_masuk = (int) $row->uang_masuk;
                    $obat_oral_ri = (int) $row->obat_oral_ri;
                    echo $uang_masuk.'<br>';
                    
                }else if($row->tipe_pelayanan == 'Rawat Jalan' && $total_bp_paket > 0 || $total_kia_paket > 0){
                    // $uang_masukz    += 5000 + $gizi + $gda + $lab + $biaya_ambulance + $total_bp + $total_kia + $ekg + $lain_lain;
                    $uang_masukz += (int) $row->uang_masuk - $total_bp;
                    $obat_oral_ri = 3000;
                }
                


                $pemasukan_bersih = $uang_masuk - $gizi - $gda - $lab - $biaya_ambulance - $total_bp - $total_kia - $ekg - $lain_lain - $obat_oral_ri;
                
                $akomodasi_obat = (int) $row->akomodasi_obat;
                $akomodasi_alkes = (int) $row->akomodasi_alkes;                
                $akomodasi_lain_lain = (int) $row->akomodasi_lain_lain;
                $jumlah_setoran = (int) $row->jumlah_setoran;
                $total_pemasukan_bersih += $pemasukan_bersih;
                $total_akomodasi += $akomodasi_obat;
                $total_akomodasi += $akomodasi_alkes;
                $total_akomodasi += $akomodasi_lain_lain;
                $total_jumlah_setoran += $jumlah_setoran;

            }
            echo $uang_masukz.'<br>';
            // echo $total_pemasukan_bersih;
            $saldo_ri_harian = $saldo_temp_terakhir + $total_pemasukan_bersih - $total_akomodasi - $total_jumlah_setoran;
            // echo $saldo_temp_terakhir. ' '.$total_pemasukan_bersih. ' '. $total_akomodasi . ' ' . $total_jumlah_setoran. ' ' . $saldo_ri_harian;

            // Insert Ke Tabel Cek Saldo
            // $data = array(
            //     'tanggal' => $tanggal_transaksi,
            //     'saldo_ri' => $saldo_ri_harian
            // );
            // $this->M_cek_saldo->input_saldo($data);
        }

    }

    public function logout(){
        $this->session->sess_destroy();
        redirect('login');
    }

}
