<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('balai_pengobatan/M_transaksi');
        $this->load->model('apotek/M_penjualan_obat');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/balai_pengobatan', 'sim_klinik/konten/balai_pengobatan/transaksi/tambah');
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('bp_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_bp_t']) && isset($_POST['harga'])) {

            for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga')[$i];
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
        $total_tmp = $this->input->post('total_harga');

        if (isset($_POST['no_stok_obat_a'])) {

        // data transaksi
        $no_penjualan_obat_a = $this->M_penjualan_obat->get_no_transaksi(); // generate
        $tanggal_penjualan = date('Y-m-d H:i:s');

        $total_tmp = $this->input->post('sub_total_harga_obat');
        $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

        $data = array(
            'no_penjualan_obat_a' => $no_penjualan_obat_a,
            'no_ref_pelayanan' => $no_ref_pelayanan,
            'tanggal_penjualan' => $tanggal_penjualan,
            'total_harga' => $total_harga
        );

        $status = $this->M_penjualan_obat->input_data('penjualan_obat_apotik', $data);
        // end of data transaksi

            if ($status) {
            // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_stok_obat_a')); $i++) {

                    $no_stok_obat_a = $this->input->post('no_stok_obat_a')[$i];
                    $harga_temp = $this->input->post('harga_obat')[$i];
                    $harga_obat = preg_replace("/[^0-9]/", "", $harga_temp);
                    $qty = $this->input->post('qty')[$i];
                    $qty_sekarang = $this->input->post('qty_sekarang')[$i];
                    $status_paket_tmp = $this->input->post('status_paket')[$i];
                    $status_paket = " ";
                    if($status_paket_tmp == "Ya")
                    {
                        $status_paket = "Ya";
                    }
                    else 
                    {
                        $status_paket = "Tidak";
                    }

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'no_stok_obat_a' => $no_stok_obat_a,
                        'qty' => $qty,
                        'harga_jual' => $harga_obat,
                        'status_paket' => $status_paket
                    );

                    $status_detail = $this->M_penjualan_obat->input_data('detail_penjualan_obat_apotik', $data);

                        // update stok di penyimpanan
                        if ($status_detail) {

                        $where = array(
                            'no_stok_obat_a' => $no_stok_obat_a
                        );

                        $data = array(
                            'qty' => $qty_sekarang - $qty
                        );
                        
                        $status_update = $this->M_penjualan_obat->update_data($where, 'stok_obat_apotik', $data);

                        }
                    }

                }
        }

        if (isset($_POST['no_bp_t'])) {

            date_default_timezone_set('Asia/Jakarta');

            // data transaksi 
            $no_bp_p = $this->M_transaksi->get_no_transaksi(); // generate
            $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
            $tgl_penanganan = date('Y-m-d H:i:s');
            $total_tmp = $this->input->post('total_harga_bp');
            $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

            $data = array(
                'no_bp_p' => $no_bp_p,
                'no_ref_pelayanan' => $no_ref_pelayanan,
                'tgl_penanganan' => $tgl_penanganan,
                'total_harga' => $total_harga
            );

            $status = $this->M_transaksi->input_data('bp_penanganan', $data);
            // end of data transaksi 

            if ($status) {
                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];
                    $harga_temp = $this->input->post('harga')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
                        'harga' => $harga
                    );

                    $status = $this->M_transaksi->input_data('detail_bp_penanganan', $data);
                }

            } 
        }
        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('balai_pengobatan/transaksi');
        
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_transaksi->get_select($no_ref,$nama,'no_ref_pelayanan');
        echo json_encode($query);
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('data_stok_obat_apotek')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }
    public function ambil_total_obat()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_stok_obat_a']) && isset($_POST['harga_obat']) && isset($_POST['qty'])) {

        for ($i = 0; $i < count($this->input->post('no_stok_obat_a')); $i++) {

            $harga_jual_temp = $this->input->post('harga_obat')[$i];
            $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

            $qty_temp = $this->input->post('qty')[$i];
            $qty = (int) preg_replace("/[^0-9]/", "", $qty_temp);

            $perhitungan = $harga_jual * $qty;

            $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
            }

            echo $total;
    }
}
