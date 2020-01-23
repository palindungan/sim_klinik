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

        public function rawat_jalan()
        {
            $data['rj_hari'] = $this->M_laporan->laporan_rj_hari_ini();
            $data['rj_bulan'] = $this->M_laporan->laporan_rj_bulan_ini();
            $this->template->load('sim_klinik/template/admin', 'sim_klinik/konten/admin/laporan/rawat_jalan',$data);
        }

        public function rj_hari_ini() {

            $query = $this->M_laporan->laporan_rj_hari_ini();
            $tgl = tgl_indo(date('Y-m-d'));
            $tgl_judul = date('d-m-Y');
            $spreadsheet = new Spreadsheet();
            $spreadsheet = new Spreadsheet;
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:L1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:L1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Jalan Tanggal '.$tgl);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup

            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Nomor')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Nama')
            ->setCellValue('D2', 'GD')
            ->setCellValue('E2', 'AU')
            ->setCellValue('F2', 'Chol')
            ->setCellValue('G2', 'BP')
            ->setCellValue('H2', 'LAB')
            ->setCellValue('I2', 'KIA')
            ->setCellValue('J2', 'UGD')
            ->setCellValue('K2', 'Apotik')
            ->setCellValue('L2', 'Total');

            $kolom = 3;
            $nomor = 1;
            $grand_total = 0;
            $sub_total = 0;
            foreach ($query as $row) {
            $tgl_pelayanan = date('d-m-Y',strtotime($row->tgl_pelayanan));
            $sub_total = $row->gula_darah + $row->asam_urat + $row->cholesterol + $row->total_bp + $row->lab_non_primer + $row->total_kia + $row->total_ugd + $row->total_obat_apotik;

            $grand_total += $sub_total;

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




            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom,$tgl_pelayanan)
            ->setCellValue('C' . $kolom, $row->nama_pasien)
            ->setCellValue('D' . $kolom, number_format($row->gula_darah, 0, ".", ","))
            ->setCellValue('E' . $kolom, number_format($row->asam_urat, 0, ".", ","))
            ->setCellValue('F' . $kolom, number_format($row->cholesterol, 0, ".", ","))
            ->setCellValue('G' . $kolom, number_format($row->total_bp, 0, ".", ","))
            ->setCellValue('H' . $kolom, number_format($row->lab_non_primer, 0, ".", ","))
            ->setCellValue('I' . $kolom, number_format($row->total_kia, 0, ".", ","))
            ->setCellValue('J' . $kolom, number_format($row->total_ugd, 0, ".", ","))
            ->setCellValue('K' . $kolom, number_format($row->total_obat_apotik, 0, ".", ","))
            ->setCellValue('L' . $kolom, number_format($sub_total, 0, ".", ","));
            $kolom++;
            $nomor++;
            }

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('K' . ((int) $kolom + 3), 'Grand Total')
            ->setCellValue('L' . ((int) $kolom + 3), number_format($grand_total, 0, ".", ","));

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
            $tgl = date('F Y');
            $tgl_judul = date('F-Y');
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:L1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:L1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Jalan Bulan '.$tgl);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup

            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Nomor')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Nama')
            ->setCellValue('D2', 'GD')
            ->setCellValue('E2', 'AU')
            ->setCellValue('F2', 'Chol')
            ->setCellValue('G2', 'BP')
            ->setCellValue('H2', 'LAB')
            ->setCellValue('I2', 'KIA')
            ->setCellValue('J2', 'UGD')
            ->setCellValue('K2', 'Apotik')
            ->setCellValue('L2', 'Total');

            $kolom = 3;
            $nomor = 1;
            $grand_total = 0;
            $sub_total = 0;
            foreach ($query as $row) {
            $tgl_pelayanan = date('d-m-Y',strtotime($row->tgl_pelayanan));
            $sub_total = $row->gula_darah + $row->asam_urat + $row->cholesterol + $row->total_bp + $row->lab_non_primer + $row->total_kia + $row->total_ugd + $row->total_obat_apotik;

            $grand_total += $sub_total;

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




            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom,$tgl_pelayanan)
            ->setCellValue('C' . $kolom, $row->nama_pasien)
            ->setCellValue('D' . $kolom, number_format($row->gula_darah, 0, ".", ","))
            ->setCellValue('E' . $kolom, number_format($row->asam_urat, 0, ".", ","))
            ->setCellValue('F' . $kolom, number_format($row->cholesterol, 0, ".", ","))
            ->setCellValue('G' . $kolom, number_format($row->total_bp, 0, ".", ","))
            ->setCellValue('H' . $kolom, number_format($row->lab_non_primer, 0, ".", ","))
            ->setCellValue('I' . $kolom, number_format($row->total_kia, 0, ".", ","))
            ->setCellValue('J' . $kolom, number_format($row->total_ugd, 0, ".", ","))
            ->setCellValue('K' . $kolom, number_format($row->total_obat_apotik, 0, ".", ","))
            ->setCellValue('L' . $kolom, number_format($sub_total, 0, ".", ","));
            $kolom++;
            $nomor++;
            }

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('K' . ((int) $kolom + 3), 'Grand Total')
            ->setCellValue('L' . ((int) $kolom + 3), number_format($grand_total, 0, ".", ","));

            $spreadsheet->getActiveSheet()->getStyle('B' . ((int) $kolom + 3) . ':C' . ((int) $kolom +
            3))->getFont()->setBold(true);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RJ_'.$tgl_judul.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');

        }
        public function rj_custom() {

            $tgl1 = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
            $tgl2 = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

            $tgl_mulai = $tgl1." 00:00:01";
            $tgl_akhir = $tgl2." 23:59:59";
            
            $tgl_header_mulai = tgl_indo($tgl1);
            $tgl_header_akhir = tgl_indo($tgl2);

            $tgl_judul_mulai = date('m-d-Y',strtotime($tgl1));
            $tgl_judul_akhir = date('m-d-Y',strtotime($tgl2));

            $query = $this->M_laporan->laporan_rj_custom($tgl_mulai,$tgl_akhir);
            $spreadsheet = new Spreadsheet();
            $spreadsheet = new Spreadsheet;
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(20);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:L1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:L1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Jalan Tanggal '.$tgl_header_mulai." sampai ".$tgl_header_akhir);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:L1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup

            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:L2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'Nomor')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Nama')
            ->setCellValue('D2', 'GD')
            ->setCellValue('E2', 'AU')
            ->setCellValue('F2', 'Chol')
            ->setCellValue('G2', 'BP')
            ->setCellValue('H2', 'LAB')
            ->setCellValue('I2', 'KIA')
            ->setCellValue('J2', 'UGD')
            ->setCellValue('K2', 'Apotik')
            ->setCellValue('L2', 'Total');

            $kolom = 3;
            $nomor = 1;
            $grand_total = 0;
            $sub_total = 0;
            foreach ($query as $row) {
            $tgl_pelayanan = date('d-m-Y',strtotime($row->tgl_pelayanan));
            $sub_total = $row->gula_darah + $row->asam_urat + $row->cholesterol + $row->total_bp + $row->lab_non_primer + $row->total_kia + $row->total_ugd + $row->total_obat_apotik;

            $grand_total += $sub_total;

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




            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A' . $kolom, $nomor)
            ->setCellValue('B' . $kolom,$tgl_pelayanan)
            ->setCellValue('C' . $kolom, $row->nama_pasien)
            ->setCellValue('D' . $kolom, number_format($row->gula_darah, 0, ".", ","))
            ->setCellValue('E' . $kolom, number_format($row->asam_urat, 0, ".", ","))
            ->setCellValue('F' . $kolom, number_format($row->cholesterol, 0, ".", ","))
            ->setCellValue('G' . $kolom, number_format($row->total_bp, 0, ".", ","))
            ->setCellValue('H' . $kolom, number_format($row->lab_non_primer, 0, ".", ","))
            ->setCellValue('I' . $kolom, number_format($row->total_kia, 0, ".", ","))
            ->setCellValue('J' . $kolom, number_format($row->total_ugd, 0, ".", ","))
            ->setCellValue('K' . $kolom, number_format($row->total_obat_apotik, 0, ".", ","))
            ->setCellValue('L' . $kolom, number_format($sub_total, 0, ".", ","));
            $kolom++;
            $nomor++;
            }

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('K' . ((int) $kolom + 3), 'Grand Total')
            ->setCellValue('L' . ((int) $kolom + 3), number_format($grand_total, 0, ".", ","));

            $spreadsheet->getActiveSheet()->getStyle('B' . ((int) $kolom + 3) . ':C' . ((int) $kolom +
            3))->getFont()->setBold(true);

            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RJ_'.$tgl_judul_mulai." sampai ".$tgl_judul_akhir.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');

        }
    
        
    }
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
    ?>
