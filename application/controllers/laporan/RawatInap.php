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
            $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/laporan/rawat_inap');
        }

        public function ri_hari_ini() {
            $query = $this->M_laporan->laporan_ri_hari_ini();

            $tgl = tgl_indo(date('Y-m-d'));
            $tgl_judul = date('d-m-Y');
            $spreadsheet = new Spreadsheet();
            $spreadsheet = new Spreadsheet;
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(15);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:R1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:R1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:R1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Tanggal '.$tgl);
            $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:R1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:R1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup


            $spreadsheet->getActiveSheet()->getStyle('A2:R2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:R2')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:R2')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;


            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Nomor')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Nama')
            ->setCellValue('D2', 'Uang Masuk')
            ->setCellValue('E2', 'Uang Makan/Gizi')
            ->setCellValue('F2', 'Kamar')
            ->setCellValue('G2', 'BP')
            ->setCellValue('H2', 'LAB')
            ->setCellValue('I2', 'KIA')
            ->setCellValue('J2', 'UGD')
            ->setCellValue('K2', 'Ambulance')
            ->setCellValue('L2', 'Semua Obat')
            ->setCellValue('M2', 'Obat Oral')
            ->setCellValue('N2', 'Pemasukan Bersih')
            ->setCellValue('O2', 'Japel')
            ->setCellValue('P2', 'Visite')
            ->setCellValue('Q2', 'Klinik Bersih')
            ->setCellValue('R2', 'Saldo');

            $kolom = 3;
            $nomor = 1;
            foreach ($query as $row) {
            $semua_obat = $row->obat_ri + $row->obat_apotik;
            $obat_oral = (int) $row->obat_oral;
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
            $spreadsheet->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('O')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('P')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal('right');
            $spreadsheet->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal('right');
        
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom,$tgl_keluar)
            ->setCellValue('C' . $kolom, $row->nama_pasien)
            ->setCellValue('D' . $kolom, number_format($row->uang_masuk, 0, ".", ","))
            ->setCellValue('E' . $kolom, number_format($row->gizi, 0, ".", ","))
            ->setCellValue('F' . $kolom, number_format($row->kamar, 0, ".", ","))
            ->setCellValue('G' . $kolom, number_format($row->total_bp, 0, ".", ","))
            ->setCellValue('H' . $kolom, number_format($row->total_lab, 0, ".", ","))
            ->setCellValue('I' . $kolom, number_format($row->total_kia, 0, ".", ","))
            ->setCellValue('J' . $kolom, number_format($row->total_ugd, 0, ".", ","))
            ->setCellValue('K' . $kolom, number_format($row->biaya_ambulance, 0, ".", ","))
            ->setCellValue('L' . $kolom, number_format($semua_obat, 0, ".", ","))
            ->setCellValue('M' . $kolom, number_format($sub_total, 0, ".", ","))
            ->setCellValue('N' . $kolom, number_format($sub_total, 0, ".", ","))
            ->setCellValue('O' . $kolom, number_format($sub_total, 0, ".", ","))
            ->setCellValue('P' . $kolom, number_format($sub_total, 0, ".", ","))
            ->setCellValue('Q' . $kolom, number_format($sub_total, 0, ".", ","))
            ->setCellValue('R' . $kolom, number_format($sub_total, 0, ".", ","));
            $kolom++;
            $nomor++;
            }


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
