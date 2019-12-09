<?php
class Pengiriman_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apotek/M_pengiriman_obat');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/pengiriman_obat/tambah');
    }
    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_pengiriman_obat->tampil_data('data_stok_obat_apotek')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function input_pengiriman_obat()
    {
        $tujuan = $this->input->post('tujuan');
        if(isset($_POST['kode_obat']))
        {
            date_default_timezone_set('Asia/Jakarta');
            $no_obat_keluar_i = $this->M_pengiriman_obat->get_no_transaksi(); // generate
            $tgl_obat_keluar_i = date('Y-m-d H:i:s');
            $obat_keluar_internal = array(
                'no_obat_keluar_i' => $no_obat_keluar_i,
                'tujuan' => $tujuan,
                'tgl_obat_keluar_i' => $tgl_obat_keluar_i
            );
            $status = $this->M_pengiriman_obat->input_data('obat_keluar_internal', $obat_keluar_internal);
            if($status)
            {
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $no_stok_obat_a = $this->input->post('kode_obat')[$i];
                    $harga_temp = $this->input->post('harga_supplier')[$i];
                    $qty = $this->input->post('qty')[$i];

                    // proses pemasukan ke dalam database detail
                    $data = array(
                    'no_obat_keluar_i' => $no_obat_keluar_i,
                    'no_stok_obat_a' => $no_stok_obat_a,
                    'qty_awal' => $qty,
                    'qty_sekarang' => $qty
                    );

                    $status = $this->M_pengiriman_obat->input_data('stok_obat_rawat_inap', $data);
                }
                if ($status) {
                echo "Berhasil Menyimpan Data !!";
                } else {
                echo "Gagal input ke dalam data detail transaksi !!";
                }
            } else {
            echo "Gagal input ke dalam data transaksi !!";
            }
            
        }
        else {
            echo "Harus Ada Detail Transaksi !!";
        }
    }
}
