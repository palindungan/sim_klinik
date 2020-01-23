<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    require('./vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    class RawatInap extends CI_Controller {

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
            $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/admin/laporan/rawat_inap');
        }

        public function ri_hari_ini() {
            $tgl = tgl_indo(date('Y-m-d'));
            $tgl_judul = date('d-m-Y');
            $spreadsheet = new Spreadsheet();
            $spreadsheet = new Spreadsheet;
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(20);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:T1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:T1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:T1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:T1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Tanggal '.$tgl);
            $spreadsheet->getActiveSheet()->getStyle('A1:T1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:T1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:T1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:T1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup
            
            $spreadsheet->getActiveSheet()->mergeCells("A2:A3");
            $spreadsheet->getActiveSheet()->mergeCells("B2:B3");
            $spreadsheet->getActiveSheet()->mergeCells("C2:C3");
            $spreadsheet->getActiveSheet()->mergeCells("D2:D3");
            $spreadsheet->getActiveSheet()->mergeCells("E2:G2");
            $spreadsheet->getActiveSheet()->mergeCells("H2:H3");
            $spreadsheet->getActiveSheet()->mergeCells("I2:I3");
            $spreadsheet->getActiveSheet()->mergeCells("J2:J3");
            $spreadsheet->getActiveSheet()->mergeCells("K2:K3");
            $spreadsheet->getActiveSheet()->mergeCells("L2:N2");
            $spreadsheet->getActiveSheet()->mergeCells("O2:O3");
            $spreadsheet->getActiveSheet()->mergeCells("P2:P3");
            $spreadsheet->getActiveSheet()->mergeCells("Q2:Q3");
            $spreadsheet->getActiveSheet()->mergeCells("R2:R3");
            $spreadsheet->getActiveSheet()->mergeCells("S2:S3");
            $spreadsheet->getActiveSheet()->mergeCells("T2:T3");



            $spreadsheet->getActiveSheet()->getStyle('A2:T3')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:T3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:T3')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:T3')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:T3')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:T3')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:T3')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Nomor')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Nama')
            ->setCellValue('D2', 'Uang Masuk')
            ->setCellValue('E2', 'Lab')
            ->setCellValue('E3', 'GDA')
            ->setCellValue('F3', 'HB,Golongan Darah, Darah Lengkap,Widal,OTPT,UL,Buncreat')
            ->setCellValue('G3', 'Lab Luar')
            ->setCellValue('H2', 'Ambulance')
            ->setCellValue('I2', 'Lain-Lain')
            ->setCellValue('J2', 'Obat Oral')
            ->setCellValue('K2', 'Pemasukan Bersih')
            ->setCellValue('L2', 'Akomodasi')
            ->setCellValue('L3', 'Obat')
            ->setCellValue('M3', 'Alkes')
            ->setCellValue('N3', 'Lain-lain')
            ->setCellValue('O2', 'Sisa Per Hari')
            ->setCellValue('P2', 'Japel')
            ->setCellValue('Q2', 'Visite')
            ->setCellValue('R2', 'Klinik Bersih')
            ->setCellValue('S2', 'Rekening')
            ->setCellValue('T2', 'Saldo');

            $kolom = 3;
            $nomor = 1;

            // di dalam loop
            $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('left');
            $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal('right');
        
            


            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RI_'.$tgl_judul.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            
        }
    
        
    }
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
    ?>
