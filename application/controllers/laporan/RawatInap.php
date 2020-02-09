<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    require('./vendor/autoload.php');

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    class RawatInap extends CI_Controller {
        function __construct()
        {
            parent::__construct();
            $this->load->model('admin/M_laporan');
            $this->load->model('M_cek_saldo');

        }

        public function index()
        {
            $yesterday = date("Y-m-d",strtotime("-1 day",strtotime(date('Y-m-d'))));
            $data['db_grand_saldo'] =  $this->M_cek_saldo->getCekSaldoByDate($yesterday);
            
            $data['ri_hari_ini'] = $this->M_laporan->laporan_ri_hari_ini();
            $data['ri_bulan_ini'] = $this->M_laporan->laporan_ri_bulan_ini();
            $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/laporan/rawat_inap',$data);
        }

        public function ri_hari_ini() {
            $ri_hari_ini= $this->M_laporan->laporan_ri_hari_ini();
            $yesterday = date("Y-m-d",strtotime("-1 day",strtotime(date('Y-m-d'))));
            $db_grand_saldo =  $this->M_cek_saldo->getCekSaldoByDate($yesterday);
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
            $spreadsheet->getActiveSheet()->mergeCells("D2:K2");
            $spreadsheet->getActiveSheet()->mergeCells("L2:L3");
            $spreadsheet->getActiveSheet()->mergeCells("M2:O2");
            $spreadsheet->getActiveSheet()->mergeCells("P2:P3");
            $spreadsheet->getActiveSheet()->mergeCells("Q2:Q3");
            $spreadsheet->getActiveSheet()->mergeCells("R2:R3");
            $spreadsheet->getActiveSheet()->mergeCells("S2:S3");
            $spreadsheet->getActiveSheet()->mergeCells("T2:T3");
            $spreadsheet->getActiveSheet()->mergeCells("U2:U3");

            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('A2', 'No')
            ->setCellValue('B2', 'Uraian')
            ->setCellValue('C2', 'Uang Masuk')
            ->setCellValue('D2', 'Pengeluaran')
            ->setCellValue('D3', 'Gizi')
            ->setCellValue('E3', 'GDA')
            ->setCellValue('F3', 'LAB')
            ->setCellValue('G3', 'AMB')
            ->setCellValue('H3', 'KIA')
            ->setCellValue('I3', 'EKG')
            ->setCellValue('J3', 'Lain2')
            ->setCellValue('K3', 'Oral')
            ->setCellValue('L2', 'Pemasukan Bersih')
            ->setCellValue('M2', 'Akomodasi')
            ->setCellValue('M3', 'Obat')
            ->setCellValue('N3', 'Alkes')
            ->setCellValue('O3', 'Lain2')
            ->setCellValue('P2', 'Sisa Hari')
            ->setCellValue('Q2', 'Japel')
            ->setCellValue('R2', 'Visite')
            ->setCellValue('S2', 'Klinik')
            ->setCellValue('T2', 'Setoran')
            ->setCellValue('U2', 'Saldo');
// E2,E3 => D2,D3
// N2,N3 => M2,M3
            $kolom = 4;
            $nomor = 1;
            //Get Saldo Kemarin
            $grand_saldo = $db_grand_saldo; //Diambil Record Hari Kemarin Dari Tabel Saldo Temp
            //Inisialisasi Grand Total
            $GT_uang_masuk = 0;
            $GT_gizi = 0;
            $GT_gda = 0;
            $GT_lab = 0;
            $GT_biaya_ambulance = 0;
            $GT_total_bp = 0;
            $GT_total_kia = 0;
            $GT_ekg = 0;
            $GT_lain_lain = 0;
            $GT_obat_oral_ri = 0;
            $GT_pemasukan_bersih = 0;
            $GT_akomodasi_obat = 0;
            $GT_akomodasi_alkes = 0;
            $GT_akomodasi_lain = 0;
            $GT_jumlah_setoran = 0;
            $GT_japel = 0;
            $GT_visite = 0;
            $GT_klinik_bersih = 0;

            //Inisisalisasi Rawat Inap
            $total_pemasukan_bersih = 0;
            $total_akomodasi = 0;
            $total_jumlah_setoran = 0;
            $nomor = 1;
            
            //Inisialisasi IGD
            $jumlah_pasien_igd = 0;
            $IGD_uang_masuk = 0;
            $IGD_gizi = 0;
            $IGD_gda = 0;
            $IGD_lab = 0;
            $IGD_biaya_ambulance = 0;
            $IGD_total_bp = 0;
            $IGD_total_kia = 0;
            $IGD_ekg = 0;
            $IGD_lain_lain = 0;
            $IGD_obat_oral_ri = 0;
            $IGD_pemasukan_bersih = 0;
            $IGD_japel = 0;
            $IGD_visite = 0;
            $IGD_klinik_bersih = 0;


            //Inisialisasi Rawat Jalan
            $jumlah_pasien_rj = 0;
            $jumlah_pasien_paket_rj = 0;

            $uang_masuk_bp_ke_ri = 5000;
            $potong_obat_oral = 3000;
            $pemasukan_bersih_bp_ke_ri = 2000;
            
            $RJ_uang_masuk = 0;
            $RJ_gizi = 0;
            $RJ_gda = 0;
            $RJ_lab = 0;
            $RJ_biaya_ambulance = 0;
            $RJ_total_bp = 0;
            $RJ_total_kia = 0;
            $RJ_ekg = 0;
            $RJ_lain_lain = 0;
            $RJ_obat_oral_ri = 0;
            $RJ_pemasukan_bersih = 0;
            $RJ_japel = 0;
            $RJ_visite = 0;
            $RJ_klinik_bersih = 0;

            //Inisialisasi Akomodasi
            $jumlah_trx_akomodasi = 0;
            $AK_akomodasi_obat = 0;
            $AK_akomodasi_alkes = 0;
            $AK_akomodasi_lain = 0;
            //Inisialisasi Setoran
            $jumlah_trx_setoran = 0;
            $SETORAN_jumlah_setoran = 0;

            foreach($ri_hari_ini as $row){
                //Validasi Value Karena Bukan Tipe Integer
                $uang_masuk = (int) $row->uang_masuk;
                $gizi_hari = (int) $row->gizi_hari;
                $gizi_porsi = (int) $row->gizi_porsi;
                $gizi = $gizi_hari + $gizi_porsi; //
                $gda = (int) $row->gda;
                $lab = (int) $row->lab;
                $biaya_ambulance = (int) $row->biaya_ambulance;
                $total_bp_paket = (int) $row->total_bp_paket;
                $total_bp_non_paket = (int) $row->total_bp_non_paket;
                $total_bp =  $total_bp_paket + $total_bp_non_paket;
                $total_kia = (int) $row->total_kia;
                $ekg = (int) $row->ekg;
                $lain_lain = (int) $row->lain_lain;
                $obat_oral_ri = (int) $row->obat_oral_ri;
                if($row->nama_pasien == ""){
                    $pemasukan_bersih = 0;
                }
                else{
                    $pemasukan_bersih = $uang_masuk - $gizi - $gda - $lab - $biaya_ambulance - $total_bp - $total_kia - $ekg - $lain_lain - $obat_oral_ri;
                }
                $akomodasi_obat = (int) $row->akomodasi_obat;
                $akomodasi_alkes = (int) $row->akomodasi_alkes;
                $akomodasi_lain = (int) $row->akomodasi_lain_lain;
                $jumlah_setoran = (int) $row->jumlah_setoran;
                $japel_hari = (int) $row->japel_hari;
                $japel_setengah = (int) $row->japel_setengah;
                $japel = $japel_hari + $japel_setengah;
                $visite = (int) $row->visite;
                $klinik_bersih = $pemasukan_bersih - $japel - $visite;

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

                if($row->tipe_pelayanan == "Rawat Inap"){

                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom, $row->nama_pasien)
                ->setCellValue('C' . $kolom, number_format($uang_masuk, 0, ".", ","))
                ->setCellValue('D' . $kolom, number_format($gizi, 0, ".", ","))
                ->setCellValue('E' . $kolom, number_format($gda, 0, ".", ","))
                ->setCellValue('F' . $kolom, number_format($lab, 0, ".", ","))
                ->setCellValue('G' . $kolom, number_format($biaya_ambulance, 0, ".", ","))
                ->setCellValue('H' . $kolom, number_format($total_kia, 0, ".", ","))
                ->setCellValue('I' . $kolom, number_format($ekg, 0, ".", ","))
                ->setCellValue('J' . $kolom, number_format($lain_lain, 0, ".", ","))
                ->setCellValue('K' . $kolom, number_format($obat_oral_ri, 0, ".", ","))
                ->setCellValue('L' . $kolom, number_format($pemasukan_bersih, 0, ".", ","))
                ->setCellValue('M' . $kolom, '')
                ->setCellValue('N' . $kolom, '')
                ->setCellValue('O' . $kolom, '')
                ->setCellValue('P' . $kolom, '')
                ->setCellValue('Q' . $kolom, number_format($japel, 0, ".", ","))
                ->setCellValue('R' . $kolom, number_format($visite, 0, ".", ","))
                ->setCellValue('S' . $kolom, number_format($klinik_bersih, 0, ".", ","))
                ->setCellValue('T' . $kolom, '')
                ->setCellValue('U' . $kolom, number_format($grand_saldo += $pemasukan_bersih, 0 , ".", ","));
                }

                else if($row->tipe_pelayanan == "IGD"){
                //Menghitung Jumlah Pasien IGD
                $jumlah_pasien_igd++;

                $IGD_uang_masuk += $uang_masuk;
                $IGD_gizi += $gizi;
                $IGD_gda += $gda;
                $IGD_lab += $lab;
                $IGD_biaya_ambulance += $biaya_ambulance;
                $IGD_total_bp += $total_bp;
                $IGD_total_kia += $total_kia;
                $IGD_ekg += $ekg;
                $IGD_lain_lain += $lain_lain;
                $IGD_obat_oral_ri += $obat_oral_ri;
                $IGD_pemasukan_bersih += $pemasukan_bersih;
                $IGD_japel += $japel;
                $IGD_visite += $visite;
                $IGD_klinik_bersih += $klinik_bersih;

                // $grand_saldo += $IGD_pemasukan_bersih;
                }

                else if($row->tipe_pelayanan == "Rawat Jalan"){ //End If IGD, Start IG Rawat Jalan
                    //Menghitung Jumlah Pasien Rawat Jalan
                    $jumlah_pasien_rj++;
                    
                    if($total_bp_paket > 0){
                        $jumlah_pasien_paket_rj++;
                        $RJ_uang_masuk += $uang_masuk_bp_ke_ri;
                        $RJ_obat_oral_ri += $potong_obat_oral;
                        $RJ_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri;
                    }

                    $RJ_uang_masuk += $uang_masuk;
                    $RJ_gizi += $gizi;
                    $RJ_gda += $gda;
                    $RJ_lab += $lab;
                    $RJ_biaya_ambulance += $biaya_ambulance;
                    $RJ_total_bp += $total_bp;
                    $RJ_total_kia += $total_kia;
                    $RJ_ekg += $ekg;
                    $RJ_lain_lain += $lain_lain;
                    $RJ_obat_oral_ri += $obat_oral_ri;
                    $RJ_pemasukan_bersih += $pemasukan_bersih;
                    $RJ_japel += $japel;
                    $RJ_visite += $visite;
                    $RJ_klinik_bersih += $klinik_bersih;

                    
                } else if($row->tipe_pelayanan == "Akomodasi"){ //End If Rawat Jalan Start Akomodasi
                    $jumlah_trx_akomodasi++;

                    $AK_akomodasi_obat += $akomodasi_obat;
                    $AK_akomodasi_alkes += $akomodasi_alkes;
                    $AK_akomodasi_lain += $akomodasi_lain;

                }else if($row->tipe_pelayanan == "Setor Uang"){
                    $jumlah_trx_setoran++;
                    $SETORAN_jumlah_setoran += $jumlah_setoran;
                }
                    //Hitung Grand Total
                    $GT_uang_masuk += $uang_masuk;
                    $GT_gizi += $gizi;
                    $GT_gda += $gda;
                    $GT_lab += $lab;
                    $GT_biaya_ambulance += $biaya_ambulance;
                    $GT_total_bp += $total_bp;
                    $GT_total_kia += $total_kia;
                    $GT_ekg += $ekg;
                    $GT_lain_lain += $lain_lain;
                    $GT_obat_oral_ri += $obat_oral_ri;
                    $GT_pemasukan_bersih += $pemasukan_bersih;
                    $GT_akomodasi_obat += $akomodasi_obat;
                    $GT_akomodasi_alkes += $akomodasi_alkes;
                    $GT_akomodasi_lain += $akomodasi_lain;
                    $GT_jumlah_setoran += $jumlah_setoran;
                    $GT_japel += $japel;
                    $GT_visite += $visite;
                    $GT_klinik_bersih += $klinik_bersih;

                $kolom++;
                $nomor++;
            }

            if($jumlah_pasien_igd > 0)
            {
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom,'IGD')
                ->setCellValue('C' . $kolom, number_format($IGD_uang_masuk, 0, ".", ","))
                ->setCellValue('D' . $kolom, number_format($IGD_gizi, 0, ".", ","))
                ->setCellValue('E' . $kolom, number_format($IGD_gda, 0, ".", ","))
                ->setCellValue('F' . $kolom, number_format($IGD_lab, 0, ".", ","))
                ->setCellValue('G' . $kolom, number_format($IGD_biaya_ambulance, 0, ".", ","))
                ->setCellValue('H' . $kolom, number_format($IGD_total_kia, 0, ".", ","))
                ->setCellValue('I' . $kolom, number_format($IGD_ekg, 0, ".", ","))
                ->setCellValue('J' . $kolom, number_format($IGD_lain_lain, 0, ".", ","))
                ->setCellValue('K' . $kolom, number_format($IGD_obat_oral_ri, 0, ".", ","))
                ->setCellValue('L' . $kolom, number_format($IGD_pemasukan_bersih, 0, ".", ","))
                ->setCellValue('M' . $kolom, '')
                ->setCellValue('N' . $kolom, '')
                ->setCellValue('O' . $kolom, '')
                ->setCellValue('P' . $kolom, '')
                ->setCellValue('Q' . $kolom, number_format($IGD_japel))
                ->setCellValue('R' . $kolom, number_format($IGD_visite, 0, ".", ","))
                ->setCellValue('S' . $kolom, number_format($IGD_klinik_bersih, 0, ".", ","))
                ->setCellValue('T' . $kolom, '')
                ->setCellValue('U' . $kolom, number_format($grand_saldo += $IGD_pemasukan_bersih, 0 , ".", ","));
            }

            if($jumlah_pasien_rj > 0)
            {
                $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $nomor)
                ->setCellValue('B' . $kolom,'BP/Rawat Inap')
                ->setCellValue('C' . $kolom, number_format($RJ_uang_masuk, 0, ".", ","))
                ->setCellValue('D' . $kolom, number_format($RJ_gizi, 0, ".", ","))
                ->setCellValue('E' . $kolom, number_format($RJ_gda, 0, ".", ","))
                ->setCellValue('F' . $kolom, number_format($RJ_lab, 0, ".", ","))
                ->setCellValue('G' . $kolom, number_format($RJ_biaya_ambulance, 0, ".", ","))
                ->setCellValue('H' . $kolom, number_format($RJ_total_kia, 0, ".", ","))
                ->setCellValue('I' . $kolom, number_format($RJ_ekg, 0, ".", ","))
                ->setCellValue('J' . $kolom, number_format($RJ_lain_lain, 0, ".", ","))
                ->setCellValue('K' . $kolom, number_format($RJ_obat_oral_ri, 0, ".", ","))
                ->setCellValue('L' . $kolom, number_format($RJ_pemasukan_bersih, 0, ".", ","))
                ->setCellValue('M' . $kolom, '')
                ->setCellValue('N' . $kolom, '')
                ->setCellValue('O' . $kolom, '')
                ->setCellValue('P' . $kolom, '')
                ->setCellValue('Q' . $kolom, number_format($RJ_japel))
                ->setCellValue('R' . $kolom, number_format($RJ_visite, 0, ".", ","))
                ->setCellValue('S' . $kolom, number_format($RJ_klinik_bersih, 0, ".", ","))
                ->setCellValue('T' . $kolom, '')
                ->setCellValue('U' . $kolom, number_format($grand_saldo += $RJ_pemasukan_bersih, 0 , ".", ","));
            }
            
            // $sisa_hari = $total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain; 
            // $spreadsheet->setActiveSheetIndex(0)
            // ->setCellValue('N' . ((int) $kolom + 0), number_format($total_akomodasi_obat, 0, ".", ","))
            // ->setCellValue('O' . ((int) $kolom + 0), number_format($total_akomodasi_alkes, 0, ".", ","))
            // ->setCellValue('P' . ((int) $kolom + 0), number_format($total_akomodasi_lain, 0, ".", ","))
            // ->setCellValue('Q' . ((int) $kolom + 0), number_format($sisa_hari, 0, ".", ","));
            // // ->setCellValue('Q' . ((int) $kolom + 0), number_format($total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain, 0, ".", ","));
    
            


            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RI_'.$tgl_judul.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            
        }

        public function ri_bulan_ini() {
            $query = $this->M_laporan->laporan_ri_bulan_ini();
            $tgl = date('F Y');
            $tgl_judul = date('F Y');
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
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Bulan '.$tgl);
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
            ->setCellValue('Q2', 'Sisa Bulan')
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
            $total_pemasukan_bersih = 0;
            $sisa_hari = 0;
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
                $total_pemasukan_bersih += $pemasukan_bersih; 

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
            
            $sisa_hari = $total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain; 
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('N' . ((int) $kolom + 0), number_format($total_akomodasi_obat, 0, ".", ","))
            ->setCellValue('O' . ((int) $kolom + 0), number_format($total_akomodasi_alkes, 0, ".", ","))
            ->setCellValue('P' . ((int) $kolom + 0), number_format($total_akomodasi_lain, 0, ".", ","))
            ->setCellValue('Q' . ((int) $kolom + 0), number_format($sisa_hari, 0, ".", ","));
            // ->setCellValue('Q' . ((int) $kolom + 0), number_format($total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain, 0, ".", ","));
    
            


            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RI_'.$tgl_judul.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            
        }

        public function ri_custom() {
            $tgl1 = date('Y-m-d',strtotime($this->input->post('tgl_mulai')));
            $tgl2 = date('Y-m-d',strtotime($this->input->post('tgl_akhir')));

            $tgl_mulai = $tgl1." 00:00:01";
            $tgl_akhir = $tgl2." 23:59:59";
            
            $tgl_header_mulai = tgl_indo($tgl1);
            $tgl_header_akhir = tgl_indo($tgl2);

            $tgl_judul_mulai = date('m-d-Y',strtotime($tgl1));
            $tgl_judul_akhir = date('m-d-Y',strtotime($tgl2));

            $query = $this->M_laporan->laporan_ri_custom($tgl_mulai,$tgl_akhir);

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
            $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Custom Rawat Inap Tanggal '.$tgl_header_mulai." sampai ".$tgl_header_akhir);
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
            ->setCellValue('Q2', 'Sisa')
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
            $total_pemasukan_bersih = 0;
            $sisa_hari = 0;
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
                $total_pemasukan_bersih += $pemasukan_bersih; 

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
            
            $sisa_hari = $total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain; 
            $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('N' . ((int) $kolom + 0), number_format($total_akomodasi_obat, 0, ".", ","))
            ->setCellValue('O' . ((int) $kolom + 0), number_format($total_akomodasi_alkes, 0, ".", ","))
            ->setCellValue('P' . ((int) $kolom + 0), number_format($total_akomodasi_lain, 0, ".", ","))
            ->setCellValue('Q' . ((int) $kolom + 0), number_format($sisa_hari, 0, ".", ","));
            // ->setCellValue('Q' . ((int) $kolom + 0), number_format($total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain, 0, ".", ","));
    
            


            $writer = new Xlsx($spreadsheet);

            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment;filename="RI_'.$tgl_judul_mulai." sampai ".$tgl_judul_akhir.'.xlsx"');
            header('Cache-Control: max-age=0');

            $writer->save('php://output');
            
        }
    
        
    }
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
    ?>
