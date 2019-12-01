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
        $data['record'] = $this->M_penjualan_obat->tampil_data('supplier')->result();
        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/penjualan_obat/tambah', $data);
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_penjualan_obat->tampil_data('data_obat')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['kode_obat']) && isset($_POST['harga_supplier']) && isset($_POST['qty_awal'])) {

            for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                $harga_supplier_temp = $this->input->post('harga_supplier')[$i];
                $harga_supplier = (int) preg_replace("/[^0-9]/", "", $harga_supplier_temp);

                $qty_awal_temp = $this->input->post('qty_awal')[$i];
                $qty_awal = (int) preg_replace("/[^0-9]/", "", $qty_awal_temp);

                $perhitungan = $harga_supplier * $qty_awal;

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
        if (isset($_POST['kode_obat'])) {

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
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];
                    $harga_temp = $this->input->post('harga_supplier')[$i];
                    $harga_supplier = preg_replace("/[^0-9]/", "", $harga_temp);
                    $qty_awal = $this->input->post('qty_awal')[$i];

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_penerimaan_o' => $no_penerimaan_o,
                        'kode_obat' => $kode_obat,
                        'harga_supplier' => $harga_supplier,
                        'qty_awal' => $qty_awal,
                        'qty_sekarang' => $qty_awal
                    );

                    $status = $this->M_penjualan_obat->input_data('stok_obat_apotik', $data);
                }

                if ($status) {
                    echo "Berhasil Menyimpan Data !!";
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
