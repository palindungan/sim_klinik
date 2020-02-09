<?php
class Pengiriman_obat extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if ($this->session->userdata('akses') != 'Apotek') {
            show_404();
        }
        $this->load->model('apotek/M_pengiriman_obat');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/pengiriman_obat/tambah');
    }

    public function tampil_daftar_obat_gudang()
    {
        $data_tbl['tbl_data'] = $this->M_pengiriman_obat->tampil_data('data_obat')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function tampil_daftar_obat_apotik()
    {
        $data_tbl['tbl_data'] = $this->M_pengiriman_obat->tampil_data('data_stok_obat_apotek')->result();

        $data = json_encode($data_tbl);

        echo $data;
    }

    public function input_pengiriman_obat()
    {
        $tujuan = $this->input->post('tujuan');
        if (isset($_POST['kode_obat'])) {
            $no_obat_keluar_i = $this->M_pengiriman_obat->get_no_transaksi(); // generate
            $tgl_obat_keluar_i = date('Y-m-d H:i:s');
            $data = array(
                'no_obat_keluar_i' => $no_obat_keluar_i,
                'tujuan' => $tujuan,
                'tgl_obat_keluar_i' => $tgl_obat_keluar_i
            );
            $status = $this->M_pengiriman_obat->input_data('obat_keluar_internal', $data);
            if ($status) {
                for ($i = 0; $i < count($this->input->post('kode_obat')); $i++) {

                    $kode_obat = $this->input->post('kode_obat')[$i];
                    $qty = $this->input->post('qty')[$i];
                    $qty_sekarang = $this->input->post('qty_sekarang')[$i];

                    // proses pemasukan ke dalam database detail
                    $where = array(
                        'kode_obat' => $kode_obat
                    );
                    $cek_obat = $this->M_pengiriman_obat->get_data('obat', $where)->num_rows();
                    $stok_obat = $this->M_pengiriman_obat->get_data('obat', $where)->result();
                    $qty_obat = 0;
                    $status_detail = false;

                    if($tujuan == "Rawat Inap")
                    {
                        foreach ($stok_obat as $stok) {
                            $qty_obat = $stok->stok_rawat_inap;
                        }
    
                        if ($cek_obat > 0) {
                            $data = array(
                                'stok_rawat_inap' => $qty_obat + $qty
                            );
                            $status_detail = $this->M_pengiriman_obat->update_data($where, 'obat', $data);
                        }
                        // detail 
                        $data = array(
                            'no_obat_keluar_i' => $no_obat_keluar_i,
                            'kode_obat' => $kode_obat,
                            'qty' => $qty
                        );
                        $status_detail = $this->M_pengiriman_obat->input_data('detail_obat_keluar_internal', $data);

                        // update stok di penyimpanan
                        if ($status_detail) 
                        {
                            $where = array(
                                'kode_obat' => $kode_obat
                            );

                            $qty_baru = $qty_sekarang - $qty;

                            if ($qty_baru < 0) {
                                $qty_baru = 0;
                            }

                            $data = array(
                                'stok_gudang' => $qty_baru
                            );

                            $status_update = $this->M_pengiriman_obat->update_data($where, 'obat', $data);
                        }
                    }

                    else
                    {
                        foreach ($stok_obat as $stok) {
                            $qty_obat = $stok->stok_rawat_jalan;
                        }
    
                        if ($cek_obat > 0) {
                            $data = array(
                                'stok_rawat_jalan' => $qty + $qty_obat
                            );
                            $status_detail = $this->M_pengiriman_obat->update_data($where, 'obat', $data);
                        }
                        // detail 
                        $data = array(
                            'no_obat_keluar_i' => $no_obat_keluar_i,
                            'kode_obat' => $kode_obat,
                            'qty' => $qty
                        );
                        $status_detail = $this->M_pengiriman_obat->input_data('detail_obat_keluar_internal', $data);

                        // update stok di penyimpanan
                        if ($status_detail) 
                        {
                            $where = array(
                                'kode_obat' => $kode_obat
                            );

                            $qty_baru = $qty_sekarang - $qty;

                            if ($qty_baru < 0) {
                                $qty_baru = 0;
                            }

                            $data = array(
                                'stok_gudang' => $qty_baru
                            );

                            $status_update = $this->M_pengiriman_obat->update_data($where, 'obat', $data);
                        }
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
        $data['record'] = $this->db->order_by('no_obat_keluar_i', 'DESC')->get('obat_keluar_internal')->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/pengiriman/tampil', $data);
    }

    public function tampil_detail_daftar_pengiriman_obat()
    {
        $no_obat_keluar_i = $this->input->get('no_obat_keluar_i');

        $where = array(
            'no_obat_keluar_i' => $no_obat_keluar_i
        );

        $data['record'] = $this->M_pengiriman_obat->get_data('obat_keluar_internal', $where)->result();

        $data['detail_record'] = $this->M_pengiriman_obat->get_data('daftar_pengiriman_obat_detail', $where)->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/apotek/history/pengiriman/detail', $data);
    }
}
