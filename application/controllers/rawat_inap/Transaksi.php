<?php
class Transaksi extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if($this->session->userdata('akses') == ""){
            redirect('login');
        }else if($this->session->userdata('akses') != 'Rawat Inap'){
            show_404();
        }
        $this->load->model('rawat_inap/M_transaksi');
        $this->load->model('administrasi/M_tagihan');
    }

    public function index()
    {
        $data['record'] = $this->M_transaksi->tampil_data('data_pelayanan_pasien_default')->result();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/rawat_inap/transaksi/tambah', $data);
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
        $where_qty_obat = array(
            'qty >' => 0
        );
        $data_tbl['tbl_data'] = $this->M_transaksi->get_data('daftar_obat_rawat_inap', $where_qty_obat)->result();

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
        $cek_transaksi_rawat_inap = $this->M_tagihan->get_data('transaksi_rawat_inap', $where_no_ref_pelayanan);

        // Start of cek di setiap transaksi //// untuk transaksi_rawat_inap
        if ($cek_transaksi_rawat_inap->num_rows() > 0) {

            // Start of hapus semua detail transaksi lama
            // ambil kode transaksi
            $no_transaksi_rawat_i = "kosong";
            foreach ($cek_transaksi_rawat_inap->result() as $data) {
                $no_transaksi_rawat_i = $data->no_transaksi_rawat_i;
            }

            $where_no_transaksi_rawat_i = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );

            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_obat');
            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_tindakan');
            $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'detail_transaksi_rawat_inap_kamar');
            // End of hapus semua detail transaksi lama

            // Start of Cek apakah ada data detail post masuk ?
            if (isset($_POST['no_stok_obat_rawat_i']) || isset($_POST['no_rawat_inap_t']) || isset($_POST['no_kamar_rawat_i'])) {

                // no_stok_obat_rawat_i harga_ri_obat qty_ri_obat
                if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_ri_obat']) && isset($_POST['qty_ri_obat'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                        $no_stok_obat_rawat_i = $this->input->post('no_stok_obat_rawat_i')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_obat')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i,
                            'qty' => $qty,
                            'harga_jual' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_obat', $data);

                        // update qty obat lama dibawah ini
                        $where_no_stok_obat_rawat_i = array(
                            'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i
                        );

                        $ambil_data = $this->M_tagihan->get_data('stok_obat_rawat_inap', $where_no_stok_obat_rawat_i);
                        $qty_lama = "kosong";
                        foreach ($ambil_data->result() as $data) {
                            $qty_lama = $data->qty;
                        }

                        $data = array(
                            'qty' => $qty_lama - $qty
                        );
                        $update = $this->M_tagihan->update_data($where_no_stok_obat_rawat_i, 'stok_obat_rawat_inap', $data);
                    }
                }

                // no_rawat_inap_t harga_ri_tindakan
                if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_ri_tindakan']) && isset($_POST['qty_ri_tindakan'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                        $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_tindakan')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_rawat_inap_t' => $no_rawat_inap_t,
                            'qty' => $qty,
                            'harga' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                    }
                }

                // no_kamar_rawat_i tanggal_cek_in_ri_kamar tanggal_cek_out_ri_kamar jumlah_hari_ri_kamar harga_harian_ri_kamar status_kamar_ri_kamar
                if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_ri_kamar']) && isset($_POST['jumlah_hari_ri_kamar'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                        $no_kamar_rawat_i = $this->input->post('no_kamar_rawat_i')[$i];

                        $tanggal_cek_in_ri_kamar = $this->input->post('tanggal_cek_in_ri_kamar')[$i];
                        $tanggal_cek_out_ri_kamar = $this->input->post('tanggal_cek_out_ri_kamar')[$i];

                        $jumlah_hari_temp = $this->input->post('jumlah_hari_ri_kamar')[$i];
                        $jumlah_hari = (int) $jumlah_hari_temp;

                        $harga_harian_temp = $this->input->post('harga_harian_ri_kamar')[$i];
                        $harga_harian = (int) preg_replace("/[^0-9]/", "", $harga_harian_temp);

                        $status_kamar_ri_kamar = $this->input->post('status_kamar_ri_kamar')[$i];

                        $sub_total_harga = 0;
                        if ($status_kamar_ri_kamar == "Sudah Cek Out") {
                            $sub_total_harga = $jumlah_hari * $harga_harian;
                        }

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_kamar_rawat_i' => $no_kamar_rawat_i,
                            'tanggal_cek_in' => $tanggal_cek_in_ri_kamar,
                            'tanggal_cek_out' => $tanggal_cek_out_ri_kamar,
                            'jumlah_hari' => $jumlah_hari,
                            'harga_harian' => $harga_harian,
                            'sub_total_harga' => $sub_total_harga,
                            'status_kamar' => $status_kamar_ri_kamar
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_kamar', $data);
                    }
                }

                // update transaksi lama
                $tgl_transaksi = date('Y-m-d H:i:s');

                $sub_total_ri_obat = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_obat'));
                $sub_total_ri_tindakan = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_tindakan'));
                $sub_total_ri_kamar = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_kamar'));

                $total_harga = (int) $sub_total_ri_obat + (int) $sub_total_ri_tindakan + (int) $sub_total_ri_kamar;

                $data = array(
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $update = $this->M_tagihan->update_data($where_no_transaksi_rawat_i, 'transaksi_rawat_inap', $data);
            } else {

                // Hapus transaksi Utama
                $hapus = $this->M_tagihan->hapus_data($where_no_transaksi_rawat_i, 'transaksi_rawat_inap');
            }
            // End of Cek apakah ada data detail post masuk ?

        } else {

            // Start of Cek apakah ada data detail post masuk ?
            if (isset($_POST['no_stok_obat_rawat_i']) || isset($_POST['no_rawat_inap_t']) || isset($_POST['no_kamar_rawat_i'])) {

                // menambah transaksi utama
                $no_transaksi_rawat_i = $this->M_tagihan->get_no_transaksi_rawat_i(); // generate
                $tgl_transaksi = date('Y-m-d H:i:s');

                $sub_total_ri_obat = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_obat'));
                $sub_total_ri_tindakan = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_tindakan'));
                $sub_total_ri_kamar = preg_replace("/[^0-9]/", "", $this->input->post('sub_total_ri_kamar'));

                $total_harga = (int) $sub_total_ri_obat + (int) $sub_total_ri_tindakan + (int) $sub_total_ri_kamar;

                $data = array(
                    'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                    'no_ref_pelayanan' => $no_ref_pelayanan,
                    'tgl_transaksi' => $tgl_transaksi,
                    'total_harga' => $total_harga
                );

                $data_update_status_pelayanan = array(
                    'tipe_pelayanan' => 'Rawat Inap'
                );
                $this->M_tagihan->update_data($where_no_ref_pelayanan,'pelayanan',$data_update_status_pelayanan);

                $tambah = $this->M_tagihan->input_data('transaksi_rawat_inap', $data);

                // no_stok_obat_rawat_i harga_ri_obat qty_ri_obat
                if (isset($_POST['no_stok_obat_rawat_i']) && isset($_POST['harga_ri_obat']) && isset($_POST['qty_ri_obat'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_stok_obat_rawat_i')); $i++) {

                        $no_stok_obat_rawat_i = $this->input->post('no_stok_obat_rawat_i')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_obat')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_obat')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i,
                            'qty' => $qty,
                            'harga_jual' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_obat', $data);

                        // update qty obat lama dibawah ini
                        $where_no_stok_obat_rawat_i = array(
                            'no_stok_obat_rawat_i' => $no_stok_obat_rawat_i
                        );

                        $ambil_data = $this->M_tagihan->get_data('stok_obat_rawat_inap', $where_no_stok_obat_rawat_i);
                        $qty_lama = "kosong";
                        foreach ($ambil_data->result() as $data) {
                            $qty_lama = $data->qty;
                        }

                        $data = array(
                            'qty' => $qty_lama - $qty
                        );
                        $update = $this->M_tagihan->update_data($where_no_stok_obat_rawat_i, 'stok_obat_rawat_inap', $data);
                    }
                }

                // no_rawat_inap_t harga_ri_tindakan
                if (isset($_POST['no_rawat_inap_t']) && isset($_POST['harga_ri_tindakan']) && isset($_POST['qty_ri_tindakan'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_rawat_inap_t')); $i++) {

                        $no_rawat_inap_t = $this->input->post('no_rawat_inap_t')[$i];

                        $harga_jual_temp = $this->input->post('harga_ri_tindakan')[$i];
                        $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                        $qty_temp = $this->input->post('qty_ri_tindakan')[$i];
                        $qty = (int) $qty_temp;

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_rawat_inap_t' => $no_rawat_inap_t,
                            'qty' => $qty,
                            'harga' => $harga_jual
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_tindakan', $data);
                    }
                }

                // no_kamar_rawat_i tanggal_cek_in_ri_kamar tanggal_cek_out_ri_kamar jumlah_hari_ri_kamar harga_harian_ri_kamar status_kamar_ri_kamar
                if (isset($_POST['no_kamar_rawat_i']) && isset($_POST['harga_harian_ri_kamar']) && isset($_POST['jumlah_hari_ri_kamar'])) {

                    // menambah detail transaksi baru 
                    for ($i = 0; $i < count($this->input->post('no_kamar_rawat_i')); $i++) {

                        $no_kamar_rawat_i = $this->input->post('no_kamar_rawat_i')[$i];

                        $tanggal_cek_in_ri_kamar = $this->input->post('tanggal_cek_in_ri_kamar')[$i];
                        $tanggal_cek_out_ri_kamar = $this->input->post('tanggal_cek_out_ri_kamar')[$i];

                        $jumlah_hari_temp = $this->input->post('jumlah_hari_ri_kamar')[$i];
                        $jumlah_hari = (int) $jumlah_hari_temp;

                        $harga_harian_temp = $this->input->post('harga_harian_ri_kamar')[$i];
                        $harga_harian = (int) preg_replace("/[^0-9]/", "", $harga_harian_temp);

                        $status_kamar_ri_kamar = $this->input->post('status_kamar_ri_kamar')[$i];

                        $sub_total_harga = 0;
                        if ($status_kamar_ri_kamar == "Sudah Cek Out") {
                            $sub_total_harga = $jumlah_hari * $harga_harian;
                        }

                        $data = array(
                            'no_transaksi_rawat_i' => $no_transaksi_rawat_i,
                            'no_kamar_rawat_i' => $no_kamar_rawat_i,
                            'tanggal_cek_in' => $tanggal_cek_in_ri_kamar,
                            'tanggal_cek_out' => $tanggal_cek_out_ri_kamar,
                            'jumlah_hari' => $jumlah_hari,
                            'harga_harian' => $harga_harian,
                            'sub_total_harga' => $sub_total_harga,
                            'status_kamar' => $status_kamar_ri_kamar
                        );

                        $tambah = $this->M_tagihan->input_data('detail_transaksi_rawat_inap_kamar', $data);
                    }
                }
            }
            // End of Cek apakah ada data detail post masuk ?
        }
        // End Of cek di setiap transaksi

        $this->session->set_flashdata('success', 'Ditambahkan');
    }
}
