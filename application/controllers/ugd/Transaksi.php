<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ugd/M_transaksi');
    }
    public function index()
    {
        $where = array(
            'layanan_tujuan' => 'UGD'
        );

        $data['record'] = $this->M_transaksi->get_data('data_pelayanan_pasien', $where)->result();
        $this->template->load('sim_klinik/template/ugd', 'sim_klinik/konten/ugd/transaksi/tambah', $data);
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('ugd_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function ambil_total()
    {
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['no_ugd_t']) && isset($_POST['harga'])) {

            for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

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
        if (isset($_POST['no_ugd_t'])) {

            date_default_timezone_set('Asia/Jakarta');

            // data transaksi 
            $no_ugd_p = $this->M_transaksi->get_no_transaksi(); // generate
            $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');
            $tgl_penanganan = date('Y-m-d H:i:s');
            $total_tmp = $this->input->post('total_harga');
            $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

            $data = array(
                'no_ugd_p' => $no_ugd_p,
                'no_ref_pelayanan' => $no_ref_pelayanan,
                'tgl_penanganan' => $tgl_penanganan,
                'total_harga' => $total_harga
            );

            $status = $this->M_transaksi->input_data('ugd_penanganan', $data);
            // end of data transaksi 

            if ($status) {
                // tambah detail transaksi
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];
                    $harga_temp = $this->input->post('harga')[$i];
                    $harga = preg_replace("/[^0-9]/", "", $harga_temp);

                    // proses pemasukan ke dalam database detail
                    $data = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
                        'harga' => $harga
                    );

                    $status = $this->M_transaksi->input_data('detail_ugd_penanganan', $data);
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

    function get_pasien_by_no_ref_pelayanan()
    {
        $nilai = $this->input->post('nilai');
        if (isset($nilai)) {

            $where = array(
                'no_ref_pelayanan' => $nilai
            );

            $data_tbl['tbl_data'] = $this->M_transaksi->get_data('data_pelayanan_pasien', $where)->result();
            $data = json_encode($data_tbl);
            echo $data;
        }
    }
    function tampil_select()
    {
        $kec = $this->input->get('kec');
        $query = $this->M_transaksi->get_select($kec,'no_ref_pelayanan');
        echo json_encode($query);
    }
}
