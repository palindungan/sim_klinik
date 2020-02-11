<?php
defined('BASEPATH') or exit('No direct script access allowed');
require('./vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class RawatInap extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('admin/M_laporan');
        $this->load->model('M_cek_saldo');
    }

    public function index()
    {
        //Harian
        $day = date("Y-m-d"); //Tanggal Hari ini
        $yesterday = date("Y-m-d", strtotime("-1 day", strtotime(date('Y-m-d'))));
        $data['db_grand_saldo'] =  $this->M_cek_saldo->getCekSaldoByDate($yesterday);
        $data['ri_harian'] = $this->M_laporan->laporan_ri_harian($day);

        //Bulanan
        $data['data_bulanan'] = array();
        $data['ri_bulanan'] = array();
        $date_month = strtotime(date('Y-m-01'));
        $last_date_month = strtotime(date('Y-m-t'));
        while ($date_month <= $last_date_month) {
            //Mendapatkan Saldo Terakhir Untuk Perhitungan Hari ini
            $day = date("Y-m-d", $date_month); //Tanggal Hari ini
            $yesterday = date("Y-m-d", strtotime("-1 day", $date_month)); //Tanggal Kemarin
            $data['data_bulanan'][$day] = $this->M_cek_saldo->getCekSaldoByDate($yesterday); //Untuk Perhitungan Hari ini, maka dibutuhkan saldo kemarin
            $data['ri_bulanan'][$day] = $this->M_laporan->laporan_ri_harian($day);
            $date_month = strtotime("+1 day", $date_month);
        }
        $this->template->load('sim_klinik/template/full_template', 'sim_klinik/konten/laporan/rawat_inap', $data);
    }

    public function ri_hari_ini()
    {
        $day = date("Y-m-d"); //Tanggal Hari ini
        $ri_hari_ini = $this->M_laporan->laporan_ri_harian($day);
        $yesterday = date("Y-m-d", strtotime("-1 day", strtotime(date('Y-m-d'))));
        $db_grand_saldo =  $this->M_cek_saldo->getCekSaldoByDate($yesterday);
        $tgl = tgl_indo(date('Y-m-d'));
        $tgl_judul = date('d-m-Y');
        $spreadsheet = new Spreadsheet();
        $spreadsheet = new Spreadsheet;
        // Mengatur Lebar Kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(17);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(15);

        $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
        // Atur Judul
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("A1:U1")->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $spreadsheet->getActiveSheet()->mergeCells("A1:U1");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Tanggal ' . $tgl);
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

        foreach ($ri_hari_ini as $row) {
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

            if ($row->nama_pasien == "") {
                $pemasukan_bersih = 0;
            } else {
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
            $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('left');
            $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('right');
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

            if ($row->tipe_pelayanan == "Rawat Inap") {

                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor++)
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
                    ->setCellValue('U' . $kolom, number_format($grand_saldo += $pemasukan_bersih, 0, ".", ","));
                $kolom++;
            } else if ($row->tipe_pelayanan == "IGD") {
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
            } else if ($row->tipe_pelayanan == "Rawat Jalan") { //End If IGD, Start IG Rawat Jalan
                //Menghitung Jumlah Pasien Rawat Jalan
                $jumlah_pasien_rj++;

                if ($total_bp_paket > 0) {
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
            } else if ($row->tipe_pelayanan == "Akomodasi") { //End If Rawat Jalan Start Akomodasi
                $jumlah_trx_akomodasi++;

                $AK_akomodasi_obat += $akomodasi_obat;
                $AK_akomodasi_alkes += $akomodasi_alkes;
                $AK_akomodasi_lain += $akomodasi_lain;
            } else if ($row->tipe_pelayanan == "Setor Uang") {
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
        }

        if ($jumlah_pasien_igd > 0) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . ((int) $kolom + 0), $nomor++)
                ->setCellValue('B' . ((int) $kolom + 0), 'IGD')
                ->setCellValue('C' . ((int) $kolom + 0), number_format($IGD_uang_masuk, 0, ".", ","))
                ->setCellValue('D' . ((int) $kolom + 0), number_format($IGD_gizi, 0, ".", ","))
                ->setCellValue('E' . ((int) $kolom + 0), number_format($IGD_gda, 0, ".", ","))
                ->setCellValue('F' . ((int) $kolom + 0), number_format($IGD_lab, 0, ".", ","))
                ->setCellValue('G' . ((int) $kolom + 0), number_format($IGD_biaya_ambulance, 0, ".", ","))
                ->setCellValue('H' . ((int) $kolom + 0), number_format($IGD_total_kia, 0, ".", ","))
                ->setCellValue('I' . ((int) $kolom + 0), number_format($IGD_ekg, 0, ".", ","))
                ->setCellValue('J' . ((int) $kolom + 0), number_format($IGD_lain_lain, 0, ".", ","))
                ->setCellValue('K' . ((int) $kolom + 0), number_format($IGD_obat_oral_ri, 0, ".", ","))
                ->setCellValue('L' . ((int) $kolom + 0), number_format($IGD_pemasukan_bersih, 0, ".", ","))
                ->setCellValue('M' . ((int) $kolom + 0), '')
                ->setCellValue('N' . ((int) $kolom + 0), '')
                ->setCellValue('O' . ((int) $kolom + 0), '')
                ->setCellValue('P' . ((int) $kolom + 0), '')
                ->setCellValue('Q' . ((int) $kolom + 0), number_format($IGD_japel, 0, ".", ","))
                ->setCellValue('R' . ((int) $kolom + 0), number_format($IGD_visite, 0, ".", ","))
                ->setCellValue('S' . ((int) $kolom + 0), number_format($IGD_klinik_bersih, 0, ".", ","))
                ->setCellValue('T' . ((int) $kolom + 0), '')
                ->setCellValue('U' . ((int) $kolom + 0), number_format($grand_saldo += $IGD_pemasukan_bersih, 0, ".", ","));
        }

        if ($jumlah_pasien_rj > 0) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . ((int) $kolom + 1), $nomor++)
                ->setCellValue('B' . ((int) $kolom + 1), 'BP/Rawat Inap')
                ->setCellValue('C' . ((int) $kolom + 1), number_format($RJ_uang_masuk, 0, ".", ","))
                ->setCellValue('D' . ((int) $kolom + 1), number_format($RJ_gizi, 0, ".", ","))
                ->setCellValue('E' . ((int) $kolom + 1), number_format($RJ_gda, 0, ".", ","))
                ->setCellValue('F' . ((int) $kolom + 1), number_format($RJ_lab, 0, ".", ","))
                ->setCellValue('G' . ((int) $kolom + 1), number_format($RJ_biaya_ambulance, 0, ".", ","))
                ->setCellValue('H' . ((int) $kolom + 1), number_format($RJ_total_kia, 0, ".", ","))
                ->setCellValue('I' . ((int) $kolom + 1), number_format($RJ_ekg, 0, ".", ","))
                ->setCellValue('J' . ((int) $kolom + 1), number_format($RJ_lain_lain, 0, ".", ","))
                ->setCellValue('K' . ((int) $kolom + 1), number_format($RJ_obat_oral_ri, 0, ".", ","))
                ->setCellValue('L' . ((int) $kolom + 1), number_format($RJ_pemasukan_bersih, 0, ".", ","))
                ->setCellValue('M' . ((int) $kolom + 1), '')
                ->setCellValue('N' . ((int) $kolom + 1), '')
                ->setCellValue('O' . ((int) $kolom + 1), '')
                ->setCellValue('P' . ((int) $kolom + 1), '')
                ->setCellValue('Q' . ((int) $kolom + 1), number_format($RJ_japel, 0, ".", ","))
                ->setCellValue('R' . ((int) $kolom + 1), number_format($RJ_visite, 0, ".", ","))
                ->setCellValue('S' . ((int) $kolom + 1), number_format($RJ_klinik_bersih, 0, ".", ","))
                ->setCellValue('T' . ((int) $kolom + 1), '')
                ->setCellValue('U' . ((int) $kolom + 1), number_format($grand_saldo += $RJ_pemasukan_bersih, 0, ".", ","));
        }

        if ($jumlah_trx_akomodasi > 0) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . ((int) $kolom + 2), $nomor++)
                ->setCellValue('B' . ((int) $kolom + 2), 'Akomodasi')
                ->setCellValue('C' . ((int) $kolom + 2), '')
                ->setCellValue('D' . ((int) $kolom + 2), '')
                ->setCellValue('E' . ((int) $kolom + 2), '')
                ->setCellValue('F' . ((int) $kolom + 2), '')
                ->setCellValue('G' . ((int) $kolom + 2), '')
                ->setCellValue('H' . ((int) $kolom + 2), '')
                ->setCellValue('I' . ((int) $kolom + 2), '')
                ->setCellValue('J' . ((int) $kolom + 2), '')
                ->setCellValue('K' . ((int) $kolom + 2), '')
                ->setCellValue('L' . ((int) $kolom + 2), '')
                ->setCellValue('M' . ((int) $kolom + 2), number_format($AK_akomodasi_obat, 0, ".", ","))
                ->setCellValue('N' . ((int) $kolom + 2), number_format($AK_akomodasi_alkes, 0, ".", ","))
                ->setCellValue('O' . ((int) $kolom + 2), number_format($AK_akomodasi_lain, 0, ".", ","))
                ->setCellValue('P' . ((int) $kolom + 2), '')
                ->setCellValue('Q' . ((int) $kolom + 2), '')
                ->setCellValue('R' . ((int) $kolom + 2), '')
                ->setCellValue('S' . ((int) $kolom + 2), '')
                ->setCellValue('T' . ((int) $kolom + 2), '')
                ->setCellValue('U' . ((int) $kolom + 2), number_format($grand_saldo -= ($AK_akomodasi_obat + $AK_akomodasi_alkes + $AK_akomodasi_lain), 0, ".", ","));
        }

        if ($jumlah_trx_setoran > 0) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . ((int) $kolom + 3), 'SETORAN')
                ->setCellValue('C' . ((int) $kolom + 3), '')
                ->setCellValue('D' . ((int) $kolom + 3), '')
                ->setCellValue('E' . ((int) $kolom + 3), '')
                ->setCellValue('F' . ((int) $kolom + 3), '')
                ->setCellValue('G' . ((int) $kolom + 3), '')
                ->setCellValue('H' . ((int) $kolom + 3), '')
                ->setCellValue('I' . ((int) $kolom + 3), '')
                ->setCellValue('J' . ((int) $kolom + 3), '')
                ->setCellValue('K' . ((int) $kolom + 3), '')
                ->setCellValue('L' . ((int) $kolom + 3), '')
                ->setCellValue('M' . ((int) $kolom + 3), '')
                ->setCellValue('N' . ((int) $kolom + 3), '')
                ->setCellValue('O' . ((int) $kolom + 3), '')
                ->setCellValue('P' . ((int) $kolom + 3), '')
                ->setCellValue('Q' . ((int) $kolom + 3), '')
                ->setCellValue('R' . ((int) $kolom + 3), '')
                ->setCellValue('S' . ((int) $kolom + 3), '')
                ->setCellValue('T' . ((int) $kolom + 3), number_format($SETORAN_jumlah_setoran, 0, ".", ","))
                ->setCellValue('U' . ((int) $kolom + 3), number_format($grand_saldo -= $SETORAN_jumlah_setoran, 0, ".", ","));
        }

        for ($i = 0; $i < $jumlah_pasien_paket_rj; $i++) {
            $GT_uang_masuk += $uang_masuk_bp_ke_ri;
            $GT_obat_oral_ri += $potong_obat_oral;
            $GT_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri;
        }

        $spreadsheet->setActiveSheetIndex(0)
            ->setCellValue('B' . ((int) $kolom + 4), 'TOTAL')
            ->setCellValue('C' . ((int) $kolom + 4), number_format($GT_uang_masuk, 0, ".", ","))
            ->setCellValue('D' . ((int) $kolom + 4), number_format($GT_gizi, 0, ".", ","))
            ->setCellValue('E' . ((int) $kolom + 4), number_format($GT_gda, 0, ".", ","))
            ->setCellValue('F' . ((int) $kolom + 4), number_format($GT_lab, 0, ".", ","))
            ->setCellValue('G' . ((int) $kolom + 4), number_format($GT_biaya_ambulance, 0, ".", ","))
            ->setCellValue('H' . ((int) $kolom + 4), number_format($GT_total_kia, 0, ".", ","))
            ->setCellValue('I' . ((int) $kolom + 4), number_format($GT_ekg, 0, ".", ","))
            ->setCellValue('J' . ((int) $kolom + 4), number_format($GT_lain_lain, 0, ".", ","))
            ->setCellValue('K' . ((int) $kolom + 4), number_format($GT_obat_oral_ri, 0, ".", ","))
            ->setCellValue('L' . ((int) $kolom + 4), number_format($GT_pemasukan_bersih, 0, ".", ","))
            ->setCellValue('M' . ((int) $kolom + 4), number_format($GT_akomodasi_obat, 0, ".", ","))
            ->setCellValue('N' . ((int) $kolom + 4), number_format($GT_akomodasi_alkes, 0, ".", ","))
            ->setCellValue('O' . ((int) $kolom + 4), number_format($GT_akomodasi_lain, 0, ".", ","))
            ->setCellValue('P' . ((int) $kolom + 4), number_format($grand_saldo, 0, ".", ","))
            ->setCellValue('Q' . ((int) $kolom + 4), number_format($GT_japel, 0, ".", ","))
            ->setCellValue('R' . ((int) $kolom + 4), number_format($GT_visite, 0, ".", ","))
            ->setCellValue('S' . ((int) $kolom + 4), number_format($GT_klinik_bersih, 0, ".", ","))
            ->setCellValue('T' . ((int) $kolom + 4), number_format($GT_jumlah_setoran, 0, ".", ","))
            ->setCellValue('U' . ((int) $kolom + 4), '');


        // $sisa_hari = $total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain; 
        // $spreadsheet->setActiveSheetIndex(0)
        // ->setCellValue('N' . ((int) $kolom + 0), number_format($total_akomodasi_obat, 0, ".", ","))
        // ->setCellValue('O' . ((int) $kolom + 0), number_format($total_akomodasi_alkes, 0, ".", ","))
        // ->setCellValue('P' . ((int) $kolom + 0), number_format($total_akomodasi_lain, 0, ".", ","))
        // ->setCellValue('Q' . ((int) $kolom + 0), number_format($sisa_hari, 0, ".", ","));
        // // ->setCellValue('Q' . ((int) $kolom + 0), number_format($total_pemasukan_bersih - $total_akomodasi_obat - $total_akomodasi_alkes -$total_akomodasi_lain, 0, ".", ","));



        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RI_' . $tgl_judul . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function ri_bulan_ini()
    {

        // $day = date("Y-m-d"); //Tanggal Hari ini
        // $ri_hari_ini = $this->M_laporan->laporan_ri_harian($day);
        $yesterday = date("Y-m-d", strtotime("-1 day", strtotime(date('Y-m-d'))));
        $db_grand_saldo =  $this->M_cek_saldo->getCekSaldoByDate($yesterday);
        // Bulanan
        $data_bulanan = array();
        $ri_bulanan = array();
        $date_month = strtotime(date('Y-m-01'));
        $last_date_month = strtotime(date('Y-m-t'));
        while ($date_month <= $last_date_month) {
            //Mendapatkan Saldo Terakhir Untuk Perhitungan Hari ini
            $day = date("Y-m-d", $date_month); //Tanggal Hari ini
            $yesterday = date("Y-m-d", strtotime("-1 day", $date_month)); //Tanggal Kemarin
            $data_bulanan[$day] = $this->M_cek_saldo->getCekSaldoByDate($yesterday); //Untuk Perhitungan Hari ini, maka dibutuhkan saldo kemarin
            $ri_bulanan[$day] = $this->M_laporan->laporan_ri_harian($day);
            $date_month = strtotime("+1 day", $date_month);
        }

        $tgl_judul = date('F Y');
        $spreadsheet = new Spreadsheet();
        $spreadsheet = new Spreadsheet;
        // Mengatur Lebar Kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(17);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(15);

        $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
        // Atur Judul
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("A1:U1")->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $spreadsheet->getActiveSheet()->mergeCells("A1:U1");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Bulan ' . $tgl_judul);
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

        foreach ($data_bulanan as $day => $yesterday_saldo) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $day);
            // $kolom++;
            //Get Saldo Kemarin
            $grand_saldo = $db_grand_saldo; //Diambil Record Hari Kemarin Dari Tabel Saldo Temp
            //Inisialisasi Grand Total
            $kolom += 1;
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

            foreach ($ri_bulanan[$day] as $row) {
                // Validasi Value Karena Bukan Tipe Integer
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

                if ($row->nama_pasien == "") {
                    $pemasukan_bersih = 0;
                } else {
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

                // di dalam loop
                $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('left');
                $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('right');
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

                if ($row->tipe_pelayanan == "Rawat Inap") {

                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' .  $kolom, $nomor++)
                        ->setCellValue('B' .  $kolom, $row->nama_pasien)
                        ->setCellValue('C' .  $kolom, number_format($uang_masuk, 0, ".", ","))
                        ->setCellValue('D' .  $kolom, number_format($gizi, 0, ".", ","))
                        ->setCellValue('E' .  $kolom, number_format($gda, 0, ".", ","))
                        ->setCellValue('F' .  $kolom, number_format($lab, 0, ".", ","))
                        ->setCellValue('G' .  $kolom, number_format($biaya_ambulance, 0, ".", ","))
                        ->setCellValue('H' .  $kolom, number_format($total_kia, 0, ".", ","))
                        ->setCellValue('I' .  $kolom, number_format($ekg, 0, ".", ","))
                        ->setCellValue('J' .  $kolom, number_format($lain_lain, 0, ".", ","))
                        ->setCellValue('K' .  $kolom, number_format($obat_oral_ri, 0, ".", ","))
                        ->setCellValue('L' .  $kolom, number_format($pemasukan_bersih, 0, ".", ","))
                        ->setCellValue('M' .  $kolom, '')
                        ->setCellValue('N' .  $kolom, '')
                        ->setCellValue('O' .  $kolom, '')
                        ->setCellValue('P' .  $kolom, '')
                        ->setCellValue('Q' .  $kolom, number_format($japel, 0, ".", ","))
                        ->setCellValue('R' .  $kolom, number_format($visite, 0, ".", ","))
                        ->setCellValue('S' .  $kolom, number_format($klinik_bersih, 0, ".", ","))
                        ->setCellValue('T' .  $kolom, '')
                        ->setCellValue('U' .  $kolom, number_format($grand_saldo += $pemasukan_bersih, 0, ".", ","));

                    $kolom++;
                } else if ($row->tipe_pelayanan == "IGD") {
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

                    $grand_saldo += $IGD_pemasukan_bersih;
                } else if ($row->tipe_pelayanan == "Rawat Jalan") { //End If IGD, Start IG Rawat Jalan
                    //Menghitung Jumlah Pasien Rawat Jalan
                    $jumlah_pasien_rj++;

                    if ($total_bp_paket > 0) {
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
                } else if ($row->tipe_pelayanan == "Akomodasi") { //End If Rawat Jalan Start Akomodasi
                    $jumlah_trx_akomodasi++;

                    $AK_akomodasi_obat += $akomodasi_obat;
                    $AK_akomodasi_alkes += $akomodasi_alkes;
                    $AK_akomodasi_lain += $akomodasi_lain;
                } else if ($row->tipe_pelayanan == "Setor Uang") {
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
            }


            if ($jumlah_pasien_igd > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor++)
                    ->setCellValue('B' . $kolom, 'IGD')
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
                    ->setCellValue('Q' . $kolom, number_format($IGD_japel, 0, ".", ","))
                    ->setCellValue('R' . $kolom, number_format($IGD_visite, 0, ".", ","))
                    ->setCellValue('S' . $kolom, number_format($IGD_klinik_bersih, 0, ".", ","))
                    ->setCellValue('T' . $kolom, '')
                    ->setCellValue('U' . $kolom, number_format($grand_saldo += $IGD_pemasukan_bersih, 0, ".", ","));
                $kolom++;
            }

            if ($jumlah_pasien_rj > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor++)
                    ->setCellValue('B' . $kolom, 'BP/Rawat Inap')
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
                    ->setCellValue('Q' . $kolom, number_format($RJ_japel, 0, ".", ","))
                    ->setCellValue('R' . $kolom, number_format($RJ_visite, 0, ".", ","))
                    ->setCellValue('S' . $kolom, number_format($RJ_klinik_bersih, 0, ".", ","))
                    ->setCellValue('T' . $kolom, '')
                    ->setCellValue('U' . $kolom, number_format($grand_saldo += $RJ_pemasukan_bersih, 0, ".", ","));
                $kolom++;
            }

            if ($jumlah_trx_akomodasi > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor++)
                    ->setCellValue('B' . $kolom, 'Akomodasi')
                    ->setCellValue('C' . $kolom, '')
                    ->setCellValue('D' . $kolom, '')
                    ->setCellValue('E' . $kolom, '')
                    ->setCellValue('F' . $kolom, '')
                    ->setCellValue('G' . $kolom, '')
                    ->setCellValue('H' . $kolom, '')
                    ->setCellValue('I' . $kolom, '')
                    ->setCellValue('J' . $kolom, '')
                    ->setCellValue('K' . $kolom, '')
                    ->setCellValue('L' . $kolom, '')
                    ->setCellValue('M' . $kolom, number_format($AK_akomodasi_obat, 0, ".", ","))
                    ->setCellValue('N' . $kolom, number_format($AK_akomodasi_alkes, 0, ".", ","))
                    ->setCellValue('O' . $kolom, number_format($AK_akomodasi_lain, 0, ".", ","))
                    ->setCellValue('P' . $kolom, '')
                    ->setCellValue('Q' . $kolom, '')
                    ->setCellValue('R' . $kolom, '')
                    ->setCellValue('S' . $kolom, '')
                    ->setCellValue('T' . $kolom, '')
                    ->setCellValue('U' . $kolom, number_format($grand_saldo -= ($AK_akomodasi_obat + $AK_akomodasi_alkes + $AK_akomodasi_lain), 0, ".", ","));
                $kolom++;
            }

            if ($jumlah_trx_setoran > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $kolom, 'SETORAN')
                    ->setCellValue('C' . $kolom, '')
                    ->setCellValue('D' . $kolom, '')
                    ->setCellValue('E' . $kolom, '')
                    ->setCellValue('F' . $kolom, '')
                    ->setCellValue('G' . $kolom, '')
                    ->setCellValue('H' . $kolom, '')
                    ->setCellValue('I' . $kolom, '')
                    ->setCellValue('J' . $kolom, '')
                    ->setCellValue('K' . $kolom, '')
                    ->setCellValue('L' . $kolom, '')
                    ->setCellValue('M' . $kolom, '')
                    ->setCellValue('N' . $kolom, '')
                    ->setCellValue('O' . $kolom, '')
                    ->setCellValue('P' . $kolom, '')
                    ->setCellValue('Q' . $kolom, '')
                    ->setCellValue('R' . $kolom, '')
                    ->setCellValue('S' . $kolom, '')
                    ->setCellValue('T' . $kolom, number_format($SETORAN_jumlah_setoran, 0, ".", ","))
                    ->setCellValue('U' . $kolom, number_format($grand_saldo -= $SETORAN_jumlah_setoran, 0, ".", ","));
                $kolom++;
            }

            for ($i = 0; $i < $jumlah_pasien_paket_rj; $i++) {
                $GT_uang_masuk += $uang_masuk_bp_ke_ri;
                $GT_obat_oral_ri += $potong_obat_oral;
                $GT_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri;
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $kolom, 'TOTAL')
                ->setCellValue('C' . $kolom, number_format($GT_uang_masuk, 0, ".", ","))
                ->setCellValue('D' . $kolom, number_format($GT_gizi, 0, ".", ","))
                ->setCellValue('E' . $kolom, number_format($GT_gda, 0, ".", ","))
                ->setCellValue('F' . $kolom, number_format($GT_lab, 0, ".", ","))
                ->setCellValue('G' . $kolom, number_format($GT_biaya_ambulance, 0, ".", ","))
                ->setCellValue('H' . $kolom, number_format($GT_total_kia, 0, ".", ","))
                ->setCellValue('I' . $kolom, number_format($GT_ekg, 0, ".", ","))
                ->setCellValue('J' . $kolom, number_format($GT_lain_lain, 0, ".", ","))
                ->setCellValue('K' . $kolom, number_format($GT_obat_oral_ri, 0, ".", ","))
                ->setCellValue('L' . $kolom, number_format($GT_pemasukan_bersih, 0, ".", ","))
                ->setCellValue('M' . $kolom, number_format($GT_akomodasi_obat, 0, ".", ","))
                ->setCellValue('N' . $kolom, number_format($GT_akomodasi_alkes, 0, ".", ","))
                ->setCellValue('O' . $kolom, number_format($GT_akomodasi_lain, 0, ".", ","))
                ->setCellValue('P' . $kolom, number_format($grand_saldo, 0, ".", ","))
                ->setCellValue('Q' . $kolom, number_format($GT_japel, 0, ".", ","))
                ->setCellValue('R' . $kolom, number_format($GT_visite, 0, ".", ","))
                ->setCellValue('S' . $kolom, number_format($GT_klinik_bersih, 0, ".", ","))
                ->setCellValue('T' . $kolom, number_format($GT_jumlah_setoran, 0, ".", ","))
                ->setCellValue('U' . $kolom, '');
            $kolom++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RI_' . $tgl_judul . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }

    public function ri_custom()
    {
        $tgl_1 = $this->input->post('tgl_mulai');
        $tgl_2 = $this->input->post('tgl_akhir');
        $tgl_mulai = strtotime(date($tgl_1));
        $tgl_akhir = strtotime(date($tgl_2));

        // $tgl_mulai = $tgl1 . " 00:00:01";
        // $tgl_akhir = $tgl2 . " 23:59:59";

        $tgl_header_mulai = tgl_indo($tgl_1);
        $tgl_header_akhir = tgl_indo($tgl_2);

        $tgl_judul_mulai = date('d-m-Y', strtotime($tgl_1));
        $tgl_judul_akhir = date('d-m-Y', strtotime($tgl_2));

        $yesterday = date("Y-m-d", strtotime("-1 day", strtotime(date('Y-m-d'))));
        $db_grand_saldo =  $this->M_cek_saldo->getCekSaldoByDate($yesterday);
        // Bulanan
        $data_bulanan = array();
        $ri_bulanan = array();
        while ($tgl_mulai <= $tgl_akhir) {
            //Mendapatkan Saldo Terakhir Untuk Perhitungan Hari ini
            $day = date("Y-m-d", $tgl_mulai); //Tanggal Hari ini
            $yesterday = date("Y-m-d", strtotime("-1 day", $tgl_mulai)); //Tanggal Kemarin
            $data_bulanan[$day] = $this->M_cek_saldo->getCekSaldoByDate($yesterday); //Untuk Perhitungan Hari ini, maka dibutuhkan saldo kemarin
            $ri_bulanan[$day] = $this->M_laporan->laporan_ri_harian($day);
            $tgl_mulai = strtotime("+1 day", $tgl_mulai);
        }

        $tgl_judul = date('F Y');
        $spreadsheet = new Spreadsheet();
        $spreadsheet = new Spreadsheet;
        // Mengatur Lebar Kolom
        $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
        $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(17);
        $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('R')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('S')->setWidth(10);
        $spreadsheet->getActiveSheet()->getColumnDimension('T')->setWidth(15);
        $spreadsheet->getActiveSheet()->getColumnDimension('U')->setWidth(15);

        $spreadsheet->getActiveSheet()->getRowDimension('1')->setRowHeight(35);
        // Atur Judul
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')->getFont()->setBold(true);
        $spreadsheet->getActiveSheet()->getStyle("A1:U1")->getFont()->setSize(20);
        $spreadsheet->getActiveSheet()->getStyle('A1:U1')
            ->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
        $spreadsheet->getActiveSheet()->mergeCells("A1:U1");
        $spreadsheet->setActiveSheetIndex(0)->setCellValue('A1', 'Laporan Rawat Inap Tanggal ' . $tgl_header_mulai." sampai ".$tgl_header_akhir);
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

        foreach ($data_bulanan as $day => $yesterday_saldo) {
            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('A' . $kolom, $day);
            // $kolom++;
            //Get Saldo Kemarin
            $grand_saldo = $db_grand_saldo; //Diambil Record Hari Kemarin Dari Tabel Saldo Temp
            //Inisialisasi Grand Total
            $kolom += 1;
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

            foreach ($ri_bulanan[$day] as $row) {
                // Validasi Value Karena Bukan Tipe Integer
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

                if ($row->nama_pasien == "") {
                    $pemasukan_bersih = 0;
                } else {
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

                // di dalam loop
                $spreadsheet->getActiveSheet()->getStyle('A')->getAlignment()->setHorizontal('center');
                $spreadsheet->getActiveSheet()->getStyle('B')->getAlignment()->setHorizontal('left');
                $spreadsheet->getActiveSheet()->getStyle('C')->getAlignment()->setHorizontal('right');
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

                if ($row->tipe_pelayanan == "Rawat Inap") {

                    $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' .  $kolom, $nomor++)
                        ->setCellValue('B' .  $kolom, $row->nama_pasien)
                        ->setCellValue('C' .  $kolom, number_format($uang_masuk, 0, ".", ","))
                        ->setCellValue('D' .  $kolom, number_format($gizi, 0, ".", ","))
                        ->setCellValue('E' .  $kolom, number_format($gda, 0, ".", ","))
                        ->setCellValue('F' .  $kolom, number_format($lab, 0, ".", ","))
                        ->setCellValue('G' .  $kolom, number_format($biaya_ambulance, 0, ".", ","))
                        ->setCellValue('H' .  $kolom, number_format($total_kia, 0, ".", ","))
                        ->setCellValue('I' .  $kolom, number_format($ekg, 0, ".", ","))
                        ->setCellValue('J' .  $kolom, number_format($lain_lain, 0, ".", ","))
                        ->setCellValue('K' .  $kolom, number_format($obat_oral_ri, 0, ".", ","))
                        ->setCellValue('L' .  $kolom, number_format($pemasukan_bersih, 0, ".", ","))
                        ->setCellValue('M' .  $kolom, '')
                        ->setCellValue('N' .  $kolom, '')
                        ->setCellValue('O' .  $kolom, '')
                        ->setCellValue('P' .  $kolom, '')
                        ->setCellValue('Q' .  $kolom, number_format($japel, 0, ".", ","))
                        ->setCellValue('R' .  $kolom, number_format($visite, 0, ".", ","))
                        ->setCellValue('S' .  $kolom, number_format($klinik_bersih, 0, ".", ","))
                        ->setCellValue('T' .  $kolom, '')
                        ->setCellValue('U' .  $kolom, number_format($grand_saldo += $pemasukan_bersih, 0, ".", ","));

                    $kolom++;
                } else if ($row->tipe_pelayanan == "IGD") {
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

                    $grand_saldo += $IGD_pemasukan_bersih;
                } else if ($row->tipe_pelayanan == "Rawat Jalan") { //End If IGD, Start IG Rawat Jalan
                    //Menghitung Jumlah Pasien Rawat Jalan
                    $jumlah_pasien_rj++;

                    if ($total_bp_paket > 0) {
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
                } else if ($row->tipe_pelayanan == "Akomodasi") { //End If Rawat Jalan Start Akomodasi
                    $jumlah_trx_akomodasi++;

                    $AK_akomodasi_obat += $akomodasi_obat;
                    $AK_akomodasi_alkes += $akomodasi_alkes;
                    $AK_akomodasi_lain += $akomodasi_lain;
                } else if ($row->tipe_pelayanan == "Setor Uang") {
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
            }


            if ($jumlah_pasien_igd > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor++)
                    ->setCellValue('B' . $kolom, 'IGD')
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
                    ->setCellValue('Q' . $kolom, number_format($IGD_japel, 0, ".", ","))
                    ->setCellValue('R' . $kolom, number_format($IGD_visite, 0, ".", ","))
                    ->setCellValue('S' . $kolom, number_format($IGD_klinik_bersih, 0, ".", ","))
                    ->setCellValue('T' . $kolom, '')
                    ->setCellValue('U' . $kolom, number_format($grand_saldo += $IGD_pemasukan_bersih, 0, ".", ","));
                $kolom++;
            }

            if ($jumlah_pasien_rj > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor++)
                    ->setCellValue('B' . $kolom, 'BP/Rawat Inap')
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
                    ->setCellValue('Q' . $kolom, number_format($RJ_japel, 0, ".", ","))
                    ->setCellValue('R' . $kolom, number_format($RJ_visite, 0, ".", ","))
                    ->setCellValue('S' . $kolom, number_format($RJ_klinik_bersih, 0, ".", ","))
                    ->setCellValue('T' . $kolom, '')
                    ->setCellValue('U' . $kolom, number_format($grand_saldo += $RJ_pemasukan_bersih, 0, ".", ","));
                $kolom++;
            }

            if ($jumlah_trx_akomodasi > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A' . $kolom, $nomor++)
                    ->setCellValue('B' . $kolom, 'Akomodasi')
                    ->setCellValue('C' . $kolom, '')
                    ->setCellValue('D' . $kolom, '')
                    ->setCellValue('E' . $kolom, '')
                    ->setCellValue('F' . $kolom, '')
                    ->setCellValue('G' . $kolom, '')
                    ->setCellValue('H' . $kolom, '')
                    ->setCellValue('I' . $kolom, '')
                    ->setCellValue('J' . $kolom, '')
                    ->setCellValue('K' . $kolom, '')
                    ->setCellValue('L' . $kolom, '')
                    ->setCellValue('M' . $kolom, number_format($AK_akomodasi_obat, 0, ".", ","))
                    ->setCellValue('N' . $kolom, number_format($AK_akomodasi_alkes, 0, ".", ","))
                    ->setCellValue('O' . $kolom, number_format($AK_akomodasi_lain, 0, ".", ","))
                    ->setCellValue('P' . $kolom, '')
                    ->setCellValue('Q' . $kolom, '')
                    ->setCellValue('R' . $kolom, '')
                    ->setCellValue('S' . $kolom, '')
                    ->setCellValue('T' . $kolom, '')
                    ->setCellValue('U' . $kolom, number_format($grand_saldo -= ($AK_akomodasi_obat + $AK_akomodasi_alkes + $AK_akomodasi_lain), 0, ".", ","));
                $kolom++;
            }

            if ($jumlah_trx_setoran > 0) {
                $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('B' . $kolom, 'SETORAN')
                    ->setCellValue('C' . $kolom, '')
                    ->setCellValue('D' . $kolom, '')
                    ->setCellValue('E' . $kolom, '')
                    ->setCellValue('F' . $kolom, '')
                    ->setCellValue('G' . $kolom, '')
                    ->setCellValue('H' . $kolom, '')
                    ->setCellValue('I' . $kolom, '')
                    ->setCellValue('J' . $kolom, '')
                    ->setCellValue('K' . $kolom, '')
                    ->setCellValue('L' . $kolom, '')
                    ->setCellValue('M' . $kolom, '')
                    ->setCellValue('N' . $kolom, '')
                    ->setCellValue('O' . $kolom, '')
                    ->setCellValue('P' . $kolom, '')
                    ->setCellValue('Q' . $kolom, '')
                    ->setCellValue('R' . $kolom, '')
                    ->setCellValue('S' . $kolom, '')
                    ->setCellValue('T' . $kolom, number_format($SETORAN_jumlah_setoran, 0, ".", ","))
                    ->setCellValue('U' . $kolom, number_format($grand_saldo -= $SETORAN_jumlah_setoran, 0, ".", ","));
                $kolom++;
            }

            for ($i = 0; $i < $jumlah_pasien_paket_rj; $i++) {
                $GT_uang_masuk += $uang_masuk_bp_ke_ri;
                $GT_obat_oral_ri += $potong_obat_oral;
                $GT_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri;
            }

            $spreadsheet->setActiveSheetIndex(0)
                ->setCellValue('B' . $kolom, 'TOTAL')
                ->setCellValue('C' . $kolom, number_format($GT_uang_masuk, 0, ".", ","))
                ->setCellValue('D' . $kolom, number_format($GT_gizi, 0, ".", ","))
                ->setCellValue('E' . $kolom, number_format($GT_gda, 0, ".", ","))
                ->setCellValue('F' . $kolom, number_format($GT_lab, 0, ".", ","))
                ->setCellValue('G' . $kolom, number_format($GT_biaya_ambulance, 0, ".", ","))
                ->setCellValue('H' . $kolom, number_format($GT_total_kia, 0, ".", ","))
                ->setCellValue('I' . $kolom, number_format($GT_ekg, 0, ".", ","))
                ->setCellValue('J' . $kolom, number_format($GT_lain_lain, 0, ".", ","))
                ->setCellValue('K' . $kolom, number_format($GT_obat_oral_ri, 0, ".", ","))
                ->setCellValue('L' . $kolom, number_format($GT_pemasukan_bersih, 0, ".", ","))
                ->setCellValue('M' . $kolom, number_format($GT_akomodasi_obat, 0, ".", ","))
                ->setCellValue('N' . $kolom, number_format($GT_akomodasi_alkes, 0, ".", ","))
                ->setCellValue('O' . $kolom, number_format($GT_akomodasi_lain, 0, ".", ","))
                ->setCellValue('P' . $kolom, number_format($grand_saldo, 0, ".", ","))
                ->setCellValue('Q' . $kolom, number_format($GT_japel, 0, ".", ","))
                ->setCellValue('R' . $kolom, number_format($GT_visite, 0, ".", ","))
                ->setCellValue('S' . $kolom, number_format($GT_klinik_bersih, 0, ".", ","))
                ->setCellValue('T' . $kolom, number_format($GT_jumlah_setoran, 0, ".", ","))
                ->setCellValue('U' . $kolom, '');
            $kolom++;
        }

        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="RI_' . $tgl_judul_mulai." sampai ".$tgl_judul_akhir . '.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
        
    }
}
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
