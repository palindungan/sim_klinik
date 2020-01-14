<?php
class Pengiriman_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('apotek/M_pengiriman_obat');
        date_default_timezone_set('Asia/Jakarta');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/pengiriman_obat/tambah');
    }
    public function tampil_daftar_obat()
    {
        $where = array(
            'qty >' => 0
        );
        $data_tbl['tbl_data'] = $this->M_pengiriman_obat->get_data('data_obat', $where)->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function input_pengiriman_obat()
    {
        $tujuan = $this->input->post('tujuan');
        if (isset($_POST['kode_obat'])) {
            $no_obat_keluar_i = $this->M_pengiriman_obat->get_no_transaksi(); // generate
            $tgl_obat_keluar_i = date('Y-m-d H:i:s');
            $obat_keluar_internal = array(
                'no_obat_keluar_i' => $no_obat_keluar_i,
                'tujuan' => $tujuan,
                'tgl_obat_keluar_i' => $tgl_obat_keluar_i
            );
            $status = $this->M_pengiriman_obat->input_data('obat_keluar_internal', $obat_keluar_internal);
            if ($status) {
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];
                    $qty = $this->input->post('qty')[$i];
                    $qty_sekarang = $this->input->post('qty_sekarang')[$i];
                    $no_penerimaan_o = $this->input->post('no_penerimaan_o')[$i];

                    // proses pemasukan ke dalam database detail
                    $where_ko = array(
                        'kode_obat' => $kode_obat
                    );
                    $cek_obat_ri = $this->M_pengiriman_obat->get_data('stok_obat_rawat_inap', $where_ko)->num_rows();
                    $stok_obat_ri = $this->M_pengiriman_obat->get_data('stok_obat_rawat_inap', $where_ko)->result();
                    $qty_ri = " ";
                    foreach ($stok_obat_ri as $stok_ri) {
                        $qty_ri = $stok_ri->qty;
                    }
                    if ($cek_obat_ri > 0) {
                        $data = array(
                            'kode_obat' => $kode_obat,
                            'qty' => $qty + $qty_ri
                        );
                        $status_detail = $this->M_pengiriman_obat->update_data($where_ko, 'stok_obat_rawat_inap', $data);
                    } else {
                        $data = array(
                            'kode_obat' => $kode_obat,
                            'qty' => $qty
                        );

                        $status_detail = $this->M_pengiriman_obat->input_data('stok_obat_rawat_inap', $data);
                    }


                    // update stok di penyimpanan
                    if ($status_detail) {

                        $where = array(
                            'no_penerimaan_o' => $no_penerimaan_o,
                            'kode_obat' => $kode_obat
                        );

                        $data = array(
                            'qty' => $qty_sekarang -  $qty
                        );

                        $status_update = $this->M_pengiriman_obat->update_data($where, 'stok_obat_apotik', $data);
                    }
                }
                if ($status_update) {
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
        redirect('apotek/pengiriman_obat');
    }

    public function tampil_daftar_pengiriman_obat()
    {
        $data['record'] = $this->M_pengiriman_obat->tampil_data('obat_keluar_internal')->result();

        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/history/pengiriman/tampil', $data);
    }

    public function tampil_detail_daftar_pengiriman_obat()
    {
        $no_obat_keluar_i = $this->input->get('no_obat_keluar_i');

        $where = array(
            'no_obat_keluar_i' => $no_obat_keluar_i
        );

        $data['record'] = $this->M_pengiriman_obat->get_data('obat_keluar_internal', $where)->result();

        $data['detail_record'] = $this->M_pengiriman_obat->get_data('daftar_pengiriman_obat_apotek_detail', $where)->result();

        $this->template->load('sim_klinik/template/apotek', 'sim_klinik/konten/apotek/history/pengiriman/detail', $data);
    }
}
