<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Detail Pasien</h6>
		</div>
		<div class="card-body">
        <div class="container">
        <?php 
        $no_ref = $pelayanan->no_ref_pelayanan; 
        $no_rm = $pelayanan->no_rm;    
        $tgl_pelayanan = $pelayanan->tgl_pelayanan;
        $nama_pasien = $pasien->nama;
        ?>
        <a href="<?= base_url('admin/pasien/list/'.$no_rm) ?>" class="btn btn-sm btn-dark">Kembali</a>
        <h4 style="text-align:center">Rekening Pasien</h4>
                <table width="100%">
                <tr>
                    <td width="14%">Nama Pasien</td>
                    <td width="1%">:</td>
                    <td width="35%"><?= $nama_pasien ?></td>
                    <td width="19%">No Ref Pelayanan</td>
                    <td width="1%">:</td>
                    <td width="30%"><?= $no_ref ?></td>
                </tr>
                <tr>
                    <td width="14%">Nomor RM</td>
                    <td width="1%">:</td>
                    <td width="40%"><?= $no_rm ?></td>
                    <td width="19%">Tanggal</td>
                    <td width="1%">:</td>
                    <td width="25%"><?= $tgl_pelayanan ?></td>
                </tr>
            </table>
            <hr>
            <table width="100%">
                <tr>
                    <td style="text-align:left">Rincian Transaksi</td>
                    <td style="text-align:right">Biaya</td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Balai Pengobatan</i></td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">asd</td>
                    <td style="text-align:right">90.000</td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Poli KIA</i></td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">asd</td>
                    <td style="text-align:right">90.000</td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Laboratorium</i></td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">asd</td>
                    <td style="text-align:right">90.000</td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Tindakan UGD</i></td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">asd</td>
                    <td style="text-align:right">90.000</td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Obat-obatan</i></td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">Apotek</td>
                    <td style="text-align:right">90.000</td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:10px"><i>Biaya Rawat inap</i></td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">Kamar</td>
                    <td style="text-align:right">90.000</td>
                </tr>
                <tr>
                    <td style="text-align:left;padding-left:20px">Tindakan Rawat Inap</td>
                    <td style="text-align:right">90.000</td>
                </tr>
                <tr>
                        <td style="text-align:left;padding-left:20px">Obat Rawat Inap</td>
                        <td style="text-align:right">90.000</td>
                </tr>
                <tr style="line-height:50px;">
                        <td style="text-align:left;">Jumlah Yang Harus Dibayar</td>
                        <td style="text-align:right">90.000</td>
                </tr>
            </table>
        </div>
		</div>
	</div>
</div>