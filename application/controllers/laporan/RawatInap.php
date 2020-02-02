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
            // date_default_timezone_set('Asia/Jakarta');

        }

        public function index()
        {
            $data['ri_hari_ini'] = $this->M_laporan->laporan_ri_hari_ini();
            $data['ri_bulan_ini'] = $this->M_laporan->laporan_ri_bulan_ini();
            $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/laporan/rawat_inap',$data);
        }

        public function ri_hari_ini() {
            $query = $this->M_laporan->laporan_ri_hari_ini();
            $tgl = tgl_indo(date('Y-m-d'));
            $tgl_judul = date('d-m-Y');
            $spreadsheet = new Spreadsheet();
            $spreadsheet = new Spreadsheet;
            // Mengatur Lebar Kolom
            $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(12);
            $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(15);
            $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(17);
            $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(10);
            $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(15);

            $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
            // Atur Judul
            $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle("A1:U1")->getFont()->setSize(20);
            $spreadsheet->getActiveSheet()->getStyle('A1:U1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
            $spreadsheet->getActiveSheet()->mergeCells("A1:U1");
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Tanggal '.$tgl);
            $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A1:U1')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A1:U1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // tutup

            $spreadsheet->getActiveSheet()->getStyle('A2:U3')
            ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
            $spreadsheet->getActiveSheet()->getStyle('A2:U3')->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('006400');
            $spreadsheet->getActiveSheet()->getStyle('A2:U3')->getFont()->setBold(true);
            $spreadsheet->getActiveSheet()->getStyle('A2:U3')->getAlignment()->setHorizontal('center');
            $spreadsheet->getActiveSheet()->getStyle('A2:U3')
            ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
            $spreadsheet->getActiveSheet()->getStyle('A2:U3')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            // Border
            $spreadsheet->getActiveSheet()->getStyle('A2:U3')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            $spreadsheet->getActiveSheet()->mergeCells("A2:A3");
            $spreadsheet->getActiveSheet()->mergeCells("B2:B3");
            $spreadsheet->getActiveSheet()->mergeCells("C2:C3");
            $spreadsheet->getActiveSheet()->mergeCells("D2:D3");
            $spreadsheet->getActiveSheet()->mergeCells("E2:L2");
            $spreadsheet->getActiveSheet()->mergeCells("M2:M3");
            $spreadsheet->getActiveSheet()->mergeCells("N2:P2");
            $spreadsheet->getActiveSheet()->mergeCells("Q2:Q3");
            $spreadsheet->getActiveSheet()->mergeCells("R2:R3");
            $spreadsheet->getActiveSheet()->mergeCells("S2:S3");
            $spreadsheet->getActiveSheet()->mergeCells("T2:T3");
            $spreadsheet->getActiveSheet()->mergeCells("U2:U3");

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'No')
            ->setCellValue('B2', 'Tanggal')
            ->setCellValue('C2', 'Uraian')
            ->setCellValue('D2', 'Uang Masuk')
            ->setCellValue('E2', 'Pengeluaran')
            ->setCellValue('E3', 'Gizi')
            ->setCellValue('F3', 'GDA')
            ->setCellValue('G3', 'LAB')
            ->setCellValue('H3', 'AMB')
            ->setCellValue('I3', 'KIA')
            ->setCellValue('J3', 'EKG')
            ->setCellValue('K3', 'Lain2')
            ->setCellValue('L3', 'Oral')
            ->setCellValue('M2', 'Pemasukan Bersih')
            ->setCellValue('N2', 'Akomodasi')
            ->setCellValue('N3', 'Obat')
            ->setCellValue('O3', 'Alkes')
            ->setCellValue('P3', 'Lain2')
            ->setCellValue('Q2', 'Sisa Hari')
            ->setCellValue('R2', 'Japel')
            ->setCellValue('S2', 'Visite')
            ->setCellValue('T2', 'Klinik')
            ->setCellValue('U2', 'Saldo');

            $kolom = 4;
            $nomor = 1;
            $pemasukan_bersih = 0;
            $klinik_bersih = 0;
            $gizi = 0;
            $japel = 0;
            $total_akomodasi_obat = 0;
            $total_akomodasi_alkes = 0;
            $total_akomodasi_lain = 0;
            $total_klinik_bersih = 0;
            foreach ($query as $row) {
                $tgl_keluar = date('d-m-Y',strtotime($row->tgl_keluar));

                if($row->gizi_hari == "" || $row->gizi_hari == NULL)
                {
                    $row->gizi_hari = 0;
                }
                if($row->gizi_porsi == "" || $row->gizi_porsi == NULL)
                {
                    $row->gizi_porsi = 0;
                }
                $gizi = $row->gizi_hari + $row->gizi_porsi;

                if($row->gda == "" || $row->gda == NULL)
                {
                    $row->gda = 0;
                }

                if($row->lab == "" || $row->lab == NULL)
                {
                    $row->lab = 0;
                }

                if($row->biaya_ambulance == "" || $row->biaya_ambulance == NULL)
                {
                    $row->biaya_ambulance = 0;
                }

                if($row->total_kia == "" || $row->total_kia == NULL)
                {
                    $row->total_kia = 0;
                }

                if($row->ekg == "" || $row->ekg == NULL)
                {
                    $row->ekg = 0;
                }

                if($row->lain_lain == "" || $row->lain_lain == NULL)
                {
                    $row->lain_lain = 0;
                }

                if($row->obat_oral_ri == "" || $row->obat_oral_ri == NULL)
                {
                    $obat_oral = 0;
                }
                else 
                {
                    $obat_oral = (int) $row->obat_oral_ri;
                }
                

                if($row->nama_pasien == "")
                {
                    $pemasukan_bersih = 0;
                }
                else{
                    $pemasukan_bersih = $row->uang_masuk - $gizi - $row->gda - $row->lab - $row->biaya_ambulance -  $row->total_kia - $row->ekg - $row->lain_lain - $obat_oral;
                }

                if($row->japel_hari == "" || $row->japel_hari == NULL)
                {
                    $row->japel_hari = 0;
                }
                if($row->japel_setengah == "" || $row->japel_setengah == NULL)
                {
                    $row->japel_setengah = 0;
                }
                $japel = $row->japel_hari + $row->japel_setengah;

                if($row->visite == "" || $row->visite == NULL)
                {
                    $row->visite = 0;
                }

                if($row->akomodasi_obat == "" || $row->akomodasi_obat == NULL)
                {
                    $row->akomodasi_obat = 0;
                }

                if($row->akomodasi_alkes == "" || $row->akomodasi_alkes == NULL)
                {
                    $row->akomodasi_alkes = 0;
                }

                if($row->akomodasi_lain_lain == "" || $row->akomodasi_lain_lain == NULL)
                {
                    $row->akomodasi_lain_lain = 0;
                }
                $klinik_bersih = $pemasukan_bersih - $japel - $row->visite;

                $total_akomodasi_obat += $row->akomodasi_obat;
                $total_akomodasi_alkes += $row->akomodasi_alkes;
                $total_akomodasi_lain += $row->akomodasi_lain_lain;
                // $total_klinik_bersih += $klinik_bersih; 

                // // di dalam loop
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
                $spreadsheet->getActiveSheet()->getStyle('S')->getAlignment()->setHorizontal('right');
                $spreadsheet->getActiveSheet()->getStyle('T')->getAlignment()->setHorizontal('right');
                $spreadsheet->getActiveSheet()->getStyle('U')->getAlignment()->setHorizontal('right');
            
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom,$tgl_keluar)
                ->setCellValue('C' . $kolom, $row->nama_pasien)
                ->setCellValue('D' . $kolom, number_format($row->uang_masuk, 0, ".", ","))
                ->setCellValue('E' . $kolom, number_format($gizi, 0, ".", ","))
                ->setCellValue('F' . $kolom, number_format($row->gda, 0, ".", ","))
                ->setCellValue('G' . $kolom, number_format($row->lab, 0, ".", ","))
                ->setCellValue('H' . $kolom, number_format($row->biaya_ambulance, 0, ".", ","))
                ->setCellValue('I' . $kolom, number_format($row->total_kia, 0, ".", ","))
                ->setCellValue('J' . $kolom, number_format($row->ekg, 0, ".", ","))
                ->setCellValue('K' . $kolom, number_format($row->lain_lain, 0, ".", ","))
                ->setCellValue('L' . $kolom, number_format($obat_oral, 0, ".", ","))
                ->setCellValue('M' . $kolom, number_format($pemasukan_bersih, 0, ".", ","))
                ->setCellValue('N' . $kolom, number_format($row->akomodasi_obat, 0, ".", ","))
                ->setCellValue('O' . $kolom, number_format($row->akomodasi_alkes, 0, ".", ","))
                ->setCellValue('P' . $kolom, number_format($row->akomodasi_lain_lain, 0, ".", ","))
                ->setCellValue('Q' . $kolom, '')
                ->setCellValue('R' . $kolom, number_format($japel, 0, ".", ","))
                ->setCellValue('S' . $kolom, number_format($row->visite, 0, ".", ","))
                ->setCellValue('T' . $kolom, number_format($klinik_bersih, 0, ".", ","))
                ->setCellValue('U' . $kolom, number_format($row->saldo, 0 , ".", ","));
                $kolom++;
                $nomor++;
                }

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('N' . ((int) $kolom + 0), number_format($total_akomodasi_obat, 0, ".", ","))
            ->setCellValue('O' . ((int) $kolom + 0), number_format($total_akomodasi_alkes, 0, ".", ","))
            ->setCellValue('P' . ((int) $kolom + 0), number_format($total_akomodasi_lain, 0, ".", ","));
    
            


            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RI_'.$tgl_judul.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            
        }

        // public function ri_bulan_ini(){
        //     $query = $this->M_laporan->laporan_ri_bulan_ini();

        //     $tgl = date('F Y');
        //     $tgl_judul = date('F-Y');
        //     $spreadsheet = new Spreadsheet();
        //     $spreadsheet = new Spreadsheet;
        //     // Mengatur Lebar Kolom
        //     $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(15);

        //     $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
        //     // Atur Judul
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true);
        //     $spreadsheet->getActiveSheet()->getStyle("A1:R1")->getFont()->setSize(20);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')
        //     ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        //     $spreadsheet->getActiveSheet()->mergeCells("A1:R1");
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Bulan '.$tgl);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')
        //     ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')
        //     ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        //     // tutup
            


        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')
        //     ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getFill()
        //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        //     ->getStartColor()->setARGB('006400');
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getFont()->setBold(true);
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')
        //     ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')
        //     ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        //     // Border
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;

            

        //     $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('A2', 'Nomor')
        //     ->setCellValue('B2', 'Tanggal')
        //     ->setCellValue('C2', 'Nama')
        //     ->setCellValue('D2', 'Pengeluaran')
        //     ->setCellValue('E2', 'Uang Makan/Gizi')
        //     ->setCellValue('F2', 'Kamar')
        //     ->setCellValue('G2', 'BP')
        //     ->setCellValue('H2', 'LAB')
        //     ->setCellValue('I2', 'KIA')
        //     ->setCellValue('J2', 'UGD')
        //     ->setCellValue('K2', 'Ambulance')
        //     ->setCellValue('L2', 'Semua Obat')
        //     ->setCellValue('M2', 'Obat Oral')
        //     ->setCellValue('N2', 'Pemasukan Bersih')
        //     ->setCellValue('O2', 'Japel')
        //     ->setCellValue('P2', 'Visite')
        //     ->setCellValue('Q2', 'Klinik Bersih')
        //     ->setCellValue('R2', 'Saldo');

        //     $kolom = 3;
        //     $nomor = 1;
        //     $pemasukan_bersih = 0;
        //     $gizi = 0;
        //     $japel = 0;
        //     foreach ($query as $row) {
        //     $gizi = $row->gizi_hari + $row->gizi_porsi;
        //     $japel = $row->japel_hari + $row->japel_setengah;
        //     $tgl_keluar = date('d-m-Y',strtotime($row->tgl_keluar));
        //     $semua_obat = $row->obat_ri + $row->obat_apotik;
        //     $obat_oral = (int) $row->obat_oral;
        //     $pemasukan_bersih = $row->uang_masuk - $gizi - $row->kamar - $row->total_bp - $row->total_lab - $row->total_kia - $row->total_ugd - $row->biaya_ambulance - $semua_obat - $obat_oral;
        //     $klinik_bersih = $pemasukan_bersih - $japel - $row->visite;
        //     // di dalam loop
        //     $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('left');
        //     $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('O')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('P')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal('right');
        
        //     $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('A' . $kolom, $nomor)
        //     ->setCellValue('B' . $kolom,$tgl_keluar)
        //     ->setCellValue('C' . $kolom, $row->nama_pasien)
        //     ->setCellValue('D' . $kolom, number_format($row->uang_masuk, 0, ".", ","))
        //     ->setCellValue('E' . $kolom, number_format($gizi, 0, ".", ","))
        //     ->setCellValue('F' . $kolom, number_format($row->kamar, 0, ".", ","))
        //     ->setCellValue('G' . $kolom, number_format($row->total_bp, 0, ".", ","))
        //     ->setCellValue('H' . $kolom, number_format($row->total_lab, 0, ".", ","))
        //     ->setCellValue('I' . $kolom, number_format($row->total_kia, 0, ".", ","))
        //     ->setCellValue('J' . $kolom, number_format($row->total_ugd, 0, ".", ","))
        //     ->setCellValue('K' . $kolom, number_format($row->biaya_ambulance, 0, ".", ","))
        //     ->setCellValue('L' . $kolom, number_format($semua_obat, 0, ".", ","))
        //     ->setCellValue('M' . $kolom, number_format($obat_oral, 0, ".", ","))
        //     ->setCellValue('N' . $kolom, number_format($pemasukan_bersih, 0, ".", ","))
        //     ->setCellValue('O' . $kolom, number_format($japel, 0, ".", ","))
        //     ->setCellValue('P' . $kolom, number_format($row->visite, 0, ".", ","))
        //     ->setCellValue('Q' . $kolom, number_format($klinik_bersih, 0, ".", ","))
        //     ->setCellValue('R' . $kolom, number_format($row->saldo, 0, ".", ","));
        //     $kolom++;
        //     $nomor++;
        //     }


        //     $writer = new Xlsx($spreadsheet);

        //     header('Content-Type: application/vnd.ms-excel');
        //     header('Content-Disposition: attachment;filename="RI_'.$tgl_judul.'.xlsx"');
        //     header('Cache-Control: max-age=0');

        //     $writer->save('php://output');
        // }

        // public function ri_custom(){
        //     $tgl1 = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
        //     $tgl2 = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

        //     $tgl_mulai = $tgl1." 00:00:01";
        //     $tgl_akhir = $tgl2." 23:59:59";
            
        //     $tgl_header_mulai = tgl_indo($tgl1);
        //     $tgl_header_akhir = tgl_indo($tgl2);

        //     $tgl_judul_mulai = date('m-d-Y',strtotime($tgl1));
        //     $tgl_judul_akhir = date('m-d-Y',strtotime($tgl2));

        //     $query = $this->M_laporan->laporan_ri_custom($tgl_mulai,$tgl_akhir);

        //     $tgl = tgl_indo(date('Y-m-d'));
        //     $tgl_judul = date('d-m-Y');
        //     $spreadsheet = new Spreadsheet();
        //     $spreadsheet = new Spreadsheet;
        //     // Mengatur Lebar Kolom
        //     $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
        //     $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(15);

        //     $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
        //     // Atur Judul
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true);
        //     $spreadsheet->getActiveSheet()->getStyle("A1:R1")->getFont()->setSize(20);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')
        //     ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        //     $spreadsheet->getActiveSheet()->mergeCells("A1:R1");
        //     $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Tanggal '.$tgl_header_mulai." sampai ".$tgl_header_akhir);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getFont()->setBold(true);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')
        //     ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //     $spreadsheet->getActiveSheet()->getStyle('A1:R1')
        //     ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        //     // tutup


        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')
        //     ->getFont()->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_WHITE);
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getFill()
        //     ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        //     ->getStartColor()->setARGB('006400');
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getFont()->setBold(true);
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')
        //     ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')
        //     ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);

        //     // Border
        //     $spreadsheet->getActiveSheet()->getStyle('A2:R2')->getBorders()->getallBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THICK)->getColor()->setARGB(\PhpOffice\PhpSpreadsheet\Style\Color::COLOR_BLACK);;


        //     $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('A2', 'Nomor')
        //     ->setCellValue('B2', 'Tanggal')
        //     ->setCellValue('C2', 'Nama')
        //     ->setCellValue('D2', 'Uang Masuk')
        //     ->setCellValue('E2', 'Uang Makan/Gizi')
        //     ->setCellValue('F2', 'Kamar')
        //     ->setCellValue('G2', 'BP')
        //     ->setCellValue('H2', 'LAB')
        //     ->setCellValue('I2', 'KIA')
        //     ->setCellValue('J2', 'UGD')
        //     ->setCellValue('K2', 'Ambulance')
        //     ->setCellValue('L2', 'Semua Obat')
        //     ->setCellValue('M2', 'Obat Oral')
        //     ->setCellValue('N2', 'Pemasukan Bersih')
        //     ->setCellValue('O2', 'Japel')
        //     ->setCellValue('P2', 'Visite')
        //     ->setCellValue('Q2', 'Klinik Bersih')
        //     ->setCellValue('R2', 'Saldo');

        //     $kolom = 3;
        //     $nomor = 1;
        //     $pemasukan_bersih = 0;
        //     $gizi = 0;
        //     $japel = 0;
        //     foreach ($query as $row) {
        //     $gizi = $row->gizi_hari + $row->gizi_porsi;
        //     $japel = $row->japel_hari + $row->japel_setengah;
        //     $tgl_keluar = date('d-m-Y',strtotime($row->tgl_keluar));
        //     $semua_obat = $row->obat_ri + $row->obat_apotik;
        //     $obat_oral = (int) $row->obat_oral;
        //     $pemasukan_bersih = $row->uang_masuk - $gizi - $row->kamar - $row->total_bp - $row->total_lab - $row->total_kia - $row->total_ugd - $row->biaya_ambulance - $semua_obat - $obat_oral;
        //     $klinik_bersih = $pemasukan_bersih - $japel - $row->visite;
        //     // di dalam loop
        //     $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('center');
        //     $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('left');
        //     $spreadsheet->getActiveSheet()->getStyle('D')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('E')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('F')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('G')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('H')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('I')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('J')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('K')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('L')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('M')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('N')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('O')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('P')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('Q')->getAlignment()->setHorizontal('right');
        //     $spreadsheet->getActiveSheet()->getStyle('R')->getAlignment()->setHorizontal('right');
        
        //     $spreadsheet->setActiveSheetIndex(0)
        //     ->setCellValue('A' . $kolom, $nomor)
        //     ->setCellValue('B' . $kolom,$tgl_keluar)
        //     ->setCellValue('C' . $kolom, $row->nama_pasien)
        //     ->setCellValue('D' . $kolom, number_format($row->uang_masuk, 0, ".", ","))
        //     ->setCellValue('E' . $kolom, number_format($gizi, 0, ".", ","))
        //     ->setCellValue('F' . $kolom, number_format($row->kamar, 0, ".", ","))
        //     ->setCellValue('G' . $kolom, number_format($row->total_bp, 0, ".", ","))
        //     ->setCellValue('H' . $kolom, number_format($row->total_lab, 0, ".", ","))
        //     ->setCellValue('I' . $kolom, number_format($row->total_kia, 0, ".", ","))
        //     ->setCellValue('J' . $kolom, number_format($row->total_ugd, 0, ".", ","))
        //     ->setCellValue('K' . $kolom, number_format($row->biaya_ambulance, 0, ".", ","))
        //     ->setCellValue('L' . $kolom, number_format($semua_obat, 0, ".", ","))
        //     ->setCellValue('M' . $kolom, number_format($obat_oral, 0, ".", ","))
        //     ->setCellValue('N' . $kolom, number_format($pemasukan_bersih, 0, ".", ","))
        //     ->setCellValue('O' . $kolom, number_format($japel, 0, ".", ","))
        //     ->setCellValue('P' . $kolom, number_format($row->visite, 0, ".", ","))
        //     ->setCellValue('Q' . $kolom, number_format($klinik_bersih, 0, ".", ","))
        //     ->setCellValue('R' . $kolom, number_format($row->saldo, 0, ".", ","));
        //     $kolom++;
        //     $nomor++;
        //     }


        //     $writer = new Xlsx($spreadsheet);

        //     header('Content-Type: application/vnd.ms-excel');
        //     header('Content-Disposition: attachment;filename="RI_'.$tgl_judul_mulai." sampai ".$tgl_judul_akhir.'.xlsx"');
        //     header('Cache-Control: max-age=0');

        //     $writer->save('php://output');
        // }
    
        
    }
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
    ?>
