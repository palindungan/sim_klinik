<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('balai_pengobatan/M_transaksi');
        $this->load->model('administrasi/M_tagihan');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/balai_pengobatan', 'sim_klinik/konten/balai_pengobatan/transaksi/tambah');
    }

    function tampil_select()
    {
        $no_ref = $this->input->get('no_ref');
        $nama = $this->input->get('nama');
        $query = $this->M_transaksi->get_select($no_ref, $nama, 'no_ref_pelayanan');
        echo json_encode($query);
    }

    public function tampil_daftar_tindakan()
    {
        $data_tbl['tbl_data'] = $this->M_transaksi->tampil_data('bp_tindakan')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function input_transaksi_form()
    {

        $no_ref_pelayanan = $this->input->post('no_ref_pelayanan');

        $where_no_ref_pelayanan = array(
            'no_ref_pelayanan' => $no_ref_pelayanan
        );

        // cek apakah ada no ref pelayanan didalam semua tabel transaksi
        $cek_bp_penanganan = $this->M_tagihan->get_data('bp_penanganan', $where_no_ref_pelayanan);

        // Start of cek di setiap transaksi //// untuk bp_penanganan
        if ($cek_bp_penanganan->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_bp_p = "kosong";
            foreach ($cek_bp_penanganan->result() as $data) {
                $no_bp_p = $data->no_bp_p;
            }

            $where_no_bp_p = array(
                'no_bp_p' => $no_bp_p
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_bp_p, 'detail_bp_penanganan');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ? no_bp_t harga_bp_tindakan
            if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan']) && isset($_POST['qty_bp_tindakan'])) {

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_bp_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_bp_penanganan', $data);
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_bp_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );
                $update = $this->M_tagihan->update_data($where_no_bp_p, 'bp_penanganan', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_bp_p, 'bp_penanganan');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ? no_bp_t harga_bp_tindakan
            if (isset($_POST['no_bp_t']) && isset($_POST['harga_bp_tindakan']) && isset($_POST['qty_bp_tindakan'])) {

                // menambah transaksi utama
                $no_bp_p = $this->M_tagihan->get_no_bp_p(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');
                $total_tmp = $this->input->post('sub_total_bp_tindakan');
                $total_harga = preg_replace("/[^0-9]/", "", $total_tmp);

                $data = array(
                    'no_bp_p' => $no_bp_p,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_penanganan' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $tambah = $this->M_tagihan->input_data('bp_penanganan', $data);

                // menambah detail transaksi baru 
                for ($i = 0; $i < count($this->input->post('no_bp_t')); $i++) {

                    $no_bp_t = $this->input->post('no_bp_t')[$i];

                    $harga_jual_temp = $this->input->post('harga_bp_tindakan')[$i];
                    $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                    $qty_temp = $this->input->post('qty_bp_tindakan')[$i];
                    $qty = (int) $qty_temp;

                    $data = array(
                        'no_bp_p' => $no_bp_p,
                        'no_bp_t' => $no_bp_t,
                        'qty' => $qty,
                        'harga' => $harga_jual
                    );

                    $tambah = $this->M_tagihan->input_data('detail_bp_penanganan', $data);
                }
            }
        }
        // End Of cek di setiap transaksi

        $this->session->set_flashdata('success', 'Ditambahkan');
    }
}
