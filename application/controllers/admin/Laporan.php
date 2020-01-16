<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    require('./vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    class Laporan extends CI_Controller {

        // public function index() {
        //     $this->load->view('sim_klinik/konten/administrasi/cetak_struk/tampil');
        // }
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin/M_laporan');
            date_default_timezone_set('Asia/Jakarta');

        }

        public function index()
        {
            $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/laporan/tampil');
        }

        public function rj_hari_ini() {

            $query = $this->M_laporan->laporan_rj_hari_ini();
            $tgl = tgl_indo(date('Y-m-d'));
            $tgl_judul = date('d-m-Y');
            $spreadsheet = new Spreadsheet();
            $spreadsheet = new Spreadsheet;
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:I1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:I1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:I1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Jalan Tanggal '.$tgl);
            $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:I1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:I1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup

            $spreadsheet->getActiveSheet()->getStyle('A2:I2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:I2')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:I2')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Nomor')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Nama')
            ->setCellValue('D2', 'Gula Darah')
            ->setCellValue('E2', 'Asam Urat')
            ->setCellValue('F2', 'Kolesterol')
            ->setCellValue('G2', 'Lain-Lain')
            ->setCellValue('H2', 'Biaya Periksa')
            ->setCellValue('I2', 'Total');

            $kolom = 3;
            $nomor = 1;
            $grand_total = 0;
            foreach ($query as $row) {
            $grand_total += $row->total_harga;
            $tgl_parsing = date('Y-m-d',strtotime($row->tgl_pelayanan));
            $tgl_pelayanan = tgl_indo($tgl_parsing);

            $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('left');
            $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('left');
            $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal('right');




            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom,$tgl_pelayanan)
            ->setCellValue('C' . $kolom, $row->nama_pasien)
            ->setCellValue('D' . $kolom, number_format($row->periksa_gula_darah, 0, ".", ","))
            ->setCellValue('E' . $kolom, number_format($row->periksa_asam_urat, 0, ".", ","))
            ->setCellValue('F' . $kolom, number_format($row->periksa_kolesterol, 0, ".", ","))
            ->setCellValue('G' . $kolom, number_format($row->total_harga - ($row->periksa_gula_darah +
            $row->periksa_asam_urat + $row->periksa_kolesterol + $row->biaya_periksa), 0, ".", ","))
            ->setCellValue('H' . $kolom, number_format($row->biaya_periksa, 0, ".", ","))
            ->setCellValue('I' . $kolom,number_format($row->total_harga, 0, ".", ","));
            $kolom++;
            $nomor++;
            }

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('H' . ((int) $kolom + 3), 'Grand Total')
            ->setCellValue('I' . ((int) $kolom + 3), number_format($grand_total, 0, ".", ","));

            $spreadsheet->getActiveSheet()->getStyle('B' . ((int) $kolom + 3) . ':C' . ((int) $kolom +
            3))->getFont()->setBold(true);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RJ_'.$tgl_judul.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            
        }

        public function rj_bulan_ini() {

        $query = $this->M_laporan->laporan_rj_bulan_ini();
        $spreadsheet = new Spreadsheet();
        $spreadsheet = new Spreadsheet;
        $tanggal = date('F Y');
        $tanggal_judul = date('F-Y');
        // Mengatur Lebar Kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(20);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);

        $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
        // Atur Judul
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("A1:I1")->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')
        ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $spreadsheet->getActiveSheet()->mergeCells("A1:I1");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Jalan Bulan '.$tanggal);
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A1:I1')
        ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        // tutup

        $spreadsheet->getActiveSheet()->getStyle('A2:I2')
        ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('006400');
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')
        ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')
        ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        // Border
        $spreadsheet->getActiveSheet()->getStyle('A2:I2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A2', 'Nomor')
        ->setCellValue('B2', 'Tanggal')
        ->setCellValue('C2', 'Nama')
        ->setCellValue('D2', 'Gula Darah')
        ->setCellValue('E2', 'Asam Urat')
        ->setCellValue('F2', 'Kolesterol')
        ->setCellValue('G2', 'Lain-Lain')
        ->setCellValue('H2', 'Biaya Periksa')
        ->setCellValue('I2', 'Total');

        $kolom = 3;
        $nomor = 1;
        $grand_total = 0;
        foreach ($query as $row) {
            $grand_total += $row->total_harga;
        $tgl_parsing = date('Y-m-d',strtotime($row->tgl_pelayanan));
        $tgl_pelayanan = tgl_indo($tgl_parsing);

        $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
        $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('left');
        $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('left');
        $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal('right');
        $spreadsheet->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal('right');
        $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal('right');
        $spreadsheet->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal('right');
        $spreadsheet->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal('right');
        $spreadsheet->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal('right');




        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A' . $kolom, $nomor)
        ->setCellValue('B' . $kolom,$tgl_pelayanan)
        ->setCellValue('C' . $kolom, $row->nama_pasien)
        ->setCellValue('D' . $kolom, number_format($row->periksa_gula_darah, 0, ".", ","))
        ->setCellValue('E' . $kolom, number_format($row->periksa_asam_urat, 0, ".", ","))
        ->setCellValue('F' . $kolom, number_format($row->periksa_kolesterol, 0, ".", ","))
        ->setCellValue('G' . $kolom, number_format($row->total_harga - ($row->periksa_gula_darah +
        $row->periksa_asam_urat + $row->periksa_kolesterol + $row->biaya_periksa), 0, ".", ","))
        ->setCellValue('H' . $kolom, number_format($row->biaya_periksa, 0, ".", ","))
        ->setCellValue('I' . $kolom,number_format($row->total_harga, 0, ".", ","));
        $kolom++;
        $nomor++;
        }

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('H' . ((int) $kolom + 3), 'Grand Total')
        ->setCellValue('I' . ((int) $kolom + 3), number_format($grand_total, 0, ".", ","));

        $spreadsheet->getActiveSheet()->getStyle('B' . ((int) $kolom + 3) . ':C' . ((int) $kolom +
        3))->getFont()->setBold(true);

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RJ_'.$tanggal_judul.'.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

        }
    
        
    }
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
    ?>
