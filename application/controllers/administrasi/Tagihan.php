<?php
class Tagihan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if ($this->session->userdata('akses') == 'Administrasi' || $this->session->userdata('akses') == 'Rawat Inap' 
        || $this->session->userdata('akses') == 'Apotek' || $this->session->userdata('akses') == "Loket") {
        } else {
            show_404();
        }
        $this->load->model('ambulance/M_ambulance');
        $this->load->model('administrasi/M_tagihan');
        $this->load->model('M_v_rawat_inap');
    }

    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/administrasi/tagihan/tambah');
    }

    function rekapTagihan()
    {
        $data['record'] = $this->M_tagihan->getRekap()->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/administrasi/tagihan/rekap_tagihan', $data);
    }

    function getTipePelayanan(){
        $noRef = $this->input->post('no_ref_pelayanan');
        $where = array(
            'no_ref_pelayanan' => $noRef
        );
        $data = $this->M_tagihan->getTipePelayananByNoRef($noRef)->result();
        foreach($data as $i){
            if($i->tipe_pelayanan == "Rawat Jalan"){
                echo "1";
            }else if($i->tipe_pelayanan == "Rawat Inap"){
                echo "2";
            }else if($i->tipe_pelayanan == "IGD"){
                echo "3";
            }else{
                echo "0";
            }
        }
    }

    function getTerbayar(){
        $noRef = $this->input->post('no_ref_pelayanan');
        $where = array(
            'no_ref_pelayanan' => $noRef
        );
        $data = $this->M_tagihan->getTerbayarByNoRef($noRef)->row();
        echo $data->terbayar;
    }

    function getOperator(){
        $noRef = $this->input->post('no_ref_pelayanan');
        $where = array(
            'no_ref_pelayanan' => $noRef
        );
        $data = $this->M_tagihan->getOperatorByNoRef($noRef)->row();
        echo $data->operator;
    }
    

    public function get_transaksi_pasien()
    {
        $nilai = $this->input->post('nilai');

        $where = array(
            'no_ref_pelayanan' => $nilai
        );

        $data_tbl['daftar_detail_pelayanan_ambulan'] =  $this->M_tagihan->get_data('daftar_detail_pelayanan_ambulan', $where)->result();
        $data_tbl['daftar_penjualan_obat_apotek_detail'] =  $this->M_tagihan->get_data('daftar_penjualan_obat_apotek_detail', $where)->result();
        $data_tbl['daftar_penjualan_obat_rawat_inap_detail'] =  $this->M_tagihan->get_data('daftar_penjualan_obat_rawat_inap_detail', $where)->result();
        $data_tbl['daftar_detail_tindakan_rawat_inap'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_rawat_inap', $where)->result();
        $data_tbl['daftar_detail_kamar_rawat_inap'] =  $this->M_tagihan->get_data('daftar_detail_kamar_rawat_inap', $where)->result();
        $data_tbl['daftar_detail_tindakan_lab_transaksi'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_lab_transaksi', $where)->result();
        $data_tbl['daftar_detail_tindakan_bp_transaksi'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_bp_transaksi', $where)->result();
        $data_tbl['daftar_detail_tindakan_ugd_transaksi'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_ugd_transaksi', $where)->result();
        $data_tbl['daftar_detail_tindakan_kia_transaksi'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_kia_transaksi', $where)->result();
        $data_tbl['daftar_detail_transaksi_lain'] =  $this->M_tagihan->get_data('daftar_detail_transaksi_lain', $where)->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_tagihan->get_select($no_ref, $nama, 'no_ref_pelayanan');
        echo json_encode($query);
    }

    public function tampil_ambulance()
    {
        $data_tbl['tbl_data'] = $this->M_tagihan->tampil_data('ambulance')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_lain()
    {
        $data_tbl['tbl_data'] = $this->M_tagihan->tampil_data('lain')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total_ambulance()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_ambulance']) && isset($_POST['harga_ambulance'])) {

            for ($i = 0; $i < count($this->input->post('no_ambulance')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ambulance')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_apotek_obat()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['kode_obat']) && isset($_POST['harga_apotek_obat']) && isset($_POST['qty_apotek_obat'])) {

            for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ri_kamar()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_ri_kamar']) && isset($_POST['jumlah_hari_ri_kamar'])) {

            for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                $harga_jual_temp = $this->input->post('harga_harian_ri_kamar')[$i];
                $harga_jual = (float) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                if ($this->input->post('status_kamar_ri_kamar')[$i] == "Belum Cek Out") {
                    $harga_jual = 0;
                }

                $jumlah_hari_temp = $this->input->post('jumlah_hari_ri_kamar')[$i];
                $jumlah_hari = (float) $jumlah_hari_temp;

                $perhitungan = $harga_jual * $jumlah_hari;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ri_obat()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['kode_obat_ri']) && isset($_POST['harga_ri_obat']) && isset($_POST['qty_ri_obat'])) {

            for ($i = 0; $i < count($this->input->post('kode_obat_ri')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_ri_obat')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ri_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_ri_tindakan']) && isset($_POST['qty_ri_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_ri_tindakan')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_bp_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan']) && isset($_POST['qty_bp_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_bp_tindakan')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_kia_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia_tindakan']) && isset($_POST['qty_kia_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_kia_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_kia_tindakan')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_lab_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan']) && isset($_POST['qty_lab_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_lab_tindakan')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ugd_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan']) && isset($_POST['qty_ugd_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_ugd_tindakan')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_lain()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_lain']) && isset($_POST['harga_lain']) && isset($_POST['qty_lain'])) {

            for ($i = 0; $i < count($this->input->post('no_lain')); $i++) {

                $harga_jual_temp = $this->input->post('harga_lain')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_lain')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function input_transaksi_form()
    {
        $btn_simpan = $this->input->post('btn_simpan');
        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');

        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );

        // cek apakah ada no ref pelayanan didalam semua tabel transaksi
        $cek_pelayanan_ambulan = $this->M_tagihan->get_data('pelayanan_ambulan', $where_no_ref_pelayanan);
        $cek_penjualan_obat_apotik = $this->M_tagihan->get_data('penjualan_obat_apotik', $where_no_ref_pelayanan);
        $cek_transaksi_rawat_inap = $this->M_tagihan->get_data('transaksi_rawat_inap', $where_no_ref_pelayanan);
        $cek_lab_transaksi = $this->M_tagihan->get_data('lab_transaksi', $where_no_ref_pelayanan);
        $cek_bp_penanganan = $this->M_tagihan->get_data('bp_penanganan', $where_no_ref_pelayanan);
        $cek_ugd_penanganan = $this->M_tagihan->get_data('ugd_penanganan', $where_no_ref_pelayanan);
        $cek_kia_penanganan = $this->M_tagihan->get_data('kia_penanganan', $where_no_ref_pelayanan);
        $cek_transaksi_lain = $this->M_tagihan->get_data('transaksi_lain', $where_no_ref_pelayanan);

        // Start of cek di setiap transaksi //// untuk pelayanan_ambulan
        if ($cek_pelayanan_ambulan->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_pelayanan_a = "kosong";
            foreach ($cek_pelayanan_ambulan->result() as $data) {
                $no_pelayanan_a = $data->no_pelayanan_a;
            }

            $where_no_pelayanan_a = array(
                'no_pelayanan_a' => $no_pelayanan_a
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_pelayanan_a, 'detail_pelayanan_ambulan');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_ambulance harga_ambulance
            if (isset($_POST['no_ambulance'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_ambulance')); $i++) {

                    $no_ambulance = $this->input->post('no_ambulance')[$i];

                    $harga_jual_temp = $this->input->post('harga_ambulance')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $data = array(
                        'no_pelayanan_a' => $no_pelayanan_a,
                        'no_ambulance' => $no_ambulance,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_pelayanan_ambulan', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_ambulance');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tanggal' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_pelayanan_a, 'pelayanan_ambulan', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_pelayanan_a, 'pelayanan_ambulan');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_ambulance harga_ambulance
            if (isset($_POST['no_ambulance'])) {

                // menambah transaksi utama
                $no_pelayanan_a = $this->M_tagihan->get_no_pelayanan_a(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_ambulance');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_pelayanan_a' => $no_pelayanan_a,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tanggal' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('pelayanan_ambulan', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_ambulance')); $i++) {

                    $no_ambulance = $this->input->post('no_ambulance')[$i];

                    $harga_jual_temp = $this->input->post('harga_ambulance')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $data = array(
                        'no_pelayanan_a' => $no_pelayanan_a,
                        'no_ambulance' => $no_ambulance,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_pelayanan_ambulan', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        // Start of cek di setiap transaksi //// untuk penjualan_obat_apotik
        if ($cek_penjualan_obat_apotik->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_penjualan_obat_a = "kosong";
            foreach ($cek_penjualan_obat_apotik->result() as $data) {
                $no_penjualan_obat_a = $data->no_penjualan_obat_a;
            }

            $where_no_penjualan_obat_a = array(
                'no_penjualan_obat_a' => $no_penjualan_obat_a
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_penjualan_obat_a, 'detail_penjualan_obat_apotik');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_stok_obat_a harga_apotek_obat qty_apotek_obat
            if (isset($_POST['kode_obat'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];

                    $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                    $qty = (int) $qty_temp;

                    $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $status_paket_tmp = isset($this->input->post('status_paket_apotek_obat')[$i]) ? $this->input->post('status_paket_apotek_obat')[$i] : "Tidak";
                    $status_paket = "Tidak";
                    if ($status_paket_tmp == "Ya") {
                        $status_paket = "Ya";
                    }

                    $data = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'kode_obat' => $kode_obat,
                        'qty' => $qty,
                        'harga_jual' => $harga_jual,
                        'status_paket' => $status_paket
                    );

                    $tambah = $this->M_tagihan->input_data('detail_penjualan_obat_apotik', $data);

                    // update qty obat lama dibawah ini
                    if ($btn_simpan == "simpan_final") {
                        $where_kode_obat = array(
                            'kode_obat' => $kode_obat
                        );

                        $ambil_data = $this->M_tagihan->get_data('obat', $where_kode_obat);
                        $qty_lama = "kosong";
                        foreach ($ambil_data->result() as $data) {
                            $qty_lama = $data->stok_rawat_jalan;
                        }

                        $qty_sekarang = $qty_lama - $qty;

                        if ($qty_sekarang < 0) {
                            $qty_sekarang = 0;
                        }

                        $data = array(
                            'stok_rawat_jalan' => $qty_sekarang
                        );

                        $update = $this->M_tagihan->update_data($where_kode_obat, 'obat', $data);
                    }
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_apotek_obat');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tanggal_penjualan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $update = $this->M_tagihan->update_data($where_no_penjualan_obat_a, 'penjualan_obat_apotik', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_penjualan_obat_a, 'penjualan_obat_apotik');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? kode_obat harga_apotek_obat qty_apotek_obat
            if (isset($_POST['kode_obat'])) {

                // menambah transaksi utama
                $no_penjualan_obat_a = $this->M_tagihan->get_no_penjualan_obat_a(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_apotek_obat');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_penjualan_obat_a' => $no_penjualan_obat_a,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tanggal_penjualan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('penjualan_obat_apotik', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];

                    $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                    $qty = (int) $qty_temp;

                    $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $status_paket_tmp = isset($this->input->post('status_paket_apotek_obat')[$i]) ? $this->input->post('status_paket_apotek_obat')[$i] : "Tidak";
                    $status_paket = "Tidak";
                    if ($status_paket_tmp == "Ya") {
                        $status_paket = "Ya";
                    }

                    $data = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'kode_obat' => $kode_obat,
                        'qty' => $qty,
                        'harga_jual' => $harga_jual,
                        'status_paket' => $status_paket
                    );

                    $tambah = $this->M_tagihan->input_data('detail_penjualan_obat_apotik', $data);

                    // update qty obat lama dibawah ini
                    if ($btn_simpan == "simpan_final") {
                        $where_kode_obat = array(
                            'kode_obat' => $kode_obat
                        );

                        $ambil_data = $this->M_tagihan->get_data('obat', $where_kode_obat);
                        $qty_lama = "kosong";
                        foreach ($ambil_data->result() as $data) {
                            $qty_lama = $data->stok_rawat_jalan;
                        }

                        $qty_sekarang = $qty_lama - $qty;

                        if ($qty_sekarang < 0) {
                            $qty_sekarang = 0;
                        }

                        $data = array(
                            'stok_rawat_jalan' => $qty_sekarang
                        );

                        $update = $this->M_tagihan->update_data($where_kode_obat, 'obat', $data);
                    }
                }
            }
            // End of Cek apakah ada data detail post masuk ?

        }
        // End Of cek di setiap transaksi

        // Start of cek di setiap transaksi //// untuk transaksi_rawat_inap
        if ($cek_transaksi_rawat_inap->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_transaksi_rawat_i = "kosong";
            foreach ($cek_transaksi_rawat_inap->result() as $data) {
                $no_transaksi_rawat_i = $data->no_transaksi_rawat_i;
            }

            $where_no_transaksi_rawat_i = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_kamar');
            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_obat');
            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_tindakan');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ?
            if (isset($_POST['kode_obat_ri']) || isset($_POST['no_rawat_inap_t']) || isset($_POST['no_kamar_rawat_i'])) {

                // no_kamar_rawat_i tanggal_cek_in_ri_kamar tanggal_cek_out_ri_kamar jumlah_hari_ri_kamar harga_harian_ri_kamar status_kamar_ri_kamar
                if (isset($_POST['no_kamar_rawat_i'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                        $no_kamar_rawat_i = $this->input->post('no_kamar_rawat_i')[$i];

                        $tanggal_cek_in_ri_kamar = $this->input->post('tanggal_cek_in_ri_kamar')[$i];
                        $tanggal_cek_out_ri_kamar = $this->input->post('tanggal_cek_out_ri_kamar')[$i];

                        $jumlah_hari_temp = $this->input->post('jumlah_hari_ri_kamar')[$i];
                        $jumlah_hari = (float) $jumlah_hari_temp;

                        $harga_harian_temp = $this->input->post('harga_harian_ri_kamar')[$i];
                        $harga_harian = (float) preg_replace("/[^0-9]/", "", $harga_harian_temp);

                        $status_kamar_ri_kamar = $this->input->post('status_kamar_ri_kamar')[$i];

                        $sub_total_harga = 0;
                        if ($status_kamar_ri_kamar == "Sudah Cek Out") {
                            $sub_total_harga = $jumlah_hari * $harga_harian;
                        }

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_kamar_rawat_i' => $no_kamar_rawat_i,
                            'tanggal_cek_in' => $tanggal_cek_in_ri_kamar,
                            'tanggal_cek_out' => $tanggal_cek_out_ri_kamar,
                            'jumlah_hari' => $jumlah_hari,
                            'harga_harian' => $harga_harian,
                            'sub_total_harga' => $sub_total_harga,
                            'status_kamar' => $status_kamar_ri_kamar
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_kamar', $data);
                    }
                }

                // kode_obat_ri harga_ri_obat qty_ri_obat
                if (isset($_POST['kode_obat_ri'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('kode_obat_ri')); $i++) {

                        $kode_obat_ri = $this->input->post('kode_obat_ri')[$i];

                        $qty_temp = $this->input->post('qty_ri_obat')[$i];
                        $qty = (int) $qty_temp;

                        $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $status_paket_tmp = isset($this->input->post('status_paket_ri_obat')[$i]) ? $this->input->post('status_paket_ri_obat')[$i] : "Tidak";
                        $status_paket = "Tidak";
                        if ($status_paket_tmp == "Ya") {
                            $status_paket = "Ya";
                        }

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'kode_obat' => $kode_obat_ri,
                            'qty' => $qty,
                            'harga_jual' => $harga_jual,
                            'status_paket' => $status_paket
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_obat', $data);

                        // update qty obat lama dibawah ini
                        if ($btn_simpan == "simpan_final") {
                            $where_kode_obat_ri = array(
                                'kode_obat' => $kode_obat_ri
                            );

                            $ambil_data = $this->M_tagihan->get_data('obat', $where_kode_obat_ri);
                            $qty_lama = "kosong";
                            foreach ($ambil_data->result() as $data) {
                                $qty_lama = $data->stok_rawat_inap;
                            }

                            $qty_sekarang = $qty_lama - $qty;

                            if ($qty_sekarang < 0) {
                                $qty_sekarang = 0;
                            }

                            $data = array(
                                'stok_rawat_inap' => $qty_sekarang
                            );

                            $update = $this->M_tagihan->update_data($where_kode_obat_ri, 'obat', $data);
                        }
                    }
                }

                // no_rawat_inap_t harga_ri_tindakan
                if (isset($_POST['no_rawat_inap_t'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                        $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];

                        $qty_temp = $this->input->post('qty_ri_tindakan')[$i];
                        $qty = (int) $qty_temp;

                        $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_rawat_inap_t' => $no_rawat_inap_t,
                            'qty' => $qty,
                            'harga' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                    }
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');

                $sub_total_ri_obat = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_obat'));
                $sub_total_ri_tindakan = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_tindakan'));
                $sub_total_ri_kamar = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_kamar'));

                $total_harga = (int) $sub_total_ri_obat + (int) $sub_total_ri_tindakan + (int) $sub_total_ri_kamar;

                $data = array(
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $update = $this->M_tagihan->update_data($where_no_transaksi_rawat_i, 'transaksi_rawat_inap', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'transaksi_rawat_inap');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ?
            if (isset($_POST['kode_obat_ri']) || isset($_POST['no_rawat_inap_t']) || isset($_POST['no_kamar_rawat_i'])) {

                // menambah transaksi utama
                $no_transaksi_rawat_i = $this->M_tagihan->get_no_transaksi_rawat_i(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');

                $sub_total_ri_obat = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_obat'));
                $sub_total_ri_tindakan = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_tindakan'));
                $sub_total_ri_kamar = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_kamar'));

                $total_harga = (int) $sub_total_ri_obat + (int) $sub_total_ri_tindakan + (int) $sub_total_ri_kamar;

                $data = array(
                    'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('transaksi_rawat_inap', $data);

                // no_kamar_rawat_i tanggal_cek_in_ri_kamar tanggal_cek_out_ri_kamar jumlah_hari_ri_kamar harga_harian_ri_kamar status_kamar_ri_kamar
                if (isset($_POST['no_kamar_rawat_i'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                        $no_kamar_rawat_i = $this->input->post('no_kamar_rawat_i')[$i];

                        $tanggal_cek_in_ri_kamar = $this->input->post('tanggal_cek_in_ri_kamar')[$i];
                        $tanggal_cek_out_ri_kamar = $this->input->post('tanggal_cek_out_ri_kamar')[$i];

                        $jumlah_hari_temp = $this->input->post('jumlah_hari_ri_kamar')[$i];
                        $jumlah_hari = (float) $jumlah_hari_temp;

                        $harga_harian_temp = $this->input->post('harga_harian_ri_kamar')[$i];
                        $harga_harian = (float) preg_replace("/[^0-9]/", "", $harga_harian_temp);

                        $status_kamar_ri_kamar = $this->input->post('status_kamar_ri_kamar')[$i];

                        $sub_total_harga = 0;
                        if ($status_kamar_ri_kamar == "Sudah Cek Out") {
                            $sub_total_harga = $jumlah_hari * $harga_harian;
                        }

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_kamar_rawat_i' => $no_kamar_rawat_i,
                            'tanggal_cek_in' => $tanggal_cek_in_ri_kamar,
                            'tanggal_cek_out' => $tanggal_cek_out_ri_kamar,
                            'jumlah_hari' => $jumlah_hari,
                            'harga_harian' => $harga_harian,
                            'sub_total_harga' => $sub_total_harga,
                            'status_kamar' => $status_kamar_ri_kamar
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_kamar', $data);
                    }
                }

                // kode_obat_ri harga_ri_obat qty_ri_obat
                if (isset($_POST['kode_obat_ri'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('kode_obat_ri')); $i++) {

                        $kode_obat_ri = $this->input->post('kode_obat_ri')[$i];

                        $qty_temp = $this->input->post('qty_ri_obat')[$i];
                        $qty = (int) $qty_temp;

                        $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $status_paket_tmp = isset($this->input->post('status_paket_ri_obat')[$i]) ? $this->input->post('status_paket_ri_obat')[$i] : "Tidak";
                        $status_paket = "Tidak";
                        if ($status_paket_tmp == "Ya") {
                            $status_paket = "Ya";
                        }

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'kode_obat' => $kode_obat_ri,
                            'qty' => $qty,
                            'harga_jual' => $harga_jual,
                            'status_paket' => $status_paket
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_obat', $data);

                        // update qty obat lama dibawah ini
                        if ($btn_simpan == "simpan_final") {
                            $where_kode_obat_ri = array(
                                'kode_obat' => $kode_obat_ri
                            );

                            $ambil_data = $this->M_tagihan->get_data('obat', $where_kode_obat_ri);
                            $qty_lama = "kosong";
                            foreach ($ambil_data->result() as $data) {
                                $qty_lama = $data->stok_rawat_inap;
                            }

                            $qty_sekarang = $qty_lama - $qty;

                            if ($qty_sekarang < 0) {
                                $qty_sekarang = 0;
                            }

                            $data = array(
                                'stok_rawat_inap' => $qty_sekarang
                            );

                            $update = $this->M_tagihan->update_data($where_kode_obat_ri, 'obat', $data);
                        }
                    }
                }

                // no_rawat_inap_t harga_ri_tindakan
                if (isset($_POST['no_rawat_inap_t'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                        $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];

                        $qty_temp = $this->input->post('qty_ri_tindakan')[$i];
                        $qty = (int) $qty_temp;

                        $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_rawat_inap_t' => $no_rawat_inap_t,
                            'qty' => $qty,
                            'harga' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                    }
                }
            }
            // End of Cek apakah ada data detail post masuk ?
        }
        // End Of cek di setiap transaksi

        // Start of cek di setiap transaksi //// untuk lab_transaksi
        if ($cek_lab_transaksi->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_lab_t = "kosong";
            foreach ($cek_lab_transaksi->result() as $data) {
                $no_lab_t = $data->no_lab_t;
            }

            $where_no_lab_t = array(
                'no_lab_t' => $no_lab_t
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_lab_t, 'detail_lab_transaksi');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_lab_c harga_lab_tindakan
            if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan']) && isset($_POST['qty_lab_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                    $no_lab_c = $this->input->post('no_lab_c')[$i];

                    $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_lab_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_lab_transaksi', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_lab_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_lab_t, 'lab_transaksi', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_lab_t, 'lab_transaksi');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_lab_c harga_lab_tindakan
            if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan']) && isset($_POST['qty_lab_tindakan'])) {

                // menambah transaksi utama
                $no_lab_t = $this->M_tagihan->get_no_lab_t(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_lab_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_lab_t' => $no_lab_t,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('lab_transaksi', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                    $no_lab_c = $this->input->post('no_lab_c')[$i];

                    $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_lab_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_lab_transaksi', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        // Start of cek di setiap transaksi //// untuk bp_penanganan
        if ($cek_bp_penanganan->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_bp_p = "kosong";
            foreach ($cek_bp_penanganan->result() as $data) {
                $no_bp_p = $data->no_bp_p;
            }

            $where_no_bp_p = array(
                'no_bp_p' => $no_bp_p
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_bp_p, 'detail_bp_penanganan');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_bp_t harga_bp_tindakan
            if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan']) && isset($_POST['qty_bp_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_bp_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_bp_penanganan', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_bp_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_bp_p, 'bp_penanganan', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_bp_p, 'bp_penanganan');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_bp_t harga_bp_tindakan
            if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan']) && isset($_POST['qty_bp_tindakan'])) {

                // menambah transaksi utama
                $no_bp_p = $this->M_tagihan->get_no_bp_p(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_bp_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_bp_p' => $no_bp_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('bp_penanganan', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_bp_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_bp_penanganan', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        // Start of cek di setiap transaksi //// untuk ugd_penanganan
        if ($cek_ugd_penanganan->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_ugd_p = "kosong";
            foreach ($cek_ugd_penanganan->result() as $data) {
                $no_ugd_p = $data->no_ugd_p;
            }

            $where_no_ugd_p = array(
                'no_ugd_p' => $no_ugd_p
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_ugd_p, 'detail_ugd_penanganan');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_ugd_t harga_ugd_tindakan
            if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan']) && isset($_POST['qty_ugd_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_ugd_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_ugd_penanganan', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_ugd_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_ugd_p, 'ugd_penanganan', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_ugd_p, 'ugd_penanganan');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_ugd_t harga_ugd_tindakan
            if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan']) && isset($_POST['qty_ugd_tindakan'])) {

                // menambah transaksi utama
                $no_ugd_p = $this->M_tagihan->get_no_ugd_p(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_ugd_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_ugd_p' => $no_ugd_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('ugd_penanganan', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_ugd_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_ugd_penanganan', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        // Start of cek di setiap transaksi //// untuk kia_penanganan
        if ($cek_kia_penanganan->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_kia_p = "kosong";
            foreach ($cek_kia_penanganan->result() as $data) {
                $no_kia_p = $data->no_kia_p;
            }

            $where_no_kia_p = array(
                'no_kia_p' => $no_kia_p
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_kia_p, 'detail_kia_penanganan');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_kia_t harga_kia_tindakan
            if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia_tindakan']) && isset($_POST['qty_kia_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                    $no_kia_t = $this->input->post('no_kia_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_kia_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_kia_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_kia_p' => $no_kia_p,
                        'no_kia_t' => $no_kia_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_kia_penanganan', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_kia_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_kia_p, 'kia_penanganan', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_kia_p, 'kia_penanganan');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_kia_t harga_kia_tindakan
            if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia_tindakan']) && isset($_POST['qty_kia_tindakan'])) {

                // menambah transaksi utama
                $no_kia_p = $this->M_tagihan->get_no_kia_p(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_kia_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_kia_p' => $no_kia_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('kia_penanganan', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                    $no_kia_t = $this->input->post('no_kia_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_kia_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_kia_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_kia_p' => $no_kia_p,
                        'no_kia_t' => $no_kia_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_kia_penanganan', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        // Start of cek di setiap transaksi //// untuk transaksi_lain
        if ($cek_transaksi_lain->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_transaksi_lain = "kosong";
            foreach ($cek_transaksi_lain->result() as $data) {
                $no_transaksi_lain = $data->no_transaksi_lain;
            }

            $where_no_transaksi_lain = array(
                'no_transaksi_lain' => $no_transaksi_lain
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_lain, 'detail_transaksi_lain');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_lain harga_lain
            if (isset($_POST['no_lain']) && isset($_POST['harga_lain']) && isset($_POST['qty_lain'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lain')); $i++) {

                    $no_lain = $this->input->post('no_lain')[$i];
                    $nama_lain = $this->input->post('nama_lain')[$i];

                    $harga_jual_temp = $this->input->post('harga_lain')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_lain')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_transaksi_lain' => $no_transaksi_lain,
                        'no_lain' => $no_lain,
                        'nama' => $nama_lain,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_transaksi_lain', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_lain');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_transaksi_lain, 'transaksi_lain', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_lain, 'transaksi_lain');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_lain harga_lain
            if (isset($_POST['no_lain']) && isset($_POST['harga_lain']) && isset($_POST['qty_lain'])) {

                // menambah transaksi utama
                $no_transaksi_lain = $this->M_tagihan->get_no_transaksi_lain(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_lain');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_transaksi_lain' => $no_transaksi_lain,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('transaksi_lain', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lain')); $i++) {

                    $no_lain = $this->input->post('no_lain')[$i];
                    $nama_lain = $this->input->post('nama_lain')[$i];

                    $harga_jual_temp = $this->input->post('harga_lain')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_lain')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_transaksi_lain' => $no_transaksi_lain,
                        'no_lain' => $no_lain,
                        'nama' => $nama_lain,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_transaksi_lain', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        // validasi pelayanan start
        $grand_total = preg_replace("/[^0-9]/", "", $this->input->post('grand_total'));
        $terbayar = preg_replace("/[^0-9]/", "", $this->input->post('terbayar'));
        $sisa = $grand_total - $terbayar;
        $status_pembayaran = $sisa>0 ? 'Belum Lunas' : 'Lunas';
        $tgl_lunas = $status_pembayaran == "Lunas" ? date('Y-m-d H:i:s') : NULL;
        $operator = $this->input->post('operator');

        $data_update_status_pelayanan = array(
            'tipe_pelayanan' =>  $this->input->post('tipe_pelayanan'),
            'grand_total' =>  $grand_total,
            'tgl_lunas' => $tgl_lunas,
            'terbayar' => $terbayar,
            'status_pembayaran' => $status_pembayaran,
            'operator' => $operator
        );

        $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);
        // validasi pelayanan end

        if ($btn_simpan == "simpan_final") {
            
            $data_update_status_pelayanan = array(
                'status' => 'finish',
                'tgl_keluar' => date('Y-m-d H:i:s')
            );
            $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);

            $base_url = base_url('administrasi/tagihan/cetak/' . $no_ref_pelayanan);
            echo "<script type='text/javascript'>";
            echo "window.open('" . $base_url . "','_blank')";
            echo "</script>";
        }

        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('administrasi/tagihan', 'refresh');
    }

    public function cetak($no_ref_pelayanan)
    {
        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );
        $data_pelayanan_pasien = $this->M_tagihan->get_data('pelayanan_pasien_default', $where_no_ref_pelayanan)->row();
        $data['nama_pasien'] = $data_pelayanan_pasien->nama;
        $data['no_rm'] = $data_pelayanan_pasien->no_rm;
        $data['no_ref'] = $data_pelayanan_pasien->no_ref_pelayanan;
        $tgl_pelayanan_tmp = $data_pelayanan_pasien->tgl_keluar;
        $data['tgl_pelayanan'] = tgl_indo(date('Y-m-d', strtotime($tgl_pelayanan_tmp)));
        $data['tipe_pelayanan'] = $data_pelayanan_pasien->tipe_pelayanan;
        $data['operator'] = $data_pelayanan_pasien->operator;

        $data['cek_lab_transaksi2'] = $this->M_tagihan->get_data('lab_transaksi', $where_no_ref_pelayanan);
        $data['cek_bp_penanganan2'] = $this->M_tagihan->get_data('bp_penanganan', $where_no_ref_pelayanan);
        $data['cek_ugd_penanganan2'] = $this->M_tagihan->get_data('ugd_penanganan', $where_no_ref_pelayanan);
        $data['cek_kia_penanganan2'] = $this->M_tagihan->get_data('kia_penanganan', $where_no_ref_pelayanan);
        $data['cek_pelayanan_ambulan2'] = $this->M_tagihan->get_data('pelayanan_ambulan', $where_no_ref_pelayanan);
        $data['cek_penjualan_obat_apotik2'] = $this->M_tagihan->get_data('penjualan_obat_apotik', $where_no_ref_pelayanan);
        $data['cek_transaksi_rawat_inap2'] = $this->M_tagihan->get_data('transaksi_rawat_inap', $where_no_ref_pelayanan);
        $data['cek_transaksi_lain2'] = $this->M_tagihan->get_data('transaksi_lain', $where_no_ref_pelayanan);

        $this->load->view('sim_klinik/konten/administrasi/cetak_struk/tampil', $data);
    }

    function updatePembayaran(){
        //Get Data From View
        $no_ref_pelayanan = $_POST['no_ref_pelayanan'];
        $terbayar = $_POST['terbayar'];
        $status_pembayaran = $_POST['status_pembayaran'];
        $tgl_lunas = $status_pembayaran == "Lunas" ? date('Y-m-d H:i:s') : NULL;

        //Update Tanggal Lunas, Terbayar dan Status Pembayaran di Tabel Pelayanan
        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );

        $data_update_status_pelayanan = array(
            'terbayar' => $terbayar,
            'status_pembayaran' => $status_pembayaran,
            'tgl_lunas' => date('Y-m-d H:i:s'),
        );
        $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);
        $this->session->set_flashdata('success', 'Ubah Data Pembayaran Berhasil');
        redirect('admin/pasien/detail/'.$no_ref_pelayanan, 'refresh');
        
        

    }
}
