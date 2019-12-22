<?php
class Penjualan_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apotek/M_penjualan_obat');
    }
    public function index()
    {
        $where = array(
            'status' => 'belum_finish'
        );

        $data['record'] = $this->M_penjualan_obat->get_data('data_pelayanan_pasien', $where)->result();
        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/penjualan_obat/tambah', $data);
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_penjualan_obat->tampil_data('data_stok_obat_apotek')->result();

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

    public function input_penerimaan_form()
    {
        $no_supplier = $this->input->post('no_supplier');
        $total_tmp = $this->input->post('total_harga');
        if (isset($_POST['no_stok_obat_a'])) {

            date_default_timezone_set('Asia/Jakarta');

            // data transaksi 
            $no_penerimaan_o = $this->M_penjualan_obat->get_no_transaksi(); // generate
            $no_supplier = $this->input->post('no_supplier');
            $tgl_penerimaan_o = date('Y-m-d H:i:s');
            $total_tmp = $this->input->post('total_harga');
            $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

            $data = array(
                'no_penerimaan_o' => $no_penerimaan_o,
                'no_supplier' => $no_supplier,
                'tgl_penerimaan_o' => $tgl_penerimaan_o,
                'total_harga' => $total_harga
            );

            $status = $this->M_penjualan_obat->input_data('penerimaan_obat', $data);
            // end of data transaksi 

            if ($status) {
                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_stok_obat_a')); $i++) {

                    $no_stok_obat_a = $this->input->post('no_stok_obat_a')[$i];
                    $harga_temp = $this->input->post('harga_jual')[$i];
                    $harga_jual = preg_replace("/[^0-9]/", "", $harga_temp);
                    $qty = $this->input->post('qty')[$i];

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_penerimaan_o' => $no_penerimaan_o,
                        'no_stok_obat_a' => $no_stok_obat_a,
                        'harga_jual' => $harga_jual,
                        'qty' => $qty,
                        'qty_sekarang' => $qty
                    );

                    $status = $this->M_penjualan_obat->input_data('stok_obat_apotik', $data);
                }

                if ($status) {
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
}
