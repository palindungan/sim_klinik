<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('ugd/M_transaksi');
        $this->load->model('administrasi/M_tagihan');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/ugd/transaksi/tambah');
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('ugd_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_transaksi->get_select($no_ref, $nama, 'no_ref_pelayanan');
        echo json_encode($query);
    }

    public function input_transaksi_form()
    {

        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');

        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );

        // cek apakah ada no ref pelayanan didalam semua tabel transaksi
        $cek_ugd_penanganan = $this->M_tagihan->get_data('ugd_penanganan', $where_no_ref_pelayanan);

        // Start of cek di setiap transaksi //// untuk ugd_penanganan
        if ($cek_ugd_penanganan->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_ugd_p = "kosong";
            foreach ($cek_ugd_penanganan->result() as $data) {
                $no_ugd_p = $data->no_ugd_p;
            }

            $where_no_ugd_p = array(
                'no_ugd_p' => $no_ugd_p
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_ugd_p, 'detail_ugd_penanganan');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_ugd_t harga_ugd_tindakan
            if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan']) && isset($_POST['qty_ugd_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_ugd_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_ugd_penanganan', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_ugd_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_ugd_p, 'ugd_penanganan', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_ugd_p, 'ugd_penanganan');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_ugd_t harga_ugd_tindakan
            if (isset($_POST['no_ugd_t']) && isset($_POST['harga_ugd_tindakan']) && isset($_POST['qty_ugd_tindakan'])) {

                // menambah transaksi utama
                $no_ugd_p = $this->M_tagihan->get_no_ugd_p(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_ugd_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_ugd_p' => $no_ugd_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('ugd_penanganan', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_ugd_t')); $i++) {

                    $no_ugd_t = $this->input->post('no_ugd_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_ugd_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_ugd_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_ugd_p' => $no_ugd_p,
                        'no_ugd_t' => $no_ugd_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_ugd_penanganan', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        $this->session->set_flashdata('success', 'Ditambahkan');
    }
}
