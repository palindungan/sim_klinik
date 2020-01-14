<?php
class Penjualan_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apotek/M_penjualan_obat');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/penjualan_obat/tambah');
    }

    public function tampil_daftar_obat()
    {
        $where_qyty = array(
            'qty >' => 0
        );
        $data_tbl['tbl_data'] = $this->M_penjualan_obat->get_data('data_stok_obat_apotek',$where_qyty)->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_stok_obat_a']) && isset($_POST['harga_jual']) && isset($_POST['qty'])) {

            for ($i = 0; $i < count($this->input->post('no_stok_obat_a')); $i++) {

                $harga_jual_temp = $this->input->post('harga_jual')[$i];
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

    public function input_transaksi_form()
    {
        if (isset($_POST['no_stok_obat_a'])) {

            // data transaksi 
            $no_penjualan_obat_a = $this->M_penjualan_obat->get_no_transaksi(); // generate
            $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
            $tanggal_penjualan = date('Y-m-d H:i:s');

            $total_tmp = $this->input->post('total_harga');
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
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];
                    $harga_temp = $this->input->post('harga_jual')[$i];
                    $harga_jual = preg_replace("/[^0-9]/", "", $harga_temp);
                    $qty = $this->input->post('qty')[$i];
                    $qty_sekarang = $this->input->post('qty_sekarang')[$i];

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_penjualan_obat_a' => $no_penjualan_obat_a,
                        'kode_obat' => $kode_obat,
                        'qty' => $qty,
                        'harga_jual' => $harga_jual,
                        'status_paket' => 'Tidak'
                    );

                    $status_detail = $this->M_penjualan_obat->input_data('detail_penjualan_obat_apotik', $data);

                    // update stok di penyimpanan
                    if ($status_detail) {

                        $where = array(
                            'kode_obat' => $kode_obat
                        );

                        $data = array(
                            'qty' => $qty_sekarang -  $qty
                        );
                        $status_update = $this->M_penjualan_obat->update_data($where, 'obat', $data);

                    }
                }

                if ($status_update) {
                    $this->session->set_flashdata('success', 'Ditambahkan');
                } else {
                    echo "Gagal input ke dalam data detail transaksi !!";
                }
            } else {
                echo "Gagal input ke dalam data transaksi !!";
            }
        } else {
            echo "Harus Ada Detail Transaksi !!";
        }
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_penjualan_obat->get_select($no_ref,$nama,'no_ref_pelayanan');
        echo json_encode($query);
    }

    public function tampil_daftar_penjualan_obat()
    {
        $data['record'] = $this->M_penjualan_obat->tampil_data('daftar_penjualan_obat_apotek')->result();

        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/history/penjualan/tampil', $data);
    }

    public function tampil_detail_daftar_penjualan_obat()
    {
        $no_penjualan_obat_a = $this->input->get('no_penjualan_obat_a');

        $where = array(
            'no_penjualan_obat_a' => $no_penjualan_obat_a
        );

        $data['record'] = $this->M_penjualan_obat->get_data('daftar_penjualan_obat_apotek', $where)->result();

        $data['detail_record'] = $this->M_penjualan_obat->get_data('daftar_penjualan_obat_apotek_detail', $where)->result();

        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/history/penjualan/detail', $data);
    }
}
