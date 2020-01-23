<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('laboratorium/M_transaksi');
        $this->load->model('administrasi/M_tagihan');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/laboratorium/transaksi/tambah');
    }

    public function tampil_daftar_checkup()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('lab_checkup')->result();

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
        $cek_lab_transaksi = $this->M_tagihan->get_data('lab_transaksi', $where_no_ref_pelayanan);

        // Start of cek di setiap transaksi //// untuk lab_transaksi
        if ($cek_lab_transaksi->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_lab_t = "kosong";
            foreach ($cek_lab_transaksi->result() as $data) {
                $no_lab_t = $data->no_lab_t;
            }

            $where_no_lab_t = array(
                'no_lab_t' => $no_lab_t
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_lab_t, 'detail_lab_transaksi');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_lab_c harga_lab_tindakan
            if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan']) && isset($_POST['qty_lab_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                    $no_lab_c = $this->input->post('no_lab_c')[$i];

                    $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_lab_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_lab_transaksi', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_lab_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_lab_t, 'lab_transaksi', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_lab_t, 'lab_transaksi');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_lab_c harga_lab_tindakan
            if (isset($_POST['no_lab_c']) && isset($_POST['harga_lab_tindakan']) && isset($_POST['qty_lab_tindakan'])) {

                // menambah transaksi utama
                $no_lab_t = $this->M_tagihan->get_no_lab_t(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_lab_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_lab_t' => $no_lab_t,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('lab_transaksi', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_lab_c')); $i++) {

                    $no_lab_c = $this->input->post('no_lab_c')[$i];

                    $harga_jual_temp = $this->input->post('harga_lab_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_lab_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_lab_t' => $no_lab_t,
                        'no_lab_c' => $no_lab_c,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_lab_transaksi', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        $this->session->set_flashdata('success', 'Ditambahkan');
    }
}
