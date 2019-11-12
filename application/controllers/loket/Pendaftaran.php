<?php
class Pendaftaran extends CI_Controller
{
    function __construct()
    {
        parent::__construct();

        $this->load->model('loket/M_pendaftaran');
    }
    public function index()
    {
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/pendaftaran/tampil');
    }
    public function add()
    {
        $this->template->load('sim_klinik/template/loket','sim_klinik/konten/loket/pendaftaran/tambah');
    }
    
    public function store()
    {
        $this->form_validation->set_rules('no_rm','No. RM','required');
        $this->form_validation->set_rules('nik','NIK','required|numeric|min_length[16]|max_length[16]');
        $this->form_validation->set_rules('tempat_lahir','tempat lahir','required');
        $this->form_validation->set_rules('nama','nama','required');
        $this->form_validation->set_rules('alamat','alamat','required');
        date_default_timezone_set("Asia/Jakarta");
        $now = Date('Y-m-d');
        $hari = $this->input->post('hari');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $tgl_lahir = $tahun."-".$bulan."-".$hari;
        $lama = selisihHari($tgl_lahir,$now);
        $this->form_validation->set_message('cek_umur', 'Umur pasien kurang dari 1 hari');
        if($lama < 0)
        {
            $this->form_validation->set_rules('hari','Error aja','cek_umur');
        }
        if ($this->form_validation->run() == FALSE)
        {
            $this->template->load('sim_klinik/template/loket','sim_klinik/konten/loket/pendaftaran/tambah');
        }
        else
        {
            $no_ref = $this->M_pendaftaran->get_no(); // generate
            $data_pelayanan = array(
                'no_ref_pelayanan' => $no_ref,
                'no_rm' => $this->input->post('no_rm'),
                'no_user_pegawai' => "P001",
                'tipe_antrian' => $this->input->post('tipe_antrian'),
                'tgl_pelayanan' => $now
            );

            $data_pasien = array(
                'no_rm' => $this->input->post('no_rm'),
                'nama' => $this->input->post('nama'),
                'nik' => $this->input->post('nik'),
                'tempat_lahir' => $this->input->post('tempat_lahir'),
                'tgl_lahir' => $tgl_lahir,
                'jenkel' => $this->input->post('jenis_kelamin'),
                'alamat' => $this->input->post('alamat')
            );

            $this->M_pendaftaran->input_data('pelayanan', $data_pelayanan);
            $this->M_pendaftaran->input_data('pasien', $data_pasien);
            redirect('loket/pendaftaran/add');

        }
    }
}
