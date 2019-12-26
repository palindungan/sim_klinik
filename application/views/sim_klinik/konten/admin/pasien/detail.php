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
            $layanan_tujuan = $pelayanan->layanan_tujuan;
            $nama_pasien = $pasien->nama;
        ?>
            <a href="<?= base_url('admin/pasien/list/'.$no_rm) ?>" class="btn btn-sm btn-dark">Kembali</a>
        <h5 class="text-center">Rekening Pasien</h5>
        <table width="100%">
            <tr>
                <td width="14%">Nama Pasien</td>
                <td width="1%">:</td>
                <td width="40%"><?= $nama_pasien ?></td>
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
                <td width="40%">-</td>
                <td width="19%">Tanggal Keluar</td>
                <td width="1%">:</td>
                <td width="25%">20-12-2019</td>
            </tr>
            <tr>
                <td width="14%">Tujuan</td>
                <td width="1%">:</td>
                <td width="40%"><?= $layanan_tujuan ?></td>
            </tr>
        </table>
        <hr>
        <span style="float:left">Rincian Transaksi</span>
        <span style="float:right">Biaya</span>
        
        <table align="right" width="98%">
        <tr>
            <td><i>Biaya Tindakan</i></td>
        </tr>
        <?php 
        if($layanan_tujuan == "Poli KIA") 
        {
            foreach($tindakan_kia as $data_kia):
                echo '
                <tr>
                    <td class=""><h6 class="ml-4">'.$data_kia->nama.'</h6></td>
                    <td class="text-right">'.rupiah($data_kia->harga).'</td>
                </tr>';
                endforeach;
        }
        else if($layanan_tujuan == "Balai Pengobatan")
        {
            foreach($tindakan_bp as $data_bp):
                echo '
                <tr>
                    <td class=""><h6 class="ml-4">'.$data_bp->nama.'</h6></td>
                    <td class="text-right">'.rupiah($data_bp->harga).'</td>
                </tr>';
                endforeach;
        }
        else if($layanan_tujuan == "Laboratorium")
        {
            foreach($tindakan_lab as $data_lab):
                echo '
                <tr>
                    <td class=""><h6 class="ml-4">'.$data_lab->nama.'</h6></td>
                    <td class="text-right">'.rupiah($data_lab->harga).'</td>
                </tr>';
                endforeach;
        }
        else if($layanan_tujuan == "UGD")
        {
            foreach($tindakan_ugd as $data_ugd):
                echo '
                <tr>
                    <td class=""><h6 class="ml-4">'.$data_ugd->nama.'</h6></td>
                    <td class="text-right">'.rupiah($data_ugd->harga).'</td>
                </tr>';
                endforeach;
        }
        ?>
        
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
</div>