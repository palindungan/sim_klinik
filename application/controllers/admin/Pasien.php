<?php
class Pasien extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if (
            $this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Loket' || $this->session->userdata('akses') == 'Admin'
            || $this->session->userdata('akses') == 'Apotek' || $this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == 'Administrasi'
        ) {
        } else {
            show_404();
        }
        $this->load->model('admin/M_pasien');
        $this->load->model('administrasi/M_tagihan');
        $this->load->model('loket/M_pendaftaran');
    }
    public function index()
    {
        $data['no_rm'] = $this->M_pendaftaran->get_no_rm(); // generate

        $data['record'] = $this->M_pasien->getDataPasienFastLoad();
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/admin/pasien/tampil', $data);
    }

    public function showDataPasienFastLoad()
    {
        echo $this->M_pasien->getDataPasienFastLoad();
    }

    public function list($id)
    {
        $data['list'] = $this->M_tagihan->getRekapByNoRM($id)->result();
        $pasien = $this->M_pasien->detail_pasien('pasien', $id)->row();
        $data['pasien'] = $pasien->no_rm . '-' . $pasien->nama;
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/admin/pasien/list_kunjung', $data);
    }
    public function detail($id)
    {
        $data['pelayanan'] = $this->M_pasien->detail_pelayanan('pelayanan', $id)->row();
        $pelayanan = $this->M_pasien->detail_pelayanan('pelayanan', $id)->row();
        $no_rm = $pelayanan->no_rm;
        $data['pasien'] = $this->M_pasien->ambil_nama('pasien', $no_rm)->row();

        $where_no_ref = array(
            'no_ref_pelayanan' => $id
        );

        // ambil data transaksi lain
        $no_transaksi_lain = "kosong";
        $transaksi_lain = $this->M_pasien->get_data('transaksi_lain', $where_no_ref)->result();
        foreach ($transaksi_lain as $data_lain) {
            $no_transaksi_lain = $data_lain->no_transaksi_lain;
        }
        $data['no_transaksi_lain'] = $no_transaksi_lain;
        $data['data_lain'] = $transaksi_lain;

        // ambil data Ambulance
        $no_pelayanan_a = "kosong";
        $pelayanan_ambulance = $this->M_pasien->get_data('pelayanan_ambulan', $where_no_ref)->result();
        foreach ($pelayanan_ambulance as $data_ambulan) {
            $no_pelayanan_a = $data_ambulan->no_pelayanan_a;
        }
        $data['no_pelayanan_a'] = $no_pelayanan_a;
        $data['data_ambulance'] = $pelayanan_ambulance;

        // ambil data Bp Penanganan
        $no_bp_p = "kosong";
        $bp_penanganan = $this->M_pasien->get_data('bp_penanganan', $where_no_ref)->result();
        foreach ($bp_penanganan as $data_bp) {
            $no_bp_p = $data_bp->no_bp_p;
        }
        $data['no_bp_p'] = $no_bp_p;
        $where_no_bp_p = array(
            'no_bp_p' => $no_bp_p
        );
        $data['detail_tindakan_bp'] = $this->M_pasien->get_data('daftar_detail_tindakan_bp_transaksi', $where_no_bp_p)->result();

        // ambil data KIA Penanganan
        $no_kia_p = "kosong";
        $kia_penanganan = $this->M_pasien->get_data('kia_penanganan', $where_no_ref)->result();
        foreach ($kia_penanganan as $data_kia) {
            $no_kia_p = $data_kia->no_kia_p;
        }
        $data['no_kia_p'] = $no_kia_p;
        $where_no_kia_p = array(
            'no_kia_p' => $no_kia_p
        );
        $data['detail_tindakan_kia'] =
            $this->M_pasien->get_data('daftar_detail_tindakan_kia_transaksi', $where_no_kia_p)->result();

        // ambil data UGD Penanganan
        $no_ugd_p = "kosong";
        $ugd_penanganan = $this->M_pasien->get_data('ugd_penanganan', $where_no_ref)->result();
        foreach ($ugd_penanganan as $data_ugd) {
            $no_ugd_p = $data_ugd->no_ugd_p;
        }
        $data['no_ugd_p'] = $no_ugd_p;
        $where_no_ugd_p = array(
            'no_ugd_p' => $no_ugd_p
        );
        $data['detail_tindakan_ugd'] =
            $this->M_pasien->get_data('daftar_detail_tindakan_ugd_transaksi', $where_no_ugd_p)->result();

        // ambil data LAB Transaksi
        $no_lab_t = "kosong";
        $lab_transaksi = $this->M_pasien->get_data('lab_transaksi', $where_no_ref)->result();
        foreach ($lab_transaksi as $data_lab) {
            $no_lab_t = $data_lab->no_lab_t;
        }
        $data['no_lab_t'] = $no_lab_t;
        $where_no_lab_t = array(
            'no_lab_t' => $no_lab_t
        );
        $data['detail_tindakan_lab'] =
            $this->M_pasien->get_data('daftar_detail_tindakan_lab_transaksi', $where_no_lab_t)->result();

        // ambil data UGD Penanganan
        $no_ugd_p = "kosong";
        $ugd_penanganan = $this->M_pasien->get_data('ugd_penanganan', $where_no_ref)->result();
        foreach ($ugd_penanganan as $data_ugd) {
            $no_ugd_p = $data_ugd->no_ugd_p;
        }
        $data['no_ugd_p'] = $no_ugd_p;
        $where_no_ugd_p = array(
            'no_ugd_p' => $no_ugd_p
        );
        $data['detail_tindakan_ugd'] =
            $this->M_pasien->get_data('daftar_detail_tindakan_ugd_transaksi', $where_no_ugd_p)->result();

        // ambil data Detail Apotik
        $no_penjualan_obat_a = "kosong";
        $penjualan_obat_apotik = $this->M_pasien->get_data('penjualan_obat_apotik', $where_no_ref)->result();
        foreach ($penjualan_obat_apotik as $data_obat_apotik) {
            $no_penjualan_obat_a = $data_obat_apotik->no_penjualan_obat_a;
        }
        $data['no_penjualan_obat_a'] = $no_penjualan_obat_a;
        $where_no_penjualan_obat_a = array(
            'no_penjualan_obat_a' => $no_penjualan_obat_a
        );
        $data['detail_penjualan_obat_apotik'] =
            $this->M_pasien->get_data('daftar_penjualan_obat_apotek_detail', $where_no_penjualan_obat_a)->result();

        // ambil data Detail Rawat Inap
        $no_transaksi_rawat_i = "kosong";
        $transaksi_rawat_inap = $this->M_pasien->get_data('transaksi_rawat_inap', $where_no_ref)->result();
        foreach ($transaksi_rawat_inap as $data_rawat_inap) {
            $no_transaksi_rawat_i = $data_rawat_inap->no_transaksi_rawat_i;
        }

        $data['no_transaksi_rawat_i'] = $no_transaksi_rawat_i;
        $where_no_transaksi_rawat_i = array(
            'no_transaksi_rawat_i' => $no_transaksi_rawat_i
        );

        // Detail Kamar Rawat Inap
        $data['detail_transaksi_rawat_inap_k'] =
            $this->M_pasien->get_data('daftar_detail_kamar_rawat_inap', $where_no_transaksi_rawat_i)->result();

        // Detail Tindakan Rawat Inap
        $data['detail_transaksi_rawat_inap_t'] =
            $this->M_pasien->get_data('daftar_detail_tindakan_rawat_inap', $where_no_transaksi_rawat_i)->result();


        // Detail Obat Rawat Inap
        $data['detail_transaksi_rawat_inap_o'] =
            $this->M_pasien->get_data('daftar_penjualan_obat_rawat_inap_detail', $where_no_transaksi_rawat_i)->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/admin/pasien/detail', $data);
    }

    public function store()
    {
        $data_pasien = array(
            'no_rm' => $this->input->post('no_rm'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'umur' => $this->input->post('umur')
        );

        $this->M_pasien->input_data('pasien', $data_pasien);

        $this->session->set_flashdata('success', 'Ditambahkan');
        redirect('admin/pasien');
    }

    public function view_edit($id)
    {
        $where = array(
            'no_rm' => $id
        );

        $data['row'] = $this->M_pasien->get_data('pasien', $where)->result();

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/admin/pasien/edit', $data);
    }
    public function update()
    {
        $where = array(
            'no_rm' => $this->input->post('no_rm')
        );
        $data = array(
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'umur' => $this->input->post('umur')
        );

        $this->M_pasien->update_data($where, 'pasien', $data);

        $this->session->set_flashdata('update', 'Diubah');
        redirect('admin/pasien');
    }
}
