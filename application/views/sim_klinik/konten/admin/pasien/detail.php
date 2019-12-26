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
                <td width="25%">-</td>
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
        $total_tindakan = 0;
        if($layanan_tujuan == "Poli KIA") 
        {
            foreach($tindakan_kia as $data_kia):
                $total_tindakan += $data_kia->harga;
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
                $total_tindakan += $data_bp->harga;
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
                $total_tindakan += $data_lab->harga;
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
                $total_tindakan += $data_ugd->harga;
                echo '
                <tr>
                    <td class=""><h6 class="ml-4">'.$data_ugd->nama.'</h6></td>
                    <td class="text-right">'.rupiah($data_ugd->harga).'</td>
                </tr>';
                endforeach;
        }
        ?>
        <tr>
            <td><i>Biaya Obat-obatan</i></td>
        </tr>
        <tr>
            <?php
            $total_obat = 0; 
            foreach($detail_obat as $data_obat):
            $total_obat += $data_obat->harga_jual;
                echo '
                <tr>
                    <td class=""><h6 class="ml-4">'.$data_obat->nama.'</h6></td>
                    <td class="text-right">'.rupiah($data_obat->harga_jual).'</td>
                </tr>';
                endforeach;
            ?>
        </tr>
        </table>
        <?php 
        $grand_total = $total_tindakan + $total_obat;
        ?>
        <div style="clear:left;clear:right">
        <hr>
        <span style="float:left">Jumlah Yang Harus Dibayar</span>
        <span style="float:right"><?= rupiah($grand_total) ?></span>
        </div>

        </div>
		</div>
	</div>
</div>