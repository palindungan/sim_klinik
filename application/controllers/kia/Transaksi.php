<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('kia/M_transaksi');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/kia', 'sim_klinik/konten/kia/transaksi/tambah');
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('kia_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_kia_t']) && isset($_POST['harga'])) {

            for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

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
        if (isset($_POST['no_kia_t'])) {

            date_default_timezone_set('Asia/Jakarta');

            // data transaksi 
            $no_kia_p = $this->M_transaksi->get_no_transaksi(); // generate
            $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
            $tgl_penanganan = date('Y-m-d H:i:s');
            $total_tmp = $this->input->post('total_harga');
            $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

            $data = array(
                'no_kia_p' => $no_kia_p,
                'no_ref_pelayanan' => $no_ref_pelayanan,
                'tgl_penanganan' => $tgl_penanganan,
                'total_harga' => $total_harga
            );

            $status = $this->M_transaksi->input_data('kia_penanganan', $data);
            // end of data transaksi 

            if ($status) {
                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_kia_t')); $i++) {

                    $no_kia_t = $this->input->post('no_kia_t')[$i];
                    $harga_temp = $this->input->post('harga')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_kia_p' => $no_kia_p,
                        'no_kia_t' => $no_kia_t,
                        'harga' => $harga
                    );

                    $status = $this->M_transaksi->input_data('detail_kia_penanganan', $data);
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
    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_transaksi->get_select($no_ref,$nama,'no_ref_pelayanan');
        echo json_encode($query);
    }

}
