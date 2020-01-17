<?php
class Tagihan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ambulance/M_ambulance');
        $this->load->model('administrasi/M_tagihan');
        // date_default_timezone_set('Asia/Jakarta');
    }

    public function index()
    {
        $this->template->load('sim_klinik/template/administrasi', 'sim_klinik/konten/administrasi/tagihan/tambah');
    }

    public function get_transaksi_pasien()
    {
        $nilai = $this->input->post('nilai');

        $where = array(
            'no_ref_pelayanan' => $nilai
        );

        $data_tbl['daftar_penjualan_obat_apotek_detail'] =  $this->M_tagihan->get_data('daftar_penjualan_obat_apotek_detail', $where)->result();
        $data_tbl['daftar_penjualan_obat_rawat_inap_detail'] =  $this->M_tagihan->get_data('daftar_penjualan_obat_rawat_inap_detail', $where)->result();
        $data_tbl['daftar_detail_tindakan_rawat_inap'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_rawat_inap', $where)->result();
        $data_tbl['daftar_detail_kamar_rawat_inap'] =  $this->M_tagihan->get_data('daftar_detail_kamar_rawat_inap', $where)->result();
        $data_tbl['daftar_detail_tindakan_lab'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_lab', $where)->result();
        $data_tbl['daftar_detail_tindakan_bp'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_bp', $where)->result();
        $data_tbl['daftar_detail_tindakan_ugd'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_ugd', $where)->result();
        $data_tbl['daftar_detail_tindakan_kia'] =  $this->M_tagihan->get_data('daftar_detail_tindakan_kia', $where)->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_tagihan->get_select($no_ref, $nama, 'no_ref_pelayanan');
        echo json_encode($query);
    }

    public function tampil_ambulance()
    {
        $data_tbl['tbl_data'] = $this->M_tagihan->tampil_data('ambulance')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total_ambulance()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_ambulance']) && isset($_POST['harga_ambulance'])) {

            for ($i = 0; $i < count($this->input->post('no_ambulance')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ambulance')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_apotek_obat()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['kode_obat']) && isset($_POST['harga_apotek_obat']) && isset($_POST['qty_apotek_obat'])) {

            for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                $harga_jual_temp = $this->input->post('harga_apotek_obat')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_apotek_obat')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_bp_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_kia_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kia_t']) && isset($_POST['harga_kia_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_kia_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_lab_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ugd_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $perhitungan = $harga_jual;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ri_kamar()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_ri_kamar']) && isset($_POST['jumlah_hari_ri_kamar'])) {

            for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                $harga_jual_temp = $this->input->post('harga_harian_ri_kamar')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                if ($this->input->post('status_kamar_ri_kamar')[$i] == "Belum Cek Out") {
                    $harga_jual = 0;
                }

                $jumlah_hari_temp = $this->input->post('jumlah_hari_ri_kamar')[$i];
                $jumlah_hari = (int) $jumlah_hari_temp;

                $perhitungan = $harga_jual * $jumlah_hari;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ri_obat()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_ri_obat']) && isset($_POST['qty_ri_obat'])) {

            for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp = $this->input->post('qty_ri_obat')[$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }

        echo $total;
    }

    public function ambil_total_ri_tindakan()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_ri_tindakan'])) {

            for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
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
    }
}
