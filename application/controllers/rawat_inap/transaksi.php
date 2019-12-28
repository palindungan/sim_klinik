<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('rawat_inap/M_transaksi');
    }

    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_data('data_pelayanan_pasien')->result();
        $this->template->load('sim_klinik/template/rawat_inap', 'sim_klinik/konten/rawat_inap/transaksi/tambah', $data);
    }

    public function tampil_daftar_kamar()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('kamar_rawat_inap')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('rawat_inap_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_obat()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('daftar_pengiriman_obat_apotek_detail')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_sub_total_kamar()
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

    public function ambil_sub_total_tindakan()
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

    public function ambil_sub_total_obat()
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

    public function input_transaksi_form()
    {
        // start of 
        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
        $total_tmp = $this->input->post('total_harga');
        if (isset($_POST['no_bp_t'])) {

            date_default_timezone_set('Asia/Jakarta');

            // data transaksi 
            $no_bp_p = $this->M_transaksi->get_no_transaksi(); // generate
            $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
            $tgl_penanganan = date('Y-m-d H:i:s');
            $total_tmp = $this->input->post('total_harga');
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
