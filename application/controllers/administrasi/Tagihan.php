<?php
class Tagihan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        date_default_timezone_set('Asia/Jakarta');
        $this->load->model('ambulance/M_ambulance');
        $this->load->model('administrasi/M_tagihan');
    }

    public function index()
    {
        $this->template->load('sim_klinik/template/administrasi', 'sim_klinik/konten/administrasi/tagihan/tambah');
    }

    public function get_transaksi_pasien()
    {
        $nilai = $this->input->post('nilai');

        $where = array(
            'no_ref_pelayanan' => $nilai
        );

        $data_tbl['daftar_penjualan_obat_apotek_detail'] =  $this->M_tagihan->get_data('daftar_penjualan_obat_apotek_detail', $where)->result();
        $data_tbl['daftar_penjualan_obat_rawat_inap_detail'] =  $this->M_tagihan->get_data('daftar_penjualan_obat_rawat_inap_detail', $where)->result();
        $data_tbl['daftar_detail_tindakan_rawat_inap'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_rawat_inap', $where)->result();
        $data_tbl['daftar_detail_kamar_rawat_inap'] =  $this->M_tagihan->get_data('daftar_detail_kamar_rawat_inap', $where)->result();
        $data_tbl['daftar_detail_tindakan_lab'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_lab', $where)->result();
        $data_tbl['daftar_detail_tindakan_bp'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_bp', $where)->result();
        $data_tbl['daftar_detail_tindakan_ugd'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_ugd', $where)->result();
        $data_tbl['daftar_detail_tindakan_kia'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_kia', $where)->result();

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

        if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

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

        if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_kia_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

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

        if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

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

        if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

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
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                if ($this->input->post('status_kamar_ri_kamar')[$i] == "Belum Cek Out") {
                    $harga_jual = 0;
                }

                $jumlah_hari_temp = $this->input->post('jumlah_hari_ri_kamar')[$i];
                $jumlah_hari = (int) $jumlah_hari_temp;

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

        if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_ri_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function input_transaksi_form()
    {

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
            if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                    $no_lab_c = $this->input->post('no_lab_c')[$i];

                    $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $data = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
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
            if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan'])) {

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

                    $data = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
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
            if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $data = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
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
            if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan'])) {

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

                    $data = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
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
            if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $data = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
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
            if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan'])) {

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

                    $data = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
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
            if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                    $no_kia_t = $this->input->post('no_kia_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_kia_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $data = array(
                        'no_kia_p' => $no_kia_p,
                        'no_kia_t' => $no_kia_t,
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
            if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia_tindakan'])) {

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

                    $data = array(
                        'no_kia_p' => $no_kia_p,
                        'no_kia_t' => $no_kia_t,
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
    }
}
