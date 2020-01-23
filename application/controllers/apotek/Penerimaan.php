<?php
class Penerimaan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apotek/M_penerimaan');

    }
    public function index()
    {
        $data['record'] = $this->M_penerimaan->tampil_data('supplier')->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/penerimaan/tambah', $data);
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_penerimaan->tampil_data('data_obat')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['kode_obat']) && isset($_POST['harga_supplier']) && isset($_POST['qty'])) {

            for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                $harga_supplier_temp = $this->input->post('harga_supplier')[$i];
                $harga_supplier = (int) preg_replace("/[^0-9]/", "", $harga_supplier_temp);

                $qty_temp = $this->input->post('qty')[$i];
                $qty = (int) preg_replace("/[^0-9]/", "", $qty_temp);

                $perhitungan = $harga_supplier * $qty;

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


            // data transaksi 
            $no_penerimaan_o = $this->M_penerimaan->get_no_transaksi(); // generate
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

            $status = $this->M_penerimaan->input_data('penerimaan_obat', $data);
            // end of data transaksi 

            if ($status) {
                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];
                    $harga_temp = $this->input->post('harga_supplier')[$i];
                    $harga_supplier = preg_replace("/[^0-9]/", "", $harga_temp);
                    $qty = $this->input->post('qty')[$i];

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_penerimaan_o' => $no_penerimaan_o,
                        'kode_obat' => $kode_obat,
                        'harga_supplier' => $harga_supplier,
                        'qty' => $qty
                    );

                    $where_ko = array(
                        'kode_obat' => $kode_obat
                    );
                    $ambil_obat = $this->M_penerimaan->get_data('obat', $where_ko)->result();
                    $qty_obat = 0;

                    foreach ($ambil_obat as $obat) {
                        $qty_obat = $obat->qty;
                    }

                    $data_obat = array(
                        'qty' => $qty_obat + $qty
                    );

                    $this->M_penerimaan->update_data($where_ko, 'obat', $data_obat);
                    $status = $this->M_penerimaan->input_data('stok_obat_apotik', $data);
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

    public function tampil_daftar_penerimaan_obat()
    {
        $data['record'] = $this->M_penerimaan->tampil_data('daftar_penerimaan_obat_apotek')->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/penerimaan/tampil', $data);
    }

    public function tampil_detail_daftar_penerimaan_obat()
    {
        $no_penerimaan_o = $this->input->get('no_penerimaan_o');

        $where = array(
            'no_penerimaan_o' => $no_penerimaan_o
        );

        $data['record'] = $this->M_penerimaan->get_data('daftar_penerimaan_obat_apotek', $where)->result();

        $data['detail_record'] = $this->M_penerimaan->get_data('daftar_penerimaan_obat_apotek_detail', $where)->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/penerimaan/detail', $data);
    }
}
