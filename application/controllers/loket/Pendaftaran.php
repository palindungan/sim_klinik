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
        $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/pendaftaran/tambah');
    }

    public function store()
    {

        date_default_timezone_set("Asia/Jakarta");
        $now = Date('Y-m-d');
        $sekarang = Date('Y-m-d H:i:s');
        $hari = $this->input->post('hari');
        $bulan = $this->input->post('bulan');
        $tahun = $this->input->post('tahun');
        $tgl_lahir = $tahun . "-" . $bulan . "-" . $hari;
        $lama = selisihHari($tgl_lahir, $now);
        $this->form_validation->set_message('cek_umur', 'Umur pasien kurang dari 1 hari');
        $this->form_validation->set_message('cek_rm', 'No.Rm tersebut sudah ada');
        $this->form_validation->set_rules('no_rm', 'No. RM', 'required');

        $no_rm = $this->input->post('no_rm');
        $db = $this->db->query("SELECT COUNT(*) as jml_rm FROM pasien WHERE no_rm='$no_rm'")->row();
        $rm_db = $db->jml_rm;
        if ($rm_db > 0) {
            $this->form_validation->set_rules('no_rm', 'No. Rm tersebut sudah ada', 'cek_rm');
        }
        if ($lama < 0) {
            $this->form_validation->set_rules('hari', 'Error aja', 'cek_umur');
        }
        $this->form_validation->set_rules('nik', 'NIK', 'required|numeric|min_length[16]|max_length[16]');
        $this->form_validation->set_rules('tempat_lahir', 'tempat lahir', 'required');
        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('alamat', 'alamat', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->template->load('sim_klinik/template/loket', 'sim_klinik/konten/loket/pendaftaran/tambah');
        } else {
            $no_ref = $this->M_pendaftaran->get_no(); // generate
            $data_pelayanan = array(
                'no_ref_pelayanan' => $no_ref,
                'no_rm' => $this->input->post('no_rm'),
                'no_user_pegawai' => "P001",
                'layanan_tujuan' => $this->input->post('layanan_tujuan'),
                'tipe_antrian' => $this->input->post('tipe_antrian'),
                'tgl_pelayanan' => $sekarang
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

            // logic antrian
            $layanan_tujuan = $this->input->post('layanan_tujuan');

            if ($layanan_tujuan == 'Balai Pengobatan') {

                $tipe_antrian =  $this->input->post('tipe_antrian');
                $kode_antrian = '';

                if ($tipe_antrian == 'Dewasa') {
                    $kode_antrian = $this->M_pendaftaran->get_no_dewasa_bp(); // generate
                } else {
                    $kode_antrian = $this->M_pendaftaran->get_no_anak_anak_bp(); // generate
                }

                $data = array(
                    'kode_antrian_bp' => $kode_antrian,
                    'no_ref_pelayanan' => $no_ref,
                    'status' => "Antri"
                );

                $this->M_pendaftaran->input_data('antrian_bp', $data);
            } elseif ($layanan_tujuan == 'Poli KIA') {

                $kode_antrian = $this->M_pendaftaran->get_no_kia(); // generate

                $data = array(
                    'kode_antrian_kia' => $kode_antrian,
                    'no_ref_pelayanan' => $no_ref,
                    'status' => "Antri"
                );

                $this->M_pendaftaran->input_data('antrian_kia', $data);
            } elseif ($layanan_tujuan == 'Laboratorium') {

                $tipe_antrian =  $this->input->post('tipe_antrian');
                $kode_antrian = '';

                if ($tipe_antrian == 'Dewasa') {
                    $kode_antrian = $this->M_pendaftaran->get_no_dewasa_lab(); // generate
                } else {
                    $kode_antrian = $this->M_pendaftaran->get_no_anak_anak_lab(); // generate
                }

                $data = array(
                    'kode_antrian_lab' => $kode_antrian,
                    'no_ref_pelayanan' => $no_ref,
                    'status' => "Antri"
                );

                $this->M_pendaftaran->input_data('antrian_lab', $data);
            } 

            $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS58");
    
            // membuat objek $printer agar dapat di lakukan fungsinya
            $printer = new Escpos\Printer($connector);
    
            // Printer::MODE_EMPHASIZED
            $printer->initialize();           
            $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
            $printer->setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer -> setTextSize(1, 2);
            $printer->text("Klinik Ampel Sehat \n");
            $printer->text("\n");

            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer -> setTextSize(1, 2);
            $printer->text("Nomor Antrian Nomor \n");
            $printer->text("\n");

            if ($layanan_tujuan == 'Balai Pengobatan') {
                $tipe_antrian =  $this->input->post('tipe_antrian');
                $kode_antrian = '';

                if ($tipe_antrian == 'Dewasa') {
                    $kode_antrian = $this->M_pendaftaran->get_no_dewasa_bp(); // generate
                } else {
                    $kode_antrian = $this->M_pendaftaran->get_no_anak_anak_bp(); // generate
                }
                $printer->initialize();           
                $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
                $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
                $printer -> setTextSize(3, 3);
                $printer->text($kode_antrian." \n");
                $printer->text("\n");
            }
            elseif ($layanan_tujuan == 'Poli KIA') {
                $kode_antrian = $this->M_pendaftaran->get_no_kia(); // generate
                $printer->initialize();           
                $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
                $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
                $printer -> setTextSize(3, 3);
                $printer->text($kode_antrian." \n");
                $printer->text("\n");
            }
            elseif ($layanan_tujuan == 'Laboratorium') {

                $tipe_antrian =  $this->input->post('tipe_antrian');
                $kode_antrian = '';

                if ($tipe_antrian == 'Dewasa') {
                    $kode_antrian = $this->M_pendaftaran->get_no_dewasa_lab(); // generate
                } else {
                    $kode_antrian = $this->M_pendaftaran->get_no_anak_anak_lab(); // generate
                }
                $printer->initialize();           
                $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
                $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
                $printer -> setTextSize(3, 3);
                $printer->text($kode_antrian." \n");
                $printer->text("\n");
            }
            elseif($layanan_tujuan == 'UGD') {
                $printer->initialize();           
                $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
                $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
                $printer -> setTextSize(3, 3);
                $printer->text("UGD \n");
                $printer->text("\n");
            }
            
            $no_ref = $this->M_pendaftaran->get_no(); // generate
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->text("No pelayanan : ".$no_ref." \n");

            $hari = hari_ini();
            $tgl_indo = tgl_indo($now);
            $jam = date("H:i");
            $printer->initialize();
            $printer->setFont(Escpos\Printer::FONT_B);
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->text($hari.",".$tgl_indo." ".$jam." \n");
            
            /* ---------------------------------------------------------
            * Menyelesaikan printer
            */
            $printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat ke atas
            $printer->close();
            $this->session->set_flashdata('pendaftaran', 'Ditambahkan');
            redirect('loket/pendaftaran');
            
        }
    }
}
