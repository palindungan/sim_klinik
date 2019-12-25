<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Detail Pasien</h6>
		</div>
		<div class="card-body">
        <a href="<?= base_url('admin/pasien') ?>" class="btn btn-sm btn-dark">Kembali</a>
        <?php 
        foreach($pelayanan as $data_pelayanan):
            $no_ref = $data_pelayanan->no_ref_pelayanan; 
            $no_rm = $data_pelayanan->no_rm;    
            $tgl_pelayanan = $data_pelayanan->tgl_pelayanan;
        ?>
        <?php endforeach; ?>
        <?php 
        foreach($pasien as $data_pasien):
            $nama = $data_pasien->nama; 
        ?>
        <?php endforeach; ?>
        <h5 class="text-center">Rekening Pasien</h5>
        <table width="100%">
            <tr>
                <td width="14%">Nama Pasien</td>
                <td width="1%">:</td>
                <td width="40%"><?= $nama ?></td>
                <td width="19%">No Ref Pelayanan</td>
                <td width="1%">:</td>
                <td width="25%"><?= $no_ref ?></td>
            </tr>
            <tr>
                <td width="14%">Nomor RM</td>
                <td width="1%">:</td>
                <td width="40%"><?= $no_rm ?></td>
                <td width="19%">Tanggal Masuk</td>
                <td width="1%">:</td>
                <td width="25%"><?= date('d-m-Y H:i',strtotime($tgl_pelayanan)) ?></td>
            </tr>
            <tr>
                <td width="14%">Ruangan</td>
                <td width="1%">:</td>
                <td width="40%">Melati 2</td>
                <td width="19%">Tanggal Keluar</td>
                <td width="1%">:</td>
                <td width="25%">20-12-2019</td>
            </tr>
            <tr>
                <td width="14%">Keterangan</td>
                <td width="1%">:</td>
                <td width="40%">asd</td>
            </tr>
        </table>
        <hr>
        <span style="float:left">Rincian Transaksi</span>
        <span style="float:right">Biaya</span>
        
        <table align="right" width="98%">
        <tr>
            <td><i>Biaya Tindakan</i></td>
        </tr>
        <tr>
            <td class=""><h6 class="ml-4">Tindakan asd</h6></td>
            <td class="text-right">90.000</td>
        </tr>
        <tr>
            <td class=""><h6 class="ml-4">Tindakan Pemeriksaan kadar gula</h6></td>
            <td class="text-right">140.000</td>
        </tr>
        <tr>
            <td><i>Biaya Ruang Perawatan</i></td>
        </tr>
        <tr>
            <td class=""><h6 class="ml-4">Tindakan asd</h6></td>
            <td class="text-right">90.000</td>
        </tr>
        <tr>
            <td class=""><h6 class="ml-4">Tindakan Pemeriksaan kadar gula</h6></td>
            <td class="text-right">140.000</td>
        </tr>
        <tr>
            <td><i>Biaya Obat-obatan</i></td>
        </tr>
        <tr>
            <td class=""><h6 class="ml-4">Apotek</h6></td>
            <td class="text-right">90.000</td>
        </tr>
        </table>

		</div>
	</div>
</div>