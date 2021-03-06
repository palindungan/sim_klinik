<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('administrasi/M_transaksi');
    }

    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_data('data_pelayanan_pasien')->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/administrasi/transaksi/tambah', $data);
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
        date_default_timezone_set('Asia/Jakarta');
        $no_transaksi_rawat_i = $this->M_transaksi->get_no_transaksi_rawat_inap(); // generate
        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
        $atas_nama = "kkk"; // datadumb
        $tgl_transaksi = date('Y-m-d H:i:s');
        $total_temp = $this->input->post('total_harga');
        $total_harga = preg_replace("/[^0-9]/", "", $total_temp);

        $data = array(
            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
            'no_ref_pelayanan' => $no_ref_pelayanan,
            'atas_nama' => $atas_nama,
            'tgl_transaksi' => $tgl_transaksi,
            'total_harga' => $total_harga
        );

        $status = $this->M_transaksi->input_data('transaksi_rawat_inap', $data);

        if ($status) {

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

                    $status = $this->M_transaksi->input_data('detail_transaksi_rawat_inap_kamar', $data);
                }

                if ($status) {
                    $this->session->set_flashdata('success', 'Ditambahkan');
                } else {
                    echo "Gagal input ke dalam data detail transaksi !!";
                }
            } else {
                echo "Harus Ada Detail Transaksi !!";
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

                    $status = $this->M_transaksi->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                }

                if ($status) {
                    $this->session->set_flashdata('success', 'Ditambahkan');
                } else {
                    echo "Gagal input ke dalam data detail transaksi !!";
                }
            } else {
                echo "Harus Ada Detail Transaksi !!";
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

                    $status = $this->M_transaksi->input_data('detail_transaksi_rawat_inap_obat', $data);
                }

                if ($status) {
                    $this->session->set_flashdata('success', 'Ditambahkan');
                } else {
                    echo "Gagal input ke dalam data detail transaksi !!";
                }
            } else {
                echo "Harus Ada Detail Transaksi !!";
            }
            // start of Obat //////////

        } else {
            echo "Gagal input ke dalam data transaksi !!";
        }
    }
}
