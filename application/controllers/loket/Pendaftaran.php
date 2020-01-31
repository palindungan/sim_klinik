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

        date_default_timezone_set("Asia/Jakarta");
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
        $data_pasien = array(
            'no_rm' => $this->input->post('no_rm'),
            'nama' => $this->input->post('nama'),
            'alamat' => $this->input->post('alamat'),
            'umur' => $this->input->post('umur')
        );

        $db = $this->db->query("SELECT COUNT(*) as jml_rm FROM pasien WHERE no_rm='$no_rm'")->row();
        $rm_db = $db->jml_rm;
        if ($rm_db > 0) {
            $this->M_pendaftaran->input_data('pelayanan', $data_pelayanan);
        } else {
            $this->M_pendaftaran->input_data('pelayanan', $data_pelayanan);
            $this->M_pendaftaran->input_data('pasien', $data_pasien);
        }

        // logic antrian
        $kode_antrian = '';
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

        //Cetak
        $gabung = $kode_antrian . "_" . $no_ref;
        $base_url = base_url('loket/pendaftaran/cetak/' . $gabung);
        echo "<script type='text/javascript'>";
        echo "window.open('" . $base_url . "','_blank')";
        echo "</script>";

        // // membuat objek $printer agar dapat di lakukan fungsinya
        // $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS58");
        // $printer = new Escpos\Printer($connector);

        // if ($layanan_tujuan == 'Balai Pengobatan') {
        //     $tipe_antrian =  $this->input->post('tipe_antrian');
        //     $kode_antrian = '';

        //     if ($tipe_antrian == 'Dewasa') {
        //         $kode_antrian = $this->M_pendaftaran->get_no_dewasa_bp(); // generate
        //     } else {
        //         $kode_antrian = $this->M_pendaftaran->get_no_anak_anak_bp(); // generate
        //     }

        //         // Printer::MODE_EMPHASIZED
        //     $printer->initialize();
        //     $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        //     $printer->setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(1, 2);
        //     $printer->text("Klinik Ampel Sehat \n");
        //     $printer->text("\n");

        //     $printer->initialize();
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(1, 2);
        //     $printer->text("Nomor Antrian Nomor \n");
        //     $printer->text("\n");

        //     $printer->initialize();
        //     $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(3, 3);
        //     $printer->text($kode_antrian . " \n");
        //     $printer->text("\n");

        //     $no_ref = $this->M_pendaftaran->get_no(); // generate
        //     $printer->initialize();
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->text("No pelayanan : " . $no_ref . " \n");

        //     $hari = hari_ini();
        //     $tgl_indo = tgl_indo($now);
        //     $jam = date("H:i");
        //     $printer->initialize();
        //     $printer->setFont(Escpos\Printer::FONT_B);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->text($hari . "," . $tgl_indo . " " . $jam . " \n");

        //     /* ---------------------------------------------------------
        //     * Menyelesaikan printer
        //     */
        //     $printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat ke atas
        //     $printer->close();
        // } elseif ($layanan_tujuan == 'Poli KIA') {
        //     $kode_antrian = $this->M_pendaftaran->get_no_kia(); // generate

        //         // Printer::MODE_EMPHASIZED
        //     $printer->initialize();
        //     $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        //     $printer->setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(1, 2);
        //     $printer->text("Klinik Ampel Sehat \n");
        //     $printer->text("\n");

        //     $printer->initialize();
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(1, 2);
        //     $printer->text("Nomor Antrian Nomor \n");
        //     $printer->text("\n");

        //     $printer->initialize();
        //     $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(3, 3);
        //     $printer->text($kode_antrian . " \n");
        //     $printer->text("\n");

        //     $no_ref = $this->M_pendaftaran->get_no(); // generate
        //     $printer->initialize();
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->text("No pelayanan : " . $no_ref . " \n");

        //     $hari = hari_ini();
        //     $tgl_indo = tgl_indo($now);
        //     $jam = date("H:i");
        //     $printer->initialize();
        //     $printer->setFont(Escpos\Printer::FONT_B);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->text($hari . "," . $tgl_indo . " " . $jam . " \n");

        //     /* ---------------------------------------------------------
        //     * Menyelesaikan printer
        //     */
        //     $printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat ke atas
        //     $printer->close();
        // } elseif ($layanan_tujuan == 'Laboratorium') {

        //     $tipe_antrian =  $this->input->post('tipe_antrian');
        //     $kode_antrian = '';

        //     if ($tipe_antrian == 'Dewasa') {
        //         $kode_antrian = $this->M_pendaftaran->get_no_dewasa_lab(); // generate
        //     } else {
        //         $kode_antrian = $this->M_pendaftaran->get_no_anak_anak_lab(); // generate
        //     }

        //         // Printer::MODE_EMPHASIZED
        //     $printer->initialize();
        //     $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        //     $printer->setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(1, 2);
        //     $printer->text("Klinik Ampel Sehat \n");
        //     $printer->text("\n");

        //     $printer->initialize();
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(1, 2);
        //     $printer->text("Nomor Antrian \n");
        //     $printer->text("\n");

        //     $printer->initialize();
        //     $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->setTextSize(3, 3);
        //     $printer->text($kode_antrian . " \n");
        //     $printer->text("\n");
        //     $no_ref = $this->M_pendaftaran->get_no(); // generate
        //     $printer->initialize();
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->text("No pelayanan : " . $no_ref . " \n");

        //     $hari = hari_ini();
        //     $tgl_indo = tgl_indo($now);
        //     $jam = date("H:i");
        //     $printer->initialize();
        //     $printer->setFont(Escpos\Printer::FONT_B);
        //     $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
        //     $printer->text($hari . "," . $tgl_indo . " " . $jam . " \n");

        //     /* ---------------------------------------------------------
        //     * Menyelesaikan printer
        //     */
        //     $printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat ke atas
        //     $printer->close();
        // }
        redirect('loket/pendaftaran', 'refresh');
    }

    function cetak($gabung)
    {
        $string_exploded = explode('_', $gabung);

        $data['kode_antrian'] = $string_exploded[0];
        $data['no_ref'] = $string_exploded[1];
        $this->load->view('sim_klinik/konten/loket/pendaftaran/struk_cetak', $data);
    }
}
