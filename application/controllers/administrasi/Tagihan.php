<?php
class Tagihan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('administrasi/M_tagihan');
        date_default_timezone_set('Asia/Jakarta');
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

    public function tampil_tindakan_bp()
    {
        $data_tbl['tbl_data_bp'] = $this->M_tagihan->tampil_data('bp_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_tindakan_kia()
    {
        $data_tbl['tbl_data_kia'] = $this->M_tagihan->tampil_data('kia_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_tindakan_lab()
    {
        $data_tbl['tbl_data_lab'] = $this->M_tagihan->tampil_data('lab_checkup')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_tindakan_ugd()
    {
        $data_tbl['tbl_data_ugd'] = $this->M_tagihan->tampil_data('ugd_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total_bp()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp'])) {

            for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_bp')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_kia()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia'])) {

            for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_kia')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_lab()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab'])) {

            for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                $harga_jual_temp = $this->input->post('harga_lab')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ugd()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd'])) {

            for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ugd')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }
    public function ambil_grand_total()
    {
        $total = 0;
        $sub_total_bp = 0;
        $total_bp = 0;
        $sub_total_kia = 0;
        $total_kia = 0;
        $sub_total_lab = 0;
        $total_lab = 0;
        $sub_total_ugd = 0;
        $total_ugd = 0;

        if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp'])) {

            for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                $harga_jual_temp_bp = $this->input->post('harga_bp')[$i];
                $harga_jual_bp = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp_bp);

                $perhitungan_bp = $harga_jual_bp;

                $sub_total_bp = $sub_total_bp + $perhitungan_bp;
            }

            $total_bp = $sub_total_bp;
        }

        if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia'])) {

            for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                $harga_jual_temp_kia = $this->input->post('harga_kia')[$i];
                $harga_jual_kia = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp_kia);

                $perhitungan_kia = $harga_jual_kia;

                $sub_total_kia = $sub_total_kia + $perhitungan_kia;
            }

            $total_kia = $sub_total_kia;
        }

        if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab'])) {

            for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                $harga_jual_temp_lab = $this->input->post('harga_lab')[$i];
                $harga_jual_lab = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp_lab);

                $perhitungan_lab = $harga_jual_lab;

                $sub_total_lab = $sub_total_lab + $perhitungan_lab;
            }

            $total_lab = $sub_total_lab;
        }

        if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd'])) {

            for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                $harga_jual_temp_ugd = $this->input->post('harga_ugd')[$i];
                $harga_jual_ugd = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp_ugd);

                $perhitungan_ugd = $harga_jual_ugd;

                $sub_total_ugd = $sub_total_ugd + $perhitungan_ugd;
            }

            $total_ugd = $sub_total_ugd;
        }

        $total = $total_bp + $total_kia + $total_lab + $total_ugd;
        echo $total;
    }

    public function input_transaksi_form()
    {

        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
        if (isset($_POST['no_bp_t'])) {
            date_default_timezone_set('Asia/Jakarta');
            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_bp = $this->M_tagihan->jumlah_baris($where, 'bp_penanganan');
            if ($cek_jumlah_bp > 0) {

                $where = array(
                    'no_ref_pelayanan' => $no_ref_pelayanan
                );
                $ambil_data_bp = $this->M_tagihan->get_data('bp_penanganan', $where)->row();
                $no_bp_p = $ambil_data_bp->no_bp_p;

                // hapus detail yang lama 
                $where_delete = array(
                    'no_bp_p' => $no_bp_p
                );
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_bp_penanganan');

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];
                    $harga_temp = $this->input->post('harga_bp')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_bp = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
                        'harga' => $harga
                    );

                    $this->M_tagihan->input_data('detail_bp_penanganan', $detail_bp);
                }
                $where_no_bp_p = array(
                    'no_bp_p' => $no_bp_p
                );
                $ambil_detail_bp = $this->M_tagihan->get_data('detail_bp_penanganan',$where_no_bp_p)->result();
                $sub_total_harga = 0;
                foreach($ambil_detail_bp as $row_bp)
                {
                    $sub_total_harga += $row_bp->harga;
                }

                $data_total_harga = array(
                    'total_harga' => $sub_total_harga
                );

                $this->M_tagihan->update_data($where,'bp_penanganan',$data_total_harga);

            } else {
                // data transaksi 
                $no_bp_p = $this->M_tagihan->get_no_transaksi_bp(); // generate
                $tgl_penanganan = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('total_harga_bp');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data_bp = array(
                    'no_bp_p' => $no_bp_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_penanganan,
                    'total_harga' => $total_harga
                );

                $this->M_tagihan->input_data('bp_penanganan', $data_bp);
                // end of data transaksi 

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];
                    $harga_temp = $this->input->post('harga_bp')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_bp = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
                        'harga' => $harga
                    );

                    $this->M_tagihan->input_data('detail_bp_penanganan', $detail_bp);
                }
            }
        }
        if (isset($_POST['no_kia_t'])) {
            date_default_timezone_set('Asia/Jakarta');
            // data transaksi 
            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_kia = $this->M_tagihan->jumlah_baris($where, 'kia_penanganan');
            if ($cek_jumlah_kia > 0) {
                $where = array(
                    'no_ref_pelayanan' => $no_ref_pelayanan
                );
                $ambil_data_kia = $this->M_tagihan->get_data('kia_penanganan', $where)->row();
                $no_kia_p = $ambil_data_kia->no_kia_p;

                // hapus detail yang lama 
                $where_delete = array(
                    'no_kia_p' => $no_kia_p
                );
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_kia_penanganan');

                for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                    $no_kia_t = $this->input->post('no_kia_t')[$i];
                    $harga_temp = $this->input->post('harga_kia')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_kia = array(
                        'no_kia_p' => $no_kia_p,
                        'no_kia_t' => $no_kia_t,
                        'harga' => $harga
                    );
                    $this->M_tagihan->input_data('detail_kia_penanganan', $detail_kia);
                }

                $where_no_kia_p = array(
                    'no_kia_p' => $no_kia_p
                );
                $ambil_detail_kia = $this->M_tagihan->get_data('detail_kia_penanganan',$where_no_kia_p)->result();
                $sub_total_harga = 0;
                foreach($ambil_detail_kia as $row_kia)
                {
                    $sub_total_harga += $row_kia->harga;
                }

                $data_total_harga = array(
                    'total_harga' => $sub_total_harga
                );

                $this->M_tagihan->update_data($where,'kia_penanganan',$data_total_harga);

            } else {
                $no_kia_p = $this->M_tagihan->get_no_transaksi_kia(); // generate
                $tgl_penanganan = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('total_harga_kia');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);
                $data_kia = array(
                    'no_kia_p' => $no_kia_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_penanganan,
                    'total_harga' => $total_harga
                );

                $this->M_tagihan->input_data('kia_penanganan', $data_kia);
                // end of data transaksi 
                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                    $no_kia_t = $this->input->post('no_kia_t')[$i];
                    $harga_temp = $this->input->post('harga_kia')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_kia = array(
                        'no_kia_p' => $no_kia_p,
                        'no_kia_t' => $no_kia_t,
                        'harga' => $harga
                    );
                    $this->M_tagihan->input_data('detail_kia_penanganan', $detail_kia);
                }
            }
        }
        if (isset($_POST['no_lab_c'])) {

            date_default_timezone_set('Asia/Jakarta');
            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_lab = $this->M_tagihan->jumlah_baris($where, 'lab_transaksi');
            if ($cek_jumlah_lab > 0) {
                $where = array(
                    'no_ref_pelayanan' => $no_ref_pelayanan
                );
                $ambil_data_lab = $this->M_tagihan->get_data('lab_transaksi', $where)->row();
                $no_lab_t = $ambil_data_lab->no_lab_t;

                // hapus detail yang lama 
                $where_delete = array(
                    'no_lab_t' => $no_lab_t
                );
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_lab_transaksi');

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                    $no_lab_c = $this->input->post('no_lab_c')[$i];
                    $harga_temp = $this->input->post('harga_lab')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_lab = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
                        'harga' => $harga
                    );

                    $this->M_tagihan->input_data('detail_lab_transaksi', $detail_lab);
                }
                $where_no_lab_t = array(
                    'no_lab_t' => $no_lab_t
                );
                $ambil_detail_lab = $this->M_tagihan->get_data('detail_lab_transaksi',$where_no_lab_t)->result();
                $sub_total_harga = 0;
                foreach($ambil_detail_lab as $row_lab)
                {
                    $sub_total_harga += $row_lab->harga;
                }

                $data_total_harga = array(
                    'total_harga' => $sub_total_harga
                );

                $this->M_tagihan->update_data($where,'lab_transaksi',$data_total_harga);
            } else {
                // data transaksi 
                $no_lab_t = $this->M_tagihan->get_no_transaksi_lab(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('total_harga_lab');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data_lab = array(
                    'no_lab_t' => $no_lab_t,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $this->M_tagihan->input_data('lab_transaksi', $data_lab);
                // end of data transaksi 
                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                    $no_lab_c = $this->input->post('no_lab_c')[$i];
                    $harga_temp = $this->input->post('harga_lab')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_lab = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
                        'harga' => $harga
                    );

                    $this->M_tagihan->input_data('detail_lab_transaksi', $detail_lab);
                }
            }
        }
        if (isset($_POST['no_ugd_t'])) {

            date_default_timezone_set('Asia/Jakarta');

            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_ugd = $this->M_tagihan->jumlah_baris($where, 'ugd_penanganan');
            if ($cek_jumlah_ugd > 0) {
                $where = array(
                    'no_ref_pelayanan' => $no_ref_pelayanan
                );
                $ambil_data_ugd = $this->M_tagihan->get_data('ugd_penanganan', $where)->row();
                $no_ugd_p = $ambil_data_ugd->no_ugd_p;

                // hapus detail yang lama 
                $where_delete = array(
                    'no_ugd_p' => $no_ugd_p
                );
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_ugd_penanganan');

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];
                    $harga_temp = $this->input->post('harga_ugd')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_ugd = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
                        'harga' => $harga
                    );

                    $this->M_tagihan->input_data('detail_ugd_penanganan', $detail_ugd);
                }
                $where_no_ugd_p = array(
                    'no_ugd_p' => $no_ugd_p
                );
                $ambil_detail_ugd = $this->M_tagihan->get_data('detail_ugd_penanganan',$where_no_ugd_p)->result();
                $sub_total_harga = 0;
                foreach($ambil_detail_ugd as $row_ugd)
                {
                    $sub_total_harga += $row_ugd->harga;
                }

                $data_total_harga = array(
                    'total_harga' => $sub_total_harga
                );

                $this->M_tagihan->update_data($where,'ugd_penanganan',$data_total_harga);
            } else {
                // data transaksi 
                $no_ugd_p = $this->M_tagihan->get_no_transaksi_ugd(); // generate
                $tgl_penanganan = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('total_harga_ugd');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data_ugd = array(
                    'no_ugd_p' => $no_ugd_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_penanganan,
                    'total_harga' => $total_harga
                );

                $this->M_tagihan->input_data('ugd_penanganan', $data_ugd);
                // end of data transaksi 

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];
                    $harga_temp = $this->input->post('harga_ugd')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_ugd = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
                        'harga' => $harga
                    );

                    $this->M_tagihan->input_data('detail_ugd_penanganan', $detail_ugd);
                }
            }
        }

        if (isset($_POST['no_kamar_rawat_i']) || isset($_POST['no_rawat_inap_t']) || isset($_POST['no_stok_obat_rawat_i'])) {

            $status_transaksi = true;
            $no_transaksi_rawat_i = '';

            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_transaksi = $this->M_tagihan->jumlah_baris($where, 'transaksi_rawat_inap');
            if ($cek_jumlah_transaksi > 0) {

                $ambil_data_transaksi = $this->M_tagihan->get_data('transaksi_rawat_inap', $where)->row();
                $no_transaksi_rawat_i = $ambil_data_transaksi->no_transaksi_rawat_i;
            } else {

                // data transaksi 
                $no_transaksi_rawat_i = $this->M_tagihan->get_no_transaksi_rawat_inap(); // generate
                $atas_nama = "kkk"; // datadumb
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_harga_kamar');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'atas_nama' => $atas_nama,
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $status_transaksi = $this->M_tagihan->input_data('transaksi_rawat_inap', $data);
            }

            if ($status_transaksi) {

                // hapus detail yang lama 
                $where_delete = array(
                    'no_transaksi_rawat_i' => $no_transaksi_rawat_i
                );
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_transaksi_rawat_inap_kamar');
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_transaksi_rawat_inap_tindakan');
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_transaksi_rawat_inap_obat');

                // start of insert Kamar //////////
                if (isset($_POST['no_kamar_rawat_i'])) {

                    // tambah detail transaksi
                    for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                        $no_kamar_rawat_i = $this->input->post('no_kamar_rawat_i')[$i];
                        $harga_temp = $this->input->post('harga_harian_kamar')[$i];
                        $harga_harian = preg_replace("/[^0-9]/", "", $harga_temp);
                        $jumlah_hari = $this->input->post('jumlah_hari')[$i];
                        $sub_total_harga = $harga_harian * $jumlah_hari;

                        // proses pemasukan ke dalam database detail
                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_kamar_rawat_i' => $no_kamar_rawat_i,
                            'harga_harian' => $harga_harian,
                            'jumlah_hari' => $jumlah_hari,
                            'sub_total_harga' => $sub_total_harga
                        );

                        $status = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_kamar', $data);
                    }
                }
                // start of Kamar //////////

                // start of insert Tindakan //////////
                if (isset($_POST['no_rawat_inap_t'])) {

                    // tambah detail transaksi
                    for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                        $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];
                        $harga_temp = $this->input->post('harga_tindakan')[$i];
                        $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                        // proses pemasukan ke dalam database detail
                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_rawat_inap_t' => $no_rawat_inap_t,
                            'harga' => $harga
                        );

                        $status = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                    }
                }
                // start of Tindakan //////////

                // start of insert Obat //////////
                if (isset($_POST['no_stok_obat_rawat_i'])) {

                    // tambah detail transaksi
                    for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                        $no_stok_obat_rawat_i = $this->input->post('no_stok_obat_rawat_i')[$i];
                        $harga_temp = $this->input->post('harga_obat')[$i];
                        $harga_jual = preg_replace("/[^0-9]/", "", $harga_temp);
                        $qty = $this->input->post('qty')[$i];
                        $sub_total_harga = $harga_jual * $qty;

                        // proses pemasukan ke dalam database detail
                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i,
                            'qty' => $qty,
                            'harga_jual' => $harga_jual,
                            'sub_total_harga' => $sub_total_harga
                        );

                        $status = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_obat', $data);
                    }
                }
                // start of Obat //////////
            }
        }

        if (isset($_POST['no_stok_obat_a'])) {

            date_default_timezone_set('Asia/Jakarta');

            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_transaksi = $this->M_tagihan->jumlah_baris($where, 'penjualan_obat_apotik');
            if ($cek_jumlah_transaksi > 0) {
                $where = array(
                    'no_ref_pelayanan' => $no_ref_pelayanan
                );
                $ambil_data_transaksi = $this->M_tagihan->get_data('penjualan_obat_apotik', $where)->row();
                $no_penjualan_obat_a = $ambil_data_transaksi->no_penjualan_obat_a;

                // hapus detail yang lama 
                $where_delete = array(
                    'no_penjualan_obat_a' => $no_penjualan_obat_a
                );
                $hapus = $this->M_tagihan->hapus_data($where_delete, 'detail_penjualan_obat_apotik');

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_stok_obat_a')); $i++) {

                    $no_stok_obat_a = $this->input->post('no_stok_obat_a')[$i];
                    $harga_temp = $this->input->post('harga_jual_apotek_jual')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    $qty_temp = $this->input->post('qty_apotek_jual')[$i];
                    $qty = preg_replace("/[^0-9]/", "", $qty_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_ugd = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'no_stok_obat_a' => $no_stok_obat_a,
                        'qty' => $qty,
                        'harga_jual' => $harga
                    );

                    $this->M_tagihan->input_data('detail_penjualan_obat_apotik', $detail_ugd);
                }
            } else {
                // data transaksi 
                $no_penjualan_obat_a = $this->M_tagihan->get_no_transaksi(); // generate
                $tgl_penanganan = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_harga_apotek_jual');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data_transaksi = array(
                    'no_penjualan_obat_a' => $no_penjualan_obat_a,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tanggal_penjualan' => $tgl_penanganan,
                    'total_harga' => $total_harga
                );

                $this->M_tagihan->input_data('penjualan_obat_apotik', $data_transaksi);
                // end of data transaksi 

                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_stok_obat_a')); $i++) {

                    $no_stok_obat_a = $this->input->post('no_stok_obat_a')[$i];
                    $harga_temp = $this->input->post('harga_jual_apotek_jual')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    $qty_temp = $this->input->post('qty_apotek_jual')[$i];
                    $qty = preg_replace("/[^0-9]/", "", $qty_temp);

                    // proses pemasukan ke dalam database detail
                    $detail_ugd = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'no_stok_obat_a' => $no_stok_obat_a,
                        'qty' => $qty,
                        'harga_jual' => $harga
                    );

                    $this->M_tagihan->input_data('detail_penjualan_obat_apotik', $detail_ugd);
                }
            }
        }
        if($_POST['status_pakai_ambulan'] == "Pakai")
        {
            $harga = $this->input->post('harga_ambulan');
            $tujuan_ambulan = $this->input->post('tujuan_ambulan');
            $where_no_ambulan = array(
                'tujuan' => $tujuan_ambulan
            );
            $ambil_ambulan = $this->M_tagihan->get_data('ambulan',$where_no_ambulan)->row();
            $no_ambulan = $ambil_ambulan->no_ambulan;
            $harga_ambulan = preg_replace("/[^0-9]/", "", $harga);
            $data_ambulan = array(
                'no_pelayanan_a' => $this->M_tagihan->get_no_transaksi_ambulan(),
                'no_ref_pelayanan' =>  $no_ref_pelayanan,
                'no_ambulan' => $no_ambulan,
                'harga' => $harga_ambulan
            );
            $this->M_tagihan->input_data('pelayanan_ambulan', $data_ambulan);
        }
        // Print

        $ambil_nama = $this->M_tagihan->get_data('data_pelayanan_pasien', $where)->row();
        $nama_pasien = $ambil_nama->nama;
        $no_rm = $ambil_nama->no_rm;
        $tgl_pelayanan = $ambil_nama->tgl_pelayanan;
        $tgl_indo = date('Y-m-d',strtotime($tgl_pelayanan));

        $ambil_data_bp = $this->M_tagihan->get_data('bp_penanganan', $where)->row();
        $no_bp_p = $ambil_data_bp->no_bp_p;

        $ambil_data_kia = $this->M_tagihan->get_data('kia_penanganan', $where)->row();
        $no_kia_p = $ambil_data_kia->no_kia_p;

        $ambil_data_lab = $this->M_tagihan->get_data('lab_transaksi', $where)->row();
        $no_lab_t = $ambil_data_lab->no_lab_t;

        $ambil_data_ugd = $this->M_tagihan->get_data('ugd_penanganan', $where)->row();
        $no_ugd_p = $ambil_data_ugd->no_ugd_p;

        $ambil_data_rawat_inap = $this->M_tagihan->get_data('transaksi_rawat_inap', $where)->row();
        $no_transaksi_rawat_i = $ambil_data_rawat_inap->no_transaksi_rawat_i;

        $harga_bp = 0;
        $harga_kia = 0;
        $harga_lab = 0;
        $harga_ugd = 0;
        $harga_obat_apotik = 0;

        $html = '
        <h4 style="text-align:center">Rekening Pasien</h4>
                <table width="100%">
                <tr>
                    <td width="14%">Nama Pasien</td>
                    <td width="1%">:</td>
                    <td width="35%">' . $nama_pasien . '</td>
                    <td width="19%">No Ref Pelayanan</td>
                    <td width="1%">:</td>
                    <td width="30%">' . $no_ref_pelayanan . '</td>
                </tr>
                <tr>
                    <td width="14%">Nomor RM</td>
                    <td width="1%">:</td>
                    <td width="40%">' . $no_rm . '</td>
                    <td width="19%">Tanggal Masuk</td>
                    <td width="1%">:</td>
                    <td width="25%">'.tgl_indo($tgl_indo).'</td>
                </tr>
            </table>
            <hr>
            <table width="100%">
                <tr>
                    <td style="text-align:left">Rincian Transaksi</td>
                    <td style="text-align:right">Biaya</td>
                </tr>';

        if (isset($no_bp_p)) {
            $where_bp = array(
                'no_bp_p' => $no_bp_p
            );
            $ambil_detail_bp = $this->M_tagihan->get_data('detail_tindakan_bp_penanganan', $where_bp)->result();

            $html .= '<tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Balai Pengobatan</i></td>
                </tr>';
            foreach ($ambil_detail_bp as $data_bp) {
                $harga_bp += $data_bp->harga;
                $html .= '<tr>
                    <td style="text-align:left;padding-left:20px">' . $data_bp->nama . '</td>
                    <td style="text-align:right">' . rupiah($data_bp->harga) . '</td>
                </tr>';
            }
        }

        if (isset($no_kia_p)) {
            $where_kia = array(
                'no_kia_p' => $no_kia_p
            );
            $ambil_detail_kia = $this->M_tagihan->get_data('detail_tindakan_kia_penanganan', $where_kia)->result();
            $html .= '<tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Poli KIA</i></td>
                </tr>';
            foreach ($ambil_detail_kia as $data_kia) {
                $harga_kia += $data_kia->harga;
                $html .= '<tr>
                    <td style="text-align:left;padding-left:20px">' . $data_kia->nama . '</td>
                    <td style="text-align:right">' . rupiah($data_kia->harga) . '</td>
                </tr>';
            }
        }

        if (isset($no_lab_t)) {
            $where_lab = array(
                'no_lab_t' => $no_lab_t
            );
            $ambil_detail_lab = $this->M_tagihan->get_data('detail_tindakan_lab_transaksi', $where_lab)->result();
            $html .= '<tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Laboratorium</i></td>
                </tr>';
            foreach ($ambil_detail_lab as $data_lab) {
                $harga_lab += $data_lab->harga;
                $html .= '<tr>
                    <td style="text-align:left;padding-left:20px">' . $data_lab->nama . '</td>
                    <td style="text-align:right">' . rupiah($data_lab->harga) . '</td>
                </tr>';
            }
        }

        if (isset($no_ugd_p)) {
            $where_ugd = array(
                'no_ugd_p' => $no_ugd_p
            );
            $ambil_detail_ugd = $this->M_tagihan->get_data('detail_tindakan_ugd_penanganan', $where_ugd)->result();
            $html .= '<tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan UGD</i></td>
                </tr>';
            foreach ($ambil_detail_ugd as $data_ugd) {
                $harga_ugd += $data_ugd->harga;
                $html .= '<tr>
                    <td style="text-align:left;padding-left:20px">' . $data_ugd->nama . '</td>
                    <td style="text-align:right">' . rupiah($data_ugd->harga) . '</td>
                </tr>';
            }
        }



        if (isset($no_penjualan_obat_a)) {
            $where_no_ref = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $ambil_detail_apotek = $this->M_tagihan->get_data('penjualan_obat_apotik', $where_no_ref)->row();
            $id_penjualan_obat_a = $ambil_detail_apotek->no_penjualan_obat_a;
            $where_id_penjualan = array(
                'no_penjualan_obat_a' => $id_penjualan_obat_a
            );
            $ambil_detail_obat_apotek = $this->M_tagihan->get_data('detail_penjualan_obat_apotik',$where_id_penjualan)->result();
            $harga_obat_apotek = 0;
            foreach($ambil_detail_obat_apotek as $data_apotek)
            {
                $harga_obat_apotek += $data_apotek->qty * $data_apotek->harga_jual;
            }
            $html .= '<tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Obat-obatan</i></td>
                </tr>';
            $html .= '<tr>
                    <td style="text-align:left;padding-left:20px">Apotek</td>
                    <td style="text-align:right">' . rupiah($harga_obat_apotek) . '</td>
                </tr>';
        }

        if (isset($no_transaksi_rawat_i)) {
            $where_rawat_inap = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );
            $ambil_kamar_rawat_inap = $this->M_tagihan->get_data('detail_transaksi_rawat_inap_kamar', $where_rawat_inap)->row();
            $harga_kamar = $ambil_kamar_rawat_inap->sub_total_harga;

            $ambil_tindakan_rawat_inap = $this->M_tagihan->get_data('detail_transaksi_rawat_inap_tindakan', $where_rawat_inap)->result();
            $harga_tindakan = 0;

            $obat_rawat_inap = $this->M_tagihan->get_data('transaksi_rawat_inap', $where)->row();
            $no_transaksi_rawat_i = $obat_rawat_inap->no_transaksi_rawat_i;
            $harga_obat_ri = 0;

            $where_transaksi_rawat_i = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );

            $ambil_obat_kamar_rawat_inap = $this->M_tagihan->get_data('detail_transaksi_rawat_inap_obat', $where_transaksi_rawat_i)->result();
            $html .= '<tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Rawat inap</i></td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">Kamar</td>
                    <td style="text-align:right">' . rupiah($harga_kamar) . '</td>
                </tr>';
            foreach ($ambil_tindakan_rawat_inap as $data_tindakan) {
                $harga_tindakan += $data_tindakan->harga;
            }
            $html .= '<tr>
                    <td style="text-align:left;padding-left:20px">Tindakan Rawat Inap</td>
                    <td style="text-align:right">' . rupiah($harga_tindakan) . '</td>
                </tr>';

            foreach ($ambil_obat_kamar_rawat_inap as $data_obat) {
                $harga_obat_ri += $data_obat->sub_total_harga;
            }
           
            $html .= '<tr>
                        <td style="text-align:left;padding-left:20px">Obat Rawat Inap</td>
                        <td style="text-align:right">' . rupiah($harga_obat_ri) . '</td>
                    </tr>';
                    $where_no_ref = array(
                        'no_ref_pelayanan' => $no_ref_pelayanan
                    );
                    $harga_ambulan = 0;
                    $cek_ambulan = $this->M_tagihan->jumlah_baris($where, 'pelayanan_ambulan');
                    
                    if ($cek_ambulan > 0) {
                        $ambil_pelayanan_ambulan = $this->M_tagihan->get_data('pelayanan_ambulan',$where_no_ref)->row();
                        $harga_ambulan = $ambil_pelayanan_ambulan->harga;
                        $html .= '<tr>
                                <td style="text-align:left;padding-left:10px"><i>Biaya Lain Lain</i></td>
                            </tr>';
                            $html .= '<tr>
                                <td style="text-align:left;padding-left:20px">Biaya Ambulance</td>
                                <td style="text-align:right">' . rupiah($harga_ambulan) . '</td>
                            </tr>';
                        
                    }
                    $grand_total = 0;
                    $grand_total = $harga_bp + $harga_kia + $harga_lab + $harga_ugd + $harga_obat_apotik + $harga_kamar + $harga_tindakan + $harga_obat_ri + $harga_ambulan;
                    $html .='<tr style="line-height:50px;">
                        <td style="text-align:left;">Jumlah yang harus dibayar</td>
                        <td style="text-align:right">' . rupiah($grand_total) . '</td>
                    </tr>
                ';
        }
        $html .= '</table>';
        // $where = array(
        //     'no_ref_pelayanan' => $no_ref_pelayanan
        // );

        // // Update status ke finish
        // $data_update_status = array(
        //     'status' => 'finish'
        // );

        // $this->M_tagihan->update_data($where, 'pelayanan', $data_update_status);
        $this->dompdf->PdfGenerator($html, 'coba', 'A4', 'potrait', true);
        redirect('administrasi/tagihan');
    }

    public function ambil_total_apotek_jual()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_stok_obat_a']) && isset($_POST['harga_jual_apotek_jual']) && isset($_POST['qty_apotek_jual'])) {

            for ($i = 0; $i < count($this->input->post('no_stok_obat_a')); $i++) {

                $harga_jual_temp = $this->input->post('harga_jual_apotek_jual')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_apotek_jual')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_sub_total_kamar_ri()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_kamar']) && isset($_POST['jumlah_hari'])) {

            for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                $harga_temp = $this->input->post('harga_harian_kamar')[$i];
                $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);

                $jumlah_hari_temp = $this->input->post('jumlah_hari')[$i];
                $jumlah_hari = (int) preg_replace("/[^0-9]/", "", $jumlah_hari_temp);

                $perhitungan = $harga * $jumlah_hari;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_sub_total_tindakan_ri()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                $harga_temp = $this->input->post('harga_tindakan')[$i];
                $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);

                $perhitungan = $harga;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_sub_total_obat_ri()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_obat']) && isset($_POST['qty'])) {

            for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                $harga_temp = $this->input->post('harga_obat')[$i];
                $harga = (int) preg_replace("/[^0-9]/", "", $harga_temp);

                $qty_temp = $this->input->post('qty')[$i];
                $qty = (int) preg_replace("/[^0-9]/", "", $qty_temp);

                $perhitungan = $harga * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }
    public function ambil_harga_ambulan()
    {
        $id = $this->input->post('id');
        $where = array(
            'tujuan' => $id
        );
        $ambil = $this->M_tagihan->get_data('ambulan',$where)->row();
        $data = (int)$ambil->harga;
        echo json_encode($data);
    }
}
