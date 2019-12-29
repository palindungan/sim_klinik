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

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_tagihan->get_select($no_ref,$nama,'no_ref_pelayanan');
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
        if(isset($_POST['no_bp_t']))
        {
            date_default_timezone_set('Asia/Jakarta');
            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_bp = $this->M_tagihan->jumlah_baris($where,'bp_penanganan');;
            if($cek_jumlah_bp > 0)
            {
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
            else {
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
        else if (isset($_POST['no_kia_t'])) {
            date_default_timezone_set('Asia/Jakarta');
            // data transaksi 
            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_kia = $this->M_tagihan->jumlah_baris($where,'kia_penanganan');
            if($cek_jumlah_kia > 0)
            {
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
            else {
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
        else if (isset($_POST['no_lab_c'])) {

            date_default_timezone_set('Asia/Jakarta');
            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $cek_jumlah_lab = $this->M_tagihan->jumlah_baris($where,'lab_transaksi');
            if($cek_jumlah_lab > 0)
            {
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
            else 
            {
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
        else if (isset($_POST['no_ugd_t'])) {

            date_default_timezone_set('Asia/Jakarta');

            $where = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );
            $this->M_tagihan->jumlah_baris($where,'ugd_penanganan');
            if($cek_jumlah_ugd > 0)
            {
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
            else 
            {
                // data transaksi 
                $no_ugd_p = $this->M_tagihan->get_no_transaksi(); // generate
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
    }

}
