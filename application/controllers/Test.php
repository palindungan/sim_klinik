<?php 
    defined('BASEPATH') OR exit('No direct script access allowed');
    
    class Test extends CI_Controller {

        // public function index() {
        //     $this->load->view('sim_klinik/konten/administrasi/cetak_struk/tampil');
        // }
        function __construct()
        {
            parent::__construct();
            $this->load->model('M_test');
        }

        public function onclick()
        {
            $this->load->view('test');
        }

        public function onclick_load()
        {
            $html = 'hello';
            $this->dompdf->PdfGenerator($html, 'coba', 'A4', 'potrait',true);
            
        }

        public function index() {
            $no_ref_pelayanan = "200114-001";
            $where_no_ref = array(
                'no_ref_pelayanan' => $no_ref_pelayanan
            );

            // ambil biodata pasien
            $data_pelayanan_pasien = $this->M_test->get_data('data_pelayanan_pasien_default',$where_no_ref)->row();
            $nama_pasien = $data_pelayanan_pasien->nama;
            $no_rm = $data_pelayanan_pasien->no_rm;
            $no_ref = $data_pelayanan_pasien->no_ref_pelayanan;
            $tgl_pelayanan_tmp = $data_pelayanan_pasien->tgl_pelayanan;
            $tgl_pelayanan = tgl_indo(date('Y-m-d',strtotime($tgl_pelayanan_tmp)));
            $tipe_pelayanan = $data_pelayanan_pasien->tipe_pelayanan;

            // Ambil Tindakan BP
            $bp_penanganan = $this->M_test->get_data('bp_penanganan',$where_no_ref)->result();
            $no_bp_p = " ";
            foreach($bp_penanganan as $bp)
            {
                $no_bp_p = $bp->no_bp_p;
            }

            // ambil detail tindakan bp
            $where_no_bp_p = array(
                'no_bp_p' => $no_bp_p
            );
            $detail_bp_penanganan = $this->M_test->get_data('daftar_detail_tindakan_bp_transaksi',$where_no_bp_p)->result();


            // Ambil Tindakan KIA
            $kia_penanganan = $this->M_test->get_data('kia_penanganan',$where_no_ref)->result();
            $no_kia_p = " ";
            foreach($kia_penanganan as $kia)
            {
                $no_kia_p = $kia->no_kia_p;
            }

            // ambil detail tindakan kia
            $where_no_kia_p = array(
                'no_kia_p' => $no_kia_p
            );
            $detail_kia_penanganan =
            $this->M_test->get_data('daftar_detail_tindakan_kia_transaksi',$where_no_kia_p)->result();

            // Ambil Tindakan Lab
            $lab_transaksi = $this->M_test->get_data('lab_transaksi',$where_no_ref)->result();
            $no_lab_t = " ";
            foreach($lab_transaksi as $lab)
            {
                $no_lab_t = $lab->no_lab_t;
            }

            // ambil detail tindakan lab
            $where_no_lab_t = array(
            'no_lab_t' => $no_lab_t
            );
            $detail_lab_transaksi =
            $this->M_test->get_data('daftar_detail_tindakan_lab_transaksi',$where_no_lab_t)->result();

            // Ambil Tindakan UGD
            $ugd_penanganan = $this->M_test->get_data('ugd_penanganan',$where_no_ref)->result();
            $no_ugd_p = " ";
            foreach($ugd_penanganan as $ugd)
            {
                $no_ugd_p = $ugd->no_ugd_p;
            }

            // ambil detail tindakan ugd
            $where_no_ugd_p = array(
                'no_ugd_p' => $no_ugd_p
            );
            $detail_ugd_penanganan =
            $this->M_test->get_data('daftar_detail_tindakan_ugd_transaksi',$where_no_ugd_p)->result();
            

            // Ambil Penjualan Apotekk
            $penjualan_obat_apotek = $this->M_test->get_data('penjualan_obat_apotik',$where_no_ref)->result();
            $no_penjualan_obat_a = " ";
            foreach($penjualan_obat_apotek as $jual_obat_apotek)
            {
                $no_penjualan_obat_a = $jual_obat_apotek->no_penjualan_obat_a;
            }

            // ambil detail Penjualan Apotekk
            $where_no_penjualan_obat_a = array(
                'no_penjualan_obat_a' => $no_penjualan_obat_a
            );
            $detail_penjualan_obat_apotek =
            $this->M_test->get_data('detail_penjualan_obat_apotik',$where_no_penjualan_obat_a)->result();

            // Ambil kamar rawat inatp
            $transaksi_rawat_inap = $this->M_test->get_data('transaksi_rawat_inap',$where_no_ref)->result();

            $no_transaksi_rawat_i = " ";
            foreach($transaksi_rawat_inap as $transaksi_ri)
            {
                $no_transaksi_rawat_i = $transaksi_ri->no_transaksi_rawat_i;
            }

            // ambil detail kamar rawaat inap
            $no_detail_kamar_ri = " ";
            $where_no_transaksi_rawat_i = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );
            $detail_kamar_rawat_inap =
            $this->M_test->get_data('detail_transaksi_rawat_inap_kamar',$where_no_transaksi_rawat_i)->result();
            foreach($detail_kamar_rawat_inap as $data_kamar_ri)
            {
                $no_detail_kamar_ri = $data_kamar_ri->no_detail_transaksi_rawat_inap_k;
            }

            // ambil detail tindakan rawat inap
            $detail_tindakan_rawat_inap =
            $this->M_test->get_data('detail_transaksi_rawat_inap_tindakan',$where_no_transaksi_rawat_i)->result();
            $no_detail_tindakan_ri = " ";
            foreach($detail_tindakan_rawat_inap as $data_tindakan_ri)
            {
                $no_detail_tindakan_ri = $data_tindakan_ri->no_detail_transaksi_rawat_inap_t;
            }

            // ambil detail obat rawat inap
            $detail_obat_rawat_inap =
            $this->M_test->get_data('detail_transaksi_rawat_inap_obat',$where_no_transaksi_rawat_i)->result();
            $no_detail_obat_ri = " ";
            foreach($detail_obat_rawat_inap as $data_obat_ri)
            {
                $no_detail_obat_ri = $data_obat_ri->no_detail_transaksi_rawat_inap_o;
            }
            
            $total_harga_bp = 0;
            $total_harga_kia = 0;
            $total_harga_lab = 0;
            $total_harga_ugd = 0;
            $total_harga_apotek = 0;

            $total_harga_kamar_ri= 0;
            $total_harga_tindakan_ri = 0;
            $total_harga_obat_ri = 0;

            if($tipe_pelayanan == "Rawat Jalan")
            {
                $html = '
                <h4 style="text-align:center">Rekening Pasien</h4>
                <table width="100%">
                    <tr>
                        <td width="14%">Nama</td>
                        <td width="1%">:</td>
                        <td width="35%">'.$nama_pasien.'</td>
                        <td width="19%">No Pelayanan</td>
                        <td width="1%">:</td>
                        <td width="30%">'.$no_ref.'</td>
                    </tr>
                    <tr>
                        <td width="14%">Nomor RM</td>
                        <td width="1%">:</td>
                        <td width="40%">'.$no_rm.'</td>
                        <td width="19%">Tanggal Masuk</td>
                        <td width="1%">:</td>
                        <td width="25%">'.$tgl_pelayanan.'</td>
                    </tr>
                </table>
                <hr>
                <table width="100%">
                    <tr>
                        <td style="text-align:left">Rincian Transaksi</td>
                        <td style="text-align:right">Biaya</td>
                    </tr>';
                    if($no_bp_p != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Balai Pengobatan</i></td>
                    </tr>';
                    foreach($detail_bp_penanganan as $bp_tindakan)
                    {
                        $total_harga_bp += $bp_tindakan->harga_tindakan;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$bp_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($bp_tindakan->harga_tindakan).'</td>
                    </tr>';}
                    }
                    if($no_kia_p != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Poli KIA</i></td>
                    </tr>';
                    foreach($detail_kia_penanganan as $kia_tindakan)
                    {
                        $total_harga_kia += $kia_tindakan->harga;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$kia_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($kia_tindakan->harga).'</td>
                    </tr>';}
                    }

                    if($no_lab_t != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Laboratorium</i></td>
                    </tr>';
                    foreach($detail_lab_transaksi as $lab_tindakan)
                    {
                        $total_harga_lab += $lab_tindakan->harga;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$lab_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($lab_tindakan->harga).'</td>
                    </tr>';}
                    }

                    if($no_ugd_p != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan UGD</i></td>
                    </tr>';
                    foreach($detail_ugd_penanganan as $ugd_tindakan)
                    {
                        $total_harga_ugd += $ugd_tindakan->harga;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$ugd_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($ugd_tindakan->harga).'</td>
                    </tr>';}
                    }

                    if($no_penjualan_obat_a != " ")
                    {
                        foreach($detail_penjualan_obat_apotek as $row_obat_apotek)
                        {
                            if($row_obat_apotek->status_paket == "Ya")
                            {
                                $total_harga_apotek = 0;
                            }
                            else 
                            {
                                $total_harga_apotek += $row_obat_apotek->harga_jual;
                            }
                        }
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Obat-obatan</i></td>
                    </tr>';
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">Apotek</td>
                        <td style="text-align:right">'.rupiah($total_harga_apotek).'</td>
                    </tr>';
                    }
                    $grand_total = $total_harga_bp + $total_harga_kia + $total_harga_lab + $total_harga_ugd + $total_harga_apotek;
                    $html.='
                    <tr>
                        <td style="text-align:left;padding-left:10px;padding-top:20px"><i>Jumlah Yang Harus Dibayar</i></td>
                        <td style="text-align:right;adding-top:20px;">'.rupiah($grand_total).'</td>
                    </tr>';
                $html.='</table>
                ';
                $this->dompdf->PdfGenerator($html, 'coba', 'A4', 'potrait',true);
            }
            else {
                $html = '
                <h4 style="text-align:center">Rekening Pasien</h4>
                <table width="100%">
                    <tr>
                        <td width="14%">Nama</td>
                        <td width="1%">:</td>
                        <td width="35%">'.$nama_pasien.'</td>
                        <td width="19%">No Pelayanan</td>
                        <td width="1%">:</td>
                        <td width="30%">'.$no_ref.'</td>
                    </tr>
                    <tr>
                        <td width="14%">Nomor RM</td>
                        <td width="1%">:</td>
                        <td width="40%">'.$no_rm.'</td>
                        <td width="19%">Tanggal Masuk</td>
                        <td width="1%">:</td>
                        <td width="25%">'.$tgl_pelayanan.'</td>
                    </tr>
                </table>
                <hr>
                <table width="100%">
                    <tr>
                        <td style="text-align:left">Rincian Transaksi</td>
                        <td style="text-align:right">Biaya</td>
                    </tr>';
                    if($no_bp_p != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Balai Pengobatan</i></td>
                    </tr>';
                    foreach($detail_bp_penanganan as $bp_tindakan)
                    {
                    $total_harga_bp += $bp_tindakan->harga_tindakan;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$bp_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($bp_tindakan->harga_tindakan).'</td>
                    </tr>';}
                    }
                    if($no_kia_p != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Poli KIA</i></td>
                    </tr>';
                    foreach($detail_kia_penanganan as $kia_tindakan)
                    {
                    $total_harga_kia += $kia_tindakan->harga;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$kia_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($kia_tindakan->harga).'</td>
                    </tr>';}
                    }

                    if($no_lab_t != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Laboratorium</i></td>
                    </tr>';
                    foreach($detail_lab_transaksi as $lab_tindakan)
                    {
                    $total_harga_lab += $lab_tindakan->harga;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$lab_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($lab_tindakan->harga).'</td>
                    </tr>';}
                    }

                    if($no_ugd_p != " ")
                    {
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan UGD</i></td>
                    </tr>';
                    foreach($detail_ugd_penanganan as $ugd_tindakan)
                    {
                    $total_harga_ugd += $ugd_tindakan->harga;
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">'.$ugd_tindakan->nama.'</td>
                        <td style="text-align:right">'.rupiah($ugd_tindakan->harga).'</td>
                    </tr>';}
                    }

                    if($no_penjualan_obat_a != " ")
                    {
                        foreach($detail_penjualan_obat_apotek as $row_obat_apotek)
                    {
                        if($row_obat_apotek->status_paket == "Ya")
                        {
                            $total_harga_apotek = 0;
                        }
                        else
                        {
                            $total_harga_apotek += $row_obat_apotek->harga_jual;
                        }
                    }
                    $html.='<tr>
                        <td style="text-align:left;padding-left:10px"><i>Biaya Obat-obatan</i></td>
                    </tr>';
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">Apotek</td>
                        <td style="text-align:right">'.rupiah($total_harga_apotek).'</td>
                    </tr>';
                    }
                    if($no_transaksi_rawat_i != " ")
                    {
                    $html.='
                    <tr>
                    	<td style="text-align:left;padding-left:10px"><i>Rawat Inap</i></td>
                    </tr>';
                    }

                    if($no_detail_kamar_ri != " ")
                    {
                    foreach($detail_kamar_rawat_inap as $kamar_ri)
                    {
                        $total_harga_kamar_ri += $kamar_ri->harga_harian;
                    }
                    
                    $html.='
                    <tr>
                        <td style="text-align:left;padding-left:20px">Biaya Kamar</td>
                        <td style="text-align:right">'.rupiah($total_harga_kamar_ri).'</td>
                    </tr>';
                    
                    }
                    if($no_detail_tindakan_ri != " ")
                    {
                        foreach($detail_tindakan_rawat_inap as $tindakan_ri)
                        {
                            $total_harga_tindakan_ri += $tindakan_ri->harga;
                        }
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">Biaya Tindakan Rawat Inap</td>
                        <td style="text-align:right">'.rupiah($total_harga_tindakan_ri).'</td>
                    </tr>';
                    }
                    if($no_detail_obat_ri != " ")
                    {
                        foreach($detail_obat_rawat_inap as $obat_ri)
                        {
                        $total_harga_obat_ri += $obat_ri->sub_total_harga;
                        }
                    $html.='<tr>
                        <td style="text-align:left;padding-left:20px">Biaya Obat</td>
                        <td style="text-align:right">'.rupiah($total_harga_obat_ri).'</td>
                    </tr>
                    ';
                    }
                    $grand_total = $total_harga_bp + $total_harga_kia + $total_harga_lab + $total_harga_ugd +
                    $total_harga_apotek + $total_harga_kamar_ri + $total_harga_tindakan_ri + $total_harga_obat_ri;
                    $html.='
                    <tr>
                        <td style="text-align:left;padding-left:10px;padding-top:20px"><i>Jumlah Yang Harus Dibayar</i>
                        </td>
                        <td style="text-align:right;adding-top:20px;">'.rupiah($grand_total).'</td>
                    </tr>';
                    $html.='
                </table>
                ';
                $this->dompdf->PdfGenerator($html, 'coba', 'A4', 'potrait',true);
            }

            
        }
    
        public function cetak_struk() {
            // me-load library escpos
    
            // membuat connector printer ke shared printer bernama "printer_a" (yang telah disetting sebelumnya)
            $connector = new Escpos\PrintConnectors\WindowsPrintConnector("POS58");
    
            // membuat objek $printer agar dapat di lakukan fungsinya
            $printer = new Escpos\Printer($connector);
    
    
            /* ---------------------------------------------------------
            * Teks biasa | text()
            */
            $printer->initialize();
            $printer->text("Ini teks biasa \n");
            $printer->text("\n");
    
            /* ---------------------------------------------------------
            * Select print mode | selectPrintMode()
            */
            // Printer::MODE_FONT_A
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_FONT_A);
            $printer->text("teks dengan MODE_FONT_A \n");
            $printer->text("\n");
    
            // Printer::MODE_FONT_B
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_FONT_B);
            $printer->text("teks dengan MODE_FONT_B \n");
            $printer->text("\n");
    
            // Printer::MODE_EMPHASIZED
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_EMPHASIZED);
            $printer->text("teks dengan MODE_EMPHASIZED \n");
            $printer->text("\n");
    
            // Printer::MODE_DOUBLE_HEIGHT
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_HEIGHT);
            $printer->text("teks dengan MODE_DOUBLE_HEIGHT \n");
            $printer->text("\n");
    
            // Printer::MODE_DOUBLE_WIDTH
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_DOUBLE_WIDTH);
            $printer->text("teks dengan MODE_DOUBLE_WIDTH \n");
            $printer->text("\n");
    
            // Printer::MODE_UNDERLINE
            $printer->initialize();
            $printer->selectPrintMode(Escpos\Printer::MODE_UNDERLINE);
            $printer->text("teks dengan MODE_UNDERLINE \n");
            $printer->text("\n");
    
    
            /* ---------------------------------------------------------
            * Teks dengan garis bawah  | setUnderline()
            */
            $printer->initialize();
            $printer->setUnderline(Escpos\Printer::UNDERLINE_DOUBLE);
            $printer->text("Ini teks dengan garis bawah \n");
            $printer->text("\n");
    
            /* ---------------------------------------------------------
            * Rata kiri, tengah, dan kanan (JUSTIFICATION) | setJustification()
            */
            // Teks rata kiri JUSTIFY_LEFT
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_LEFT);
            $printer->text("Ini teks rata kiri \n");
            $printer->text("\n");
    
            // Teks rata tengah JUSTIFY_CENTER
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_CENTER);
            $printer->text("Ini teks rata tengah \n");
            $printer->text("\n");
    
            // Teks rata kanan JUSTIFY_RIGHT
            $printer->initialize();
            $printer->setJustification(Escpos\Printer::JUSTIFY_RIGHT);
            $printer->text("Ini teks rata kanan \n");
            $printer->text("\n");
    
    
            /* ---------------------------------------------------------
            * Font A, B dan C | setFont()
            */
            // Teks dengan font A
            $printer->initialize();
            $printer->setFont(Escpos\Printer::FONT_A);
            $printer->text("Ini teks dengan font A \n");
            $printer->text("\n");
    
            // Teks dengan font B
            $printer->initialize();
            $printer->setFont(Escpos\Printer::FONT_B);
            $printer->text("Ini teks dengan font B \n");
            $printer->text("\n");
    
            // Teks dengan font C
            $printer->initialize();
            $printer->setFont(Escpos\Printer::FONT_C);
            $printer->text("Ini teks dengan font C \n");
            $printer->text("\n");
    
            /* ---------------------------------------------------------
            * Jarak perbaris 40 (linespace) | setLineSpacing()
            */
            $printer->initialize();
            $printer->setLineSpacing(40);
            $printer->text("Ini paragraf dengan \nline spacing sebesar 40 \ndi printer dotmatrix \n");
            $printer->text("\n");
    
            /* ---------------------------------------------------------
            * Jarak dari kiri (Margin Left) | setPrintLeftMargin()
            */
            $printer->initialize();
            $printer->setPrintLeftMargin(10);
            $printer->text("Ini teks berjarak 10 dari kiri (Margin left) \n");
            $printer->text("\n");
    
            /* ---------------------------------------------------------
            * membalik warna teks (background menjadi hitam) | setReverseColors()
            */
            $printer->initialize();
            $printer->setReverseColors(TRUE);
            $printer->text("Warna Teks ini terbalik \n");
            $printer->text("\n");
    
    
            /* ---------------------------------------------------------
            * Menyelesaikan printer
            */
            $printer->feed(4); // mencetak 2 baris kosong, agar kertas terangkat ke atas
            $printer->close();
        }
    }
    
    /* End of file Transaksi.php */
    /* Location: ./application/controllers/Transaksi.php */
    ?>
