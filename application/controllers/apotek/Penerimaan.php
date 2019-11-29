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
        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/penerimaan/tambah', $data);
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
}
