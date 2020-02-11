<?php
class Pendaftaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('akses') == "") {
            redirect('login');
        } else if ($this->session->userdata('akses') != 'Loket') {
            show_404();
        }
        $this->load->model('loket/M_pendaftaran');
        $this->load->model('admin/M_pasien');
    }
    public function index()
    {
        $data['no_rm'] = $this->M_pendaftaran->get_no_rm(); // generate

        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/loket/pendaftaran/tambah', $data);
    }

    public function showDataPasienFastLoad()
    {
        echo $this->M_pasien->getDataPasienFastLoad();
    }

    public function store()
    {
        // deklarasi  
        $no_ref = $this->M_pendaftaran->get_no(); // generate
        $no_rm = $this->input->post('no_rm');
        $sekarang = Date('Y-m-d H:i:s');

        $data_pelayanan = array(
            'no_ref_pelayanan' => $no_ref,
            'no_rm' => $this->input->post('no_rm'),
            'no_user_pegawai' => $this->session->userdata('id_user'),
            'tgl_pelayanan' => $sekarang,
            'status' => 'belum_finish',
            'tipe_pelayanan' => 'Rawat Jalan'
        );

        $this->M_pendaftaran->input_data('pelayanan', $data_pelayanan);

        // query cek data
        $where_no_rm = array(
            'no_rm' => $no_rm
        );
        $cek_master_pasien = $this->M_pasien->get_data('master_pasien', $where_no_rm);

        $data_pasien = array(
            'no_rm' => $this->input->post('no_rm'),
            'nama' => strtoupper($this->input->post('nama')),
            'alamat' => strtoupper($this->input->post('alamat')),
            'tgl_lahir' => $this->input->post('tgl_lahir'),
            'nama_kk' => strtoupper($this->input->post('nama_kk')),
        );

        if ($cek_master_pasien->num_rows() > 0) {
            // jika data sudah ada dalam master pasien maka akan update
            $update = $this->M_pasien->update_data($where_no_rm, 'master_pasien', $data_pasien);
        } else {
            // jika data tidak ada dalam master pasien maka akan input baru
            $tambah = $this->M_pasien->input_data('master_pasien', $data_pasien);
        }

        // logic antrian
        $kode_antrian = '';
        $layanan_tujuan = $this->input->post('layanan_tujuan');
        $tipe_antrian =  $this->input->post('tipe_antrian');
        $waktu_antrian = $this->input->post('waktu_antrian');

        if ($layanan_tujuan == 'Balai Pengobatan') {

            $kode_antrian = $this->M_pendaftaran->get_no_bp($tipe_antrian, $waktu_antrian); // generate

            $data = array(
                'kode_antrian_bp' => $kode_antrian,
                'tanggal_antrian' => date('Y-m-d'),
                'no_ref_pelayanan' => $no_ref,
                'tipe_antrian' => $tipe_antrian,
                'waktu_antrian' => $waktu_antrian,
            );

            $this->M_pendaftaran->input_data('antrian_bp', $data);
        } elseif ($layanan_tujuan == 'Poli KIA') {

            $kode_antrian = $this->M_pendaftaran->get_no_kia($tipe_antrian); // generate

            $data = array(
                'kode_antrian_kia' => $kode_antrian,
                'tanggal_antrian' => date('Y-m-d'),
                'no_ref_pelayanan' => $no_ref,
                'tipe_antrian' => $tipe_antrian
            );

            $this->M_pendaftaran->input_data('antrian_kia', $data);
        } elseif ($layanan_tujuan == 'Laboratorium') {

            $kode_antrian = $this->M_pendaftaran->get_no_lab($tipe_antrian); // generate

            $data = array(
                'kode_antrian_lab' => $kode_antrian,
                'tanggal_antrian' => date('Y-m-d'),
                'no_ref_pelayanan' => $no_ref,
                'tipe_antrian' => $tipe_antrian
            );

            $this->M_pendaftaran->input_data('antrian_lab', $data);
        }

        //Cetak
        if ($layanan_tujuan != 'UGD') {
            $gabung = $kode_antrian . "_" . $no_ref . "_" . $no_rm;
            $base_url = base_url('loket/pendaftaran/cetak/' . $gabung);
            echo "<script type='text/javascript'>";
            echo "window.open('" . $base_url . "','_blank')";
            echo "</script>";
        }
        redirect('loket/pendaftaran', 'refresh');
    }

    function cetak($gabung)
    {
        $string_exploded = explode('_', $gabung);

        $data['kode_antrian'] = $string_exploded[0];
        $data['no_ref'] = $string_exploded[1];
        $no_rm = $string_exploded[2];
        //Get Data Nama
        $record_pasien = $this->M_pasien->get_data('pasien', array('no_rm' => $no_rm))->result();
        foreach ($record_pasien as $i) {
            $data['nama'] = $i->nama;
        }
        $this->load->view('sim_klinik/konten/loket/pendaftaran/struk_cetak', $data);
    }
}
