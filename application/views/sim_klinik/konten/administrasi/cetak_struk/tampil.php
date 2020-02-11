<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cetak Struk Tagihan</title>
    <style type="text/css" media="print">
        @page {
            margin: 0 1 2 1;

        }

        .body {
            margin: 0in 0.2in 0in 0.3in;

            font-family: Arial, Helvetica, sans-serif;
        }

        .footer {
            position: absolute;
            bottom: 0;
        }

        p,
        td {
            font-size: 12px;
        }
    </style>
</head>

<body>
    <?php 
    $harga_tindakan_bp = 0;
    $harga_tindakan_kia = 0;
    $harga_tindakan_lab = 0;
    $harga_tindakan_ugd = 0;
    $harga_apotek_total = 0;
    $harga_kamar_ri = 0;
    $harga_tindakan_ri = 0;
    $harga_obat_ri = 0;
    $harga_ambulance = 0;
    $harga_lain = 0;
    $grand_total = 0;
    ?>
    <h6 style="font-weight:100;text-align:center;">KLINIK PRATAMA RAWAT INAP AMPEL SEHAT</h6>
    <h6 style="font-weight:100;text-align:center;margin-top:-20px">Jl. Sunan Muria No.10 Rt 04 Rw 04</h6>
    <h6 style="font-weight:100;text-align:center;margin-top:-20px">Ampel Wuluhan Jember</h6>
    <h6 style="font-weight:100;text-align:center;margin-top:-20px">Telp 0822 3016 9638 Kode Pos 68162</h6>
    <hr style="margin-top:-20px">
    <p style="margin-top:0px">No. Ref : <?php echo $no_ref; ?></p>
    <p style="margin-top:-10px">Atas Nama : <?php echo $nama_pasien; ?></p>
    <table width="100%" style="margin-top:-15px;">
        <tr style="bottom-border: 1pt solid black;">
            <td><p style="font-weight:normal">Rincian Transaksi</p></td>
            <td style="text-align:right;margin:bottom:-10px;">Biaya</td>
        </tr>

        <!-- Rincian Tindakan BP -->
        <?php 
        if ($cek_bp_penanganan2->num_rows() > 0) {
            foreach ($cek_bp_penanganan2->result() as $data_bp) {
                $no_bp_p = $data_bp->no_bp_p;
            }

            $where_no_bp_p = array(
                'no_bp_p' => $no_bp_p
            );
            $detail_penanganan_bp = $this->M_tagihan->get_data('daftar_detail_tindakan_bp_transaksi', $where_no_bp_p);

        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px" colspan="2"><i>Balai Pengobatan</i></td>
        </tr>
        <?php 
        foreach ($detail_penanganan_bp->result() as $detail_bp) {
            $harga_tindakan_bp += $detail_bp->harga_tindakan * $detail_bp->qty;
        ?>
        <tr>
            <td style="text-align:left;padding-left:20px"><?php echo $detail_bp->nama.' ('.$detail_bp->qty.'X)'; ?></td>
            <td style="text-align:right"><?php echo rupiah($harga_tindakan_bp) ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- End Rincian Tindakan BP -->

        <!-- Rincian Pelayanan KIA -->
        <?php 
        if ($cek_kia_penanganan2->num_rows() > 0) {
            foreach ($cek_kia_penanganan2->result() as $data_kia) {
                $no_kia_p = $data_kia->no_kia_p;
            }

            $where_no_kia_p = array(
                'no_kia_p' => $no_kia_p
            );
            $detail_penanganan_kia = $this->M_tagihan->get_data('daftar_detail_tindakan_kia_transaksi', $where_no_kia_p);
            
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px"><i>KIA</i></td>
        </tr>
        <?php 
        foreach ($detail_penanganan_kia->result() as $detail_kia) {
            $harga_tindakan_kia += $detail_kia->harga * $detail_kia->qty;
        ?>
        <tr>
            <td style="text-align:left;padding-left:20px"><?php echo $detail_kia->nama.' ('.$detail_kia->qty.'X)'; ?></td>
            <td style="text-align:right"><?php echo rupiah($harga_tindakan_kia); ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- End Rincian Pelayanan KIA -->

        <!-- Rincian Tindakan LAB  -->
        <?php 
        if ($cek_lab_transaksi2->num_rows() > 0) {
            foreach ($cek_lab_transaksi2->result() as $data_lab) {
                $no_lab_t = $data_lab->no_lab_t;
            }

            $where_no_lab_t = array(
                'no_lab_t' => $no_lab_t
            );
            $detail_penanganan_lab = $this->M_tagihan->get_data('daftar_detail_tindakan_lab_transaksi', $where_no_lab_t);
            
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px"><i>Laboratorium</i></td>
        </tr>
        <?php 
        foreach ($detail_penanganan_lab->result() as $detail_lab) {
            $harga_tindakan_lab += $detail_lab->harga * $detail_lab->qty;
        ?>
        <tr>
            <td style="text-align:left;padding-left:20px"><?php echo $detail_lab->nama.' ('.$detail_lab->qty.'X)'; ?></td>
            <td style="text-align:right"><?php echo rupiah($harga_tindakan_lab); ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- END Rincian Tindakan LAB  -->

        <!-- Rincian Tindakan UGD  -->
        <?php 
        if ($cek_ugd_penanganan2->num_rows() > 0) {
            foreach ($cek_ugd_penanganan2->result() as $data_ugd) {
                $no_ugd_p = $data_ugd->no_ugd_p;
            }

            $where_no_ugd_p = array(
                'no_ugd_p' => $no_ugd_p
            );
            $detail_penanganan_ugd = $this->M_tagihan->get_data('daftar_detail_tindakan_ugd_transaksi', $where_no_ugd_p);

        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px"><i> UGD</i></td>
        </tr>
        <?php 
        foreach ($detail_penanganan_ugd->result() as $detail_ugd) {
            $harga_tindakan_ugd += $detail_ugd->harga * $detail_ugd->qty;
        ?>
        <tr>
            <td style="text-align:left;padding-left:20px"><?php echo $detail_ugd->nama.' ('.$detail_ugd->qty.'X)'; ?></td>
            <td style="text-align:right"><?php echo rupiah($harga_tindakan_ugd); ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- END Rincian Tindakan UGD  -->

        <!-- Rincian Biaya Obat Apotek  -->
        <?php 
        if ($cek_penjualan_obat_apotik2->num_rows() > 0) {
            foreach ($cek_penjualan_obat_apotik2->result() as $data_apotik) {
                $no_penjualan_obat_a = $data_apotik->no_penjualan_obat_a;
            }

            $where_no_penjualan_obat_a = array(
                'no_penjualan_obat_a' => $no_penjualan_obat_a
            );
            $detail_penjualan_apotik = $this->M_tagihan->get_data('daftar_penjualan_obat_apotek_detail', $where_no_penjualan_obat_a)->result();
            $harga_apotek_totals = 0;
            foreach ($detail_penjualan_apotik as $data_apotikss) {
                $harga_apotek_totals += $data_apotikss->harga_jual * $data_apotikss->qty;
            }
            if ($harga_apotek_totals != 0) {
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px"><i>Apotek</i></td>
        </tr>
        <?php 
        foreach ($detail_penjualan_apotik as $data_apotiks) {
            $harga_apotek_total += $data_apotiks->harga_jual * $data_apotiks->qty;
        }
        ?>
        <tr>
            <td style="text-align:left;padding-left:20px">Biaya Obat-Obatan</td>
            <td style="text-align:right"><?php echo rupiah($harga_apotek_total) ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- END Rincian Biaya Obat Apotek  -->


        <!-- Rincian Biaya Rawat Inap  -->
        <?php 
        if ($cek_transaksi_rawat_inap2->num_rows() > 0) {
            foreach ($cek_transaksi_rawat_inap2->result() as $data_rawat_inap) {
                $no_transaksi_rawat_i = $data_rawat_inap->no_transaksi_rawat_i;
            }

            $where_no_transaksi_rawat_i = array(
                'no_transaksi_rawat_i' => $no_transaksi_rawat_i
            );

            $detail_kamar_ri = $this->M_tagihan->get_data('daftar_detail_kamar_rawat_inap', $where_no_transaksi_rawat_i)->result();
            $detail_tindakan_ri = $this->M_tagihan->get_data('daftar_detail_tindakan_rawat_inap', $where_no_transaksi_rawat_i)->result();
            $detail_obat_ri = $this->M_tagihan->get_data('daftar_penjualan_obat_rawat_inap_detail', $where_no_transaksi_rawat_i)->result();

            $no_rawat_inap_t = "kosong";
            foreach ($detail_tindakan_ri as $detail_tindakan_rawat_inap) {
                $no_rawat_inap_t = $detail_tindakan_rawat_inap->no_rawat_inap_t;
            }

            $no_detail_transaksi_rawat_inap_k = "kosong";
            foreach ($detail_kamar_ri as $detail_kamar_rawat_inap) {
                $no_detail_transaksi_rawat_inap_k = $detail_kamar_rawat_inap->no_detail_transaksi_rawat_inap_k;
            }

            $kode_obat_ri = "kosong";
            foreach ($detail_obat_ri as $detail_obat_rawat_inap) {
                $kode_obat_ri = $detail_obat_rawat_inap->kode_obat;
            }
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px"><i>Rawat inap</i></td>
        </tr>

        <!-- Rincian Kamar Rawat Inap -->
        <?php 
        if ($no_detail_transaksi_rawat_inap_k != "kosong") {
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:20px">Kamar</td>
        </tr>
        <?php 
        foreach ($detail_kamar_ri as $detail_rawat_inap_k) {
            $harga_kamar_ri += $detail_rawat_inap_k->jumlah_hari * $detail_rawat_inap_k->harga_harian;
        ?>
        <tr>
            <td style="text-align:left;padding-left:40px"><?php echo $detail_rawat_inap_k->nama.' ('.$detail_rawat_inap_k->jumlah_hari.' Hari)'; ?></td>
            <td style="text-align:right"><?php echo rupiah($detail_rawat_inap_k->jumlah_hari * $detail_rawat_inap_k->harga_harian) ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- END Rincian Kamar Rawat Inap -->

        <!-- Rincian Tindakan Rawat Inap -->
        <?php 
        if ($no_rawat_inap_t != "kosong") {
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:20px">Tindakan Rawat Inap</td>
        </tr>
        <?php 
        foreach ($detail_tindakan_ri as $detail_rawat_inap_t) {
            $harga_tindakan_ri += $detail_rawat_inap_t->harga * $detail_rawat_inap_t->qty;
            
        ?>
        <tr>
            <td style="text-align:left;padding-left:40px"><?php echo $detail_rawat_inap_t->nama.' ('.$detail_rawat_inap_t->qty.'X)'; ?></td>
            <td style="text-align:right"><?php echo rupiah($detail_rawat_inap_t->harga * $detail_rawat_inap_t->qty) ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- END Rincian Tindakan Rawat Inap -->

        <!-- Rincian Obat Rawat Inap -->
        <?php
        if ($kode_obat_ri != "kosong") {
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:20px">Obat Rawat Inap</td>
        </tr>
        <?php
        foreach ($detail_obat_ri as $detail_rawat_inap_o) {
            $harga_obat_ri += $detail_rawat_inap_o->harga_jual * $detail_rawat_inap_o->qty;
        }
        ?>
        <tr>
            <td style="text-align:left;padding-left:40px">Biaya Obat-Obatan</td>
            <td style="text-align:right"><?php echo rupiah($harga_obat_ri) ?></td>
        </tr>
        <?php 
        }
        }
        ?>
        <!-- END Rincian Biaya Rawat Inap  -->


        <!-- Rincian Tindakan Lain Lain -->
        <?php 
        if ($cek_transaksi_lain2->num_rows() > 0) {
            foreach ($cek_transaksi_lain2->result() as $data_lain) {
                $no_transaksi_lain = $data_lain->no_transaksi_lain;
            }

            $where_no_transaksi_lain = array(
                'no_transaksi_lain' => $no_transaksi_lain
            );
            $detail_transaksi_lain = $this->M_tagihan->get_data('daftar_detail_transaksi_lain', $where_no_transaksi_lain)->result();
            foreach ($detail_transaksi_lain as $detail_lain) {
                $harga_lain += $detail_lain->qty * $detail_lain->harga;
            }
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px"><i>Lain-lain</i></td>
            <td style="text-align:right"><?php echo rupiah($harga_lain) ?></td>
        </tr>
        <?php 
        }
        ?>
        <!-- END Rincian Tindakan Lain Lain -->


        <!-- Rincian Biaya Ambulance -->
        <?php 
        if ($cek_pelayanan_ambulan2->num_rows() > 0) {
            foreach ($cek_pelayanan_ambulan2->result() as $data_ambulance) {
                $no_pelayanan_a = $data_ambulance->no_pelayanan_a;
            }

            $where_no_pelayanan_a = array(
                'no_pelayanan_a' => $no_pelayanan_a
            );
            $detail_pelayanan_ambulance = $this->M_tagihan->get_data('daftar_detail_pelayanan_ambulan', $where_no_pelayanan_a)->result();
            foreach ($detail_pelayanan_ambulance as $detail_ambulance) {
                $harga_ambulance += $detail_ambulance->harga;
            }
        ?>
        <tr>
            <td style="font-weight:bold;text-align:left;padding-left:10px"><i>Biaya Ambulance</i></td>
            <td style="text-align:right"><?php echo rupiah($harga_ambulance) ?></td>
        </tr>
        <?php 
        }
        $grand_total = $harga_tindakan_bp + $harga_tindakan_kia + $harga_tindakan_lab + $harga_tindakan_ugd + $harga_apotek_total + $harga_kamar_ri + $harga_tindakan_ri + $harga_obat_ri + $harga_lain + $harga_ambulance;
        ?>
        <!-- END Rincian Biaya Ambulance -->


        <tr style="line-height:50px;">
            <td style="font-weight:bold">Grand Total</td>
            <td style="text-align:right;font-weight:bold"><?php echo rupiah($grand_total) ?></td>
        </tr>
    </table>
    <hr>
    <p style="font-size:12px;"><?php echo date('d-m-Y H:i:s'); ?></p>
</body>

</html>
<script>

</script>
<script type="text/javascript">
    function PrintWindow() {
        window.print();
        CheckWindowState();
    }

    function CheckWindowState() {
        if (document.readyState == "complete") {
            window.close();
        } else {
            setTimeout("CheckWindowState()", 10)
        }
    }
    PrintWindow();
</script>