<?php
class Tagihan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if ($this->session->userdata('akses') == 'Administrasi' || $this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == 'Apotek') {
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
    function detailRekapTagihan()
    {
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

        if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_ri_obat']) && isset($_POST['qty_ri_obat'])) {

            for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

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

    public function input_transaksi_form()
    {
        $btn_simpan = $this->input->post('btn_simpan');
        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');

        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );

        // cek apakah ada no ref pelayanan didalam semua tabel transaksi
        $cek_lab_transaksi = $this->M_tagihan->get_data('lab_transaksi', $where_no_ref_pelayanan);
        $cek_bp_penanganan = $this->M_tagihan->get_data('bp_penanganan', $where_no_ref_pelayanan);
        $cek_ugd_penanganan = $this->M_tagihan->get_data('ugd_penanganan', $where_no_ref_pelayanan);
        $cek_kia_penanganan = $this->M_tagihan->get_data('kia_penanganan', $where_no_ref_pelayanan);
        $cek_pelayanan_ambulan = $this->M_tagihan->get_data('pelayanan_ambulan', $where_no_ref_pelayanan);
        $cek_penjualan_obat_apotik = $this->M_tagihan->get_data('penjualan_obat_apotik', $where_no_ref_pelayanan);
        $cek_transaksi_rawat_inap = $this->M_tagihan->get_data('transaksi_rawat_inap', $where_no_ref_pelayanan);
        $cek_transaksi_lain = $this->M_tagihan->get_data('transaksi_lain', $where_no_ref_pelayanan);

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

            // $data_update_status_pelayanan = array(
            //     'tipe_pelayanan' => 'Rawat Inap'
            // );
            // $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);

            // Start of Cek apakah ada data detail post masuk ? no_bp_t harga_bp_tindakan
            if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan']) && isset($_POST['qty_bp_tindakan'])) {

                // $data_update_status_pelayanan = array(
                //     'tipe_pelayanan' => 'Rawat Jalan'
                // );
                // $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);

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

            // $data_update_status_pelayanan = array(
            //     'tipe_pelayanan' => 'Rawat Inap'
            // );
            // $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);

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

                // $data_update_status_pelayanan = array(
                //     'tipe_pelayanan' => 'Rawat Jalan'
                // );
                // $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);

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
            if (isset($_POST['no_ambulance']) && isset($_POST['harga_ambulance'])) {

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
            if (isset($_POST['no_ambulance']) && isset($_POST['harga_ambulance'])) {

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

            // Start of Cek apakah ada data detail post masuk ? kode_obat harga_apotek_obat qty_apotek_obat
            if (isset($_POST['kode_obat']) && isset($_POST['harga_apotek_obat']) && isset($_POST['qty_apotek_obat'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];

                    $status_paket_tmp = isset($this->input->post('status_paket_apotek_obat')[$i]) ? $this->input->post('status_paket_apotek_obat')[$i] : "Tidak";
                    $status_paket = "Tidak";
                    if ($status_paket_tmp == "Ya") {
                        $status_paket = "Ya";
                    }

                    $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                    $qty = (int) $qty_temp;

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
                            $qty_lama = $data->qty;
                        }

                        $qty_sekarang = $qty_lama - $qty;

                        if ($qty_sekarang < 0) {
                            $qty_sekarang = 0;
                        }

                        $data = array(
                            'qty' => $qty_sekarang
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
            if (isset($_POST['kode_obat']) && isset($_POST['harga_apotek_obat']) && isset($_POST['qty_apotek_obat'])) {

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

                    $status_paket_tmp = isset($this->input->post('status_paket_apotek_obat')[$i]) ? $this->input->post('status_paket_apotek_obat')[$i] : "Tidak";
                    $status_paket = "Tidak";
                    if ($status_paket_tmp == "Ya") {
                        $status_paket = "Ya";
                    }

                    $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                    $qty = (int) $qty_temp;

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
                            $qty_lama = $data->qty;
                        }

                        $qty_sekarang = $qty_lama - $qty;

                        if ($qty_sekarang < 0) {
                            $qty_sekarang = 0;
                        }

                        $data = array(
                            'qty' => $qty_sekarang
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

            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_obat');
            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_tindakan');
            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_kamar');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ?
            if (isset($_POST['no_stok_obat_rawat_i']) || isset($_POST['no_rawat_inap_t']) || isset($_POST['no_kamar_rawat_i'])) {

                // no_stok_obat_rawat_i harga_ri_obat qty_ri_obat
                if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_ri_obat']) && isset($_POST['qty_ri_obat'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                        $no_stok_obat_rawat_i = $this->input->post('no_stok_obat_rawat_i')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_obat')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i,
                            'qty' => $qty,
                            'harga_jual' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_obat', $data);

                        // update qty obat lama dibawah ini
                        if ($btn_simpan == "simpan_final") {
                            $where_no_stok_obat_rawat_i = array(
                                'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i
                            );

                            $ambil_data = $this->M_tagihan->get_data('stok_obat_rawat_inap', $where_no_stok_obat_rawat_i);
                            $qty_lama = "kosong";
                            foreach ($ambil_data->result() as $data) {
                                $qty_lama = $data->qty;
                            }

                            $qty_sekarang = $qty_lama - $qty;

                            if ($qty_sekarang < 0) {
                                $qty_sekarang = 0;
                            }

                            $data = array(
                                'qty' => $qty_sekarang
                            );
                            $update = $this->M_tagihan->update_data($where_no_stok_obat_rawat_i, 'stok_obat_rawat_inap', $data);
                        }
                    }
                }

                // no_rawat_inap_t harga_ri_tindakan
                if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_ri_tindakan']) && isset($_POST['qty_ri_tindakan'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                        $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_tindakan')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_rawat_inap_t' => $no_rawat_inap_t,
                            'qty' => $qty,
                            'harga' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                    }
                }

                // no_kamar_rawat_i tanggal_cek_in_ri_kamar tanggal_cek_out_ri_kamar jumlah_hari_ri_kamar harga_harian_ri_kamar status_kamar_ri_kamar
                if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_ri_kamar']) && isset($_POST['jumlah_hari_ri_kamar'])) {

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

            // $data_update_status_pelayanan = array(
            //     'tipe_pelayanan' => 'Rawat Jalan'
            // );
            // $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);

            // Start of Cek apakah ada data detail post masuk ?
            if (isset($_POST['no_stok_obat_rawat_i']) || isset($_POST['no_rawat_inap_t']) || isset($_POST['no_kamar_rawat_i'])) {

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

                // $data_update_status_pelayanan = array(
                //     'tipe_pelayanan' => 'Rawat Inap'
                // );
                // $this->M_tagihan->update_data($where_no_ref_pelayanan, 'pelayanan', $data_update_status_pelayanan);

                $tambah = $this->M_tagihan->input_data('transaksi_rawat_inap', $data);

                // no_stok_obat_rawat_i harga_ri_obat qty_ri_obat
                if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_ri_obat']) && isset($_POST['qty_ri_obat'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                        $no_stok_obat_rawat_i = $this->input->post('no_stok_obat_rawat_i')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_obat')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i,
                            'qty' => $qty,
                            'harga_jual' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_obat', $data);

                        // update qty obat lama dibawah ini
                        if ($btn_simpan == "simpan_final") {
                            $where_no_stok_obat_rawat_i = array(
                                'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i
                            );

                            $ambil_data = $this->M_tagihan->get_data('stok_obat_rawat_inap', $where_no_stok_obat_rawat_i);
                            $qty_lama = "kosong";
                            foreach ($ambil_data->result() as $data) {
                                $qty_lama = $data->qty;
                            }

                            $qty_sekarang = $qty_lama - $qty;

                            if ($qty_sekarang < 0) {
                                $qty_sekarang = 0;
                            }

                            $data = array(
                                'qty' => $qty_sekarang
                            );
                            $update = $this->M_tagihan->update_data($where_no_stok_obat_rawat_i, 'stok_obat_rawat_inap', $data);
                        }
                    }
                }

                // no_rawat_inap_t harga_ri_tindakan
                if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_ri_tindakan']) && isset($_POST['qty_ri_tindakan'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                        $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_tindakan')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_rawat_inap_t' => $no_rawat_inap_t,
                            'qty' => $qty,
                            'harga' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                    }
                }

                // no_kamar_rawat_i tanggal_cek_in_ri_kamar tanggal_cek_out_ri_kamar jumlah_hari_ri_kamar harga_harian_ri_kamar status_kamar_ri_kamar
                if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_ri_kamar']) && isset($_POST['jumlah_hari_ri_kamar'])) {

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
            }
            // End of Cek apakah ada data detail post masuk ?
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

        if ($btn_simpan == "simpan_final") {
            $count_transaction = $this->M_v_rawat_inap->countRecordWithTglKeluarParam();
            $temp_saldo = "";
            if ($count_transaction == 0) {
                $temp_saldo = 0;
            } else if ($count_transaction > 0) {
                foreach ($this->M_v_rawat_inap->getLastRecordWithTglKeluarParam() as $i) {
                    $temp_saldo = $i->temp_saldo;
                }
            }
            $grand_total = preg_replace("/[^0-9]/", "", $this->input->post('grand_total'));
            $new_saldo = $temp_saldo + $grand_total;

            $data_update_status_pelayanan = array(
                'status' => 'finish',
                'tgl_keluar' => date('Y-m-d H:i:s'),
                'grand_total' => $grand_total,
                'temp_saldo' => $new_saldo,
                'saldo' => $new_saldo
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
    function cetak($no_ref_pelayanan)
    {
        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );
        $data_pelayanan_pasien = $this->M_tagihan->get_data('data_pelayanan_pasien_default', $where_no_ref_pelayanan)->row();
        $nama_pasien = $data_pelayanan_pasien->nama;
        $no_rm = $data_pelayanan_pasien->no_rm;
        $no_ref = $data_pelayanan_pasien->no_ref_pelayanan;
        $tgl_pelayanan_tmp = $data_pelayanan_pasien->tgl_pelayanan;
        $tgl_pelayanan = tgl_indo(date('Y-m-d', strtotime($tgl_pelayanan_tmp)));
        $tipe_pelayanan = $data_pelayanan_pasien->tipe_pelayanan;

        $cek_lab_transaksi2 = $this->M_tagihan->get_data('lab_transaksi', $where_no_ref_pelayanan);
        $cek_bp_penanganan2 = $this->M_tagihan->get_data('bp_penanganan', $where_no_ref_pelayanan);
        $cek_ugd_penanganan2 = $this->M_tagihan->get_data('ugd_penanganan', $where_no_ref_pelayanan);
        $cek_kia_penanganan2 = $this->M_tagihan->get_data('kia_penanganan', $where_no_ref_pelayanan);
        $cek_pelayanan_ambulan2 = $this->M_tagihan->get_data('pelayanan_ambulan', $where_no_ref_pelayanan);
        $cek_penjualan_obat_apotik2 = $this->M_tagihan->get_data('penjualan_obat_apotik', $where_no_ref_pelayanan);
        $cek_transaksi_rawat_inap2 = $this->M_tagihan->get_data('transaksi_rawat_inap', $where_no_ref_pelayanan);
        $cek_transaksi_lain2 = $this->M_tagihan->get_data('transaksi_lain', $where_no_ref_pelayanan);

        $harga_tindakan_bp = 0;
        $harga_tindakan_kia = 0;
        $harga_tindakan_lab = 0;
        $harga_tindakan_ugd = 0;
        $harga_apotek_total = 0;
        $harga_kamar_ri = 0;
        $harga_tindakan_ri = 0;
        $harga_obat_ri = 0;
        $harga_ambulance = 0;
        $harga_lain = 0;
        $grand_total = 0;
        $image = base_url('assets/sb_admin_2/img/logo.jpg');
        $html = '
            <table width="100%">
                <tr>
                    <td width="14%" style="padding-right:10px;"><img width="100" height="100" src="' . $image . '"></td>
                    <td colspan="6"><span style="font-size:20px;">KLINIK PRATAMA RAWAT INAP AMPEL SEHAT </span> <br> <span style="font-size:15px">Jl. Sunan Muria No.10 Ampel Wuluhan Jember<span> <br> <span style="font-size:15px">Telp (0336) 622454 | Kode Pos 68162 </span></td>
                </tr>
                <tr>
                    <td colspan="7"><hr></td>
                </tr>
                <tr>
						<td width="14%">Nama</td>
						<td width="1%">:</td>
						<td width="37%">' . $nama_pasien . '</td>
						<td width="20%">No Ref Pelayanan</td>
						<td width="1%">:</td>
						<td width="27%">' . $no_ref . '</td>
					</tr>
					<tr>
						<td>Nomor RM</td>
						<td>:</td>
						<td>' . $no_rm . '</td>
						<td>Tanggal</td>
						<td>:</td>
						<td>' . $tgl_pelayanan . '</td>
                    </tr>
                <tr>
                    <td colspan="7"><hr></td>
                </tr>
            <table>
            <table style="margin-top:5px" width="100%">
                <tr>
                    <td><p style="font-weight:normal">Rincian Transaksi</p></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">Biaya</td>
                </tr>';

        if ($cek_bp_penanganan2->num_rows() > 0) {
            foreach ($cek_bp_penanganan2->result() as $data_bp) {
                $no_bp_p = $data_bp->no_bp_p;
            }

            $where_no_bp_p = array(
                'no_bp_p' => $no_bp_p
            );
            $detail_penanganan_bp = $this->M_tagihan->get_data('daftar_detail_tindakan_bp_transaksi', $where_no_bp_p);

            $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Balai Pengobatan</i></td>
                </tr>';
            foreach ($detail_penanganan_bp->result() as $detail_bp) {
                $harga_tindakan_bp += $detail_bp->harga_tindakan * $detail_bp->qty;
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">' . $detail_bp->nama . '</td>
                    <td style="text-align:right">' . $detail_bp->qty . " x" . '</td>
                    <td style="text-align:right">' . rupiah($detail_bp->harga_tindakan) . '</td>
                    <td style="text-align:right">' . rupiah($detail_bp->harga_tindakan * $detail_bp->qty) . '</td>
                </tr>';
            }
        }

        if ($cek_kia_penanganan2->num_rows() > 0) {
            foreach ($cek_kia_penanganan2->result() as $data_kia) {
                $no_kia_p = $data_kia->no_kia_p;
            }

            $where_no_kia_p = array(
                'no_kia_p' => $no_kia_p
            );
            $detail_penanganan_kia = $this->M_tagihan->get_data('daftar_detail_tindakan_kia_transaksi', $where_no_kia_p);
            $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Poli KIA</i></td>
                </tr>';
            foreach ($detail_penanganan_kia->result() as $detail_kia) {
                $harga_tindakan_kia += $detail_kia->harga * $detail_kia->qty;
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">' . $detail_kia->nama . '</td>
                    <td style="text-align:right">' . $detail_kia->qty . " x" . '</td>
                    <td style="text-align:right">' . rupiah($detail_kia->harga) . '</td>
                    <td style="text-align:right">' . rupiah($detail_kia->harga * $detail_kia->qty) . '</td>
                </tr>';
            }
        }

        if ($cek_lab_transaksi2->num_rows() > 0) {
            foreach ($cek_lab_transaksi2->result() as $data_lab) {
                $no_lab_t = $data_lab->no_lab_t;
            }

            $where_no_lab_t = array(
                'no_lab_t' => $no_lab_t
            );
            $detail_penanganan_lab = $this->M_tagihan->get_data('daftar_detail_tindakan_lab_transaksi', $where_no_lab_t);
            $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Laboratorium</i></td>
                </tr>';
            foreach ($detail_penanganan_lab->result() as $detail_lab) {
                $harga_tindakan_lab += $detail_lab->harga * $detail_lab->qty;
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">' . $detail_lab->nama . '</td>
                    <td style="text-align:right">' . $detail_lab->qty . " x" . '</td>
                    <td style="text-align:right">' . rupiah($detail_lab->harga) . '</td>
                    <td style="text-align:right">' . rupiah($detail_lab->harga * $detail_lab->qty) . '</td>
                </tr>';
            }
        }

        if ($cek_ugd_penanganan2->num_rows() > 0) {
            foreach ($cek_ugd_penanganan2->result() as $data_ugd) {
                $no_ugd_p = $data_ugd->no_ugd_p;
            }

            $where_no_ugd_p = array(
                'no_ugd_p' => $no_ugd_p
            );
            $detail_penanganan_ugd = $this->M_tagihan->get_data('daftar_detail_tindakan_ugd_transaksi', $where_no_ugd_p);

            $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan UGD</i></td>
                </tr>';
            foreach ($detail_penanganan_ugd->result() as $detail_ugd) {
                $harga_tindakan_ugd += $detail_ugd->harga * $detail_ugd->qty;
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">' . $detail_ugd->nama . '</td>
                    <td style="text-align:right">' . $detail_ugd->qty . " x" . '</td>
                    <td style="text-align:right">' . rupiah($detail_ugd->harga) . '</td>
                    <td style="text-align:right">' . rupiah($detail_ugd->harga * $detail_ugd->qty) . '</td>
                </tr>';
            }
        }

        if ($cek_penjualan_obat_apotik2->num_rows() > 0) {
            foreach ($cek_penjualan_obat_apotik2->result() as $data_apotik) {
                $no_penjualan_obat_a = $data_apotik->no_penjualan_obat_a;
            }

            $where_no_penjualan_obat_a = array(
                'no_penjualan_obat_a' => $no_penjualan_obat_a
            );
            $detail_penjualan_apotik = $this->M_tagihan->get_data('daftar_penjualan_obat_apotek_detail', $where_no_penjualan_obat_a)->result();
            $harga_apotek_totals = 0;
            foreach ($detail_penjualan_apotik as $data_apotikss) {
                $harga_apotek_totals += $data_apotikss->harga_jual * $data_apotikss->qty;
            }
            if ($harga_apotek_totals != 0) {
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Apotek</i></td>
                </tr>';
                foreach ($detail_penjualan_apotik as $data_apotiks) {
                    $harga_apotek_total += $data_apotiks->harga_jual * $data_apotiks->qty;
                }
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">Biaya Obat-Obatan</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right">' . rupiah($harga_apotek_total) . '</td>
                </tr>';
            }
        }

        if ($cek_transaksi_rawat_inap2->num_rows() > 0) {
            foreach ($cek_transaksi_rawat_inap2->result() as $data_rawat_inap) {
                $no_transaksi_rawat_i = $data_rawat_inap->no_transaksi_rawat_i;
            }

            $where_no_transaksi_rawat_i = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );

            $detail_kamar_ri = $this->M_tagihan->get_data('daftar_detail_kamar_rawat_inap', $where_no_transaksi_rawat_i)->result();
            $detail_tindakan_ri = $this->M_tagihan->get_data('daftar_detail_tindakan_rawat_inap', $where_no_transaksi_rawat_i)->result();
            $detail_obat_ri = $this->M_tagihan->get_data('daftar_penjualan_obat_rawat_inap_detail', $where_no_transaksi_rawat_i)->result();

            $no_rawat_inap_t = "kosong";
            foreach ($detail_tindakan_ri as $detail_tindakan_rawat_inap) {
                $no_rawat_inap_t = $detail_tindakan_rawat_inap->no_rawat_inap_t;
            }

            $no_detail_transaksi_rawat_inap_k = "kosong";
            foreach ($detail_kamar_ri as $detail_kamar_rawat_inap) {
                $no_detail_transaksi_rawat_inap_k = $detail_kamar_rawat_inap->no_detail_transaksi_rawat_inap_k;
            }

            $no_stok_obat_rawat_i = "kosong";
            foreach ($detail_obat_ri as $detail_obat_rawat_inap) {
                $no_stok_obat_rawat_i = $detail_obat_rawat_inap->no_stok_obat_rawat_i;
            }

            $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Rawat inap</i></td>
                </tr>';

            if ($no_detail_transaksi_rawat_inap_k != "kosong") {
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">Kamar</td>
                </tr>';
                foreach ($detail_kamar_ri as $detail_rawat_inap_k) {
                    $harga_kamar_ri += $detail_rawat_inap_k->jumlah_hari * $detail_rawat_inap_k->harga_harian;

                    $html .= '
                <tr>
                    <td style="text-align:left;padding-left:40px">' . $detail_rawat_inap_k->nama . '</td>
                    <td style="text-align:right">' . $detail_rawat_inap_k->jumlah_hari . " hari" . '</td>
                    <td style="text-align:right">' . rupiah($detail_rawat_inap_k->harga_harian) . '</td>
                    <td style="text-align:right">' . rupiah($detail_rawat_inap_k->jumlah_hari * $detail_rawat_inap_k->harga_harian) . '</td>
                </tr>';
                }
            }

            if ($no_rawat_inap_t != "kosong") {
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">Tindakan Rawat Inap</td>
                </tr>';
                foreach ($detail_tindakan_ri as $detail_rawat_inap_t) {
                    $harga_tindakan_ri += $detail_rawat_inap_t->harga * $detail_rawat_inap_t->qty;
                    $html .= '
                <tr>
                    <td style="text-align:left;padding-left:40px">' . $detail_rawat_inap_t->nama . '</td>
                    <td style="text-align:right">' . $detail_rawat_inap_t->qty . " x" . '</td>
                    <td style="text-align:right">' . rupiah($detail_rawat_inap_t->harga) . '</td>
                    <td style="text-align:right">' . rupiah($detail_rawat_inap_t->harga * $detail_rawat_inap_t->qty) . '</td>
                </tr>';
                }
            }

            if ($no_stok_obat_rawat_i != "kosong") {
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:20px">Obat Rawat Inap</td>
                </tr>';
                foreach ($detail_obat_ri as $detail_rawat_inap_o) {
                    $harga_obat_ri += $detail_rawat_inap_o->harga_jual * $detail_rawat_inap_o->qty;
                }
                $html .= '
                <tr>
                    <td style="text-align:left;padding-left:40px">Biaya Obat-Obatan</td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right"></td>
                    <td style="text-align:right">' . rupiah($harga_obat_ri) . '</td>
                </tr>';
            }
        }
        if ($cek_transaksi_lain2->num_rows() > 0) {
            foreach ($cek_transaksi_lain2->result() as $data_lain) {
                $no_transaksi_lain = $data_lain->no_transaksi_lain;
            }

            $where_no_transaksi_lain = array(
                'no_transaksi_lain' => $no_transaksi_lain
            );
            $detail_transaksi_lain = $this->M_tagihan->get_data('daftar_detail_transaksi_lain', $where_no_transaksi_lain)->result();
            foreach ($detail_transaksi_lain as $detail_lain) {
                $harga_lain += $detail_lain->qty * $detail_lain->harga;
            }
            $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Lain-lain</i></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">' . rupiah($harga_lain) . '</td>
                </tr>';
        }

        if ($cek_pelayanan_ambulan2->num_rows() > 0) {
            foreach ($cek_pelayanan_ambulan2->result() as $data_ambulance) {
                $no_pelayanan_a = $data_ambulance->no_pelayanan_a;
            }

            $where_no_pelayanan_a = array(
                'no_pelayanan_a' => $no_pelayanan_a
            );
            $detail_pelayanan_ambulance = $this->M_tagihan->get_data('daftar_detail_pelayanan_ambulan', $where_no_pelayanan_a)->result();
            foreach ($detail_pelayanan_ambulance as $detail_ambulance) {
                $harga_ambulance += $detail_ambulance->harga;
            }
            $html .= '
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Ambulance</i></td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">' . rupiah($harga_ambulance) . '</td>
                </tr>';
        }

        $grand_total = $harga_tindakan_bp + $harga_tindakan_kia + $harga_tindakan_lab + $harga_tindakan_ugd + $harga_apotek_total + $harga_kamar_ri + $harga_tindakan_ri + $harga_obat_ri + $harga_lain + $harga_ambulance;
        $html .= '
                <tr style="line-height:50px;">
                    <td class="font-weight-bold">Jumlah Yang Harus Dibayar</td>
                    <td></td>
                    <td></td>
                    <td style="text-align:right">' . rupiah($grand_total) . '</td>
                </tr>

            </table>';
        $this->dompdf->PdfGenerator($html, 'struk', 'A4', 'potrait', true);
    }
}
