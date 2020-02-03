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

    public function tampil_daftar_pasien()
    {
        require('assets/sb_admin_2/vendor/fast_load_datatable/ssp.class.php');

        // DB table to use
        $table = 'pasien';

        // Table's primary key
        $primaryKey = 'no_rm';

        $columns = array(
            array('db' => 'no_rm', 'dt' => 0),
            array('db' => 'nama',  'dt' => 1),
            array('db' => 'umur',  'dt' => 2),
            array('db' => 'alamat',  'dt' => 3),
        );

        // koneksiDatatable ambil dari custom helper
        echo json_encode(
            SSP::simple($_GET, koneksiDatatable(), $table, $primaryKey, $columns)
        );
    }

    public function store()
    {
        $now = Date('Y-m-d');
        $sekarang = Date('Y-m-d H:i:s');

        $no_rm = $this->input->post('no_rm');
        $no_ref = $this->M_pendaftaran->get_no(); // generate
        $data_pelayanan = array(
            'no_ref_pelayanan' => $no_ref,
            'no_rm' => $this->input->post('no_rm'),
            'no_user_pegawai' => "P001",
            'layanan_tujuan' => $this->input->post('layanan_tujuan'),
            'tipe_antrian' => $this->input->post('tipe_antrian'),
            'tgl_pelayanan' => $sekarang,
            'status' => 'belum_finish',
            'tipe_pelayanan' => 'Rawat Jalan'
        );
        
        $db = $this->db->query("SELECT COUNT(*) as jml_rm FROM pasien WHERE no_rm='$no_rm'")->row();
        $rm_db = $db->jml_rm;

        $this->M_pendaftaran->input_data('pelayanan', $data_pelayanan);
        if ($rm_db == 0) {
            $data_pasien = array(
                'no_rm' => $this->input->post('no_rm'),
                'nama' => strtoupper($this->input->post('nama')),
                'alamat' => strtoupper($this->input->post('alamat')),
                'umur' => $this->input->post('umur')
            );
            $this->M_pendaftaran->input_data('pasien', $data_pasien);
        }

        // logic antrian
        $kode_antrian = '';
        $layanan_tujuan = $this->input->post('layanan_tujuan');
        $tipe_antrian =  $this->input->post('tipe_antrian');
        $waktu_antrian = $this->input->post('waktu_antrian');


        if ($layanan_tujuan == 'Balai Pengobatan') {
            
            $kode_antrian = $this->M_pendaftaran->get_no_bp($tipe_antrian,$waktu_antrian); // generate

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
        if($layanan_tujuan != 'UGD'){
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
