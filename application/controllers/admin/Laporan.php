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
        $this->load->model('M_test');
        }

        public function index() {
            $spreadsheet = new Spreadsheet();
            $spreadsheet = new Spreadsheet;
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(25);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:G1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:G1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:G1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Jalan');
            $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:G1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:G1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup

            $spreadsheet->getActiveSheet()->getStyle('A2:G2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:G2')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:G2')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:G2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Tanggal')
            ->setCellValue('B2', 'Nama')
            ->setCellValue('C2', 'Gula Darah')
            ->setCellValue('D2', 'Asam Urat')
            ->setCellValue('E2', 'Kolesterol')
            ->setCellValue('F2', 'Lain-Lain')
            ->setCellValue('G2', 'Total');

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="asd.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            
        }
    
        
    }
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
    ?>
