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
        $tipe_pelayanan = $pelayanan->tipe_pelayanan;
        $nama_pasien = $pasien->nama;
        ?>
				<a href="<?php echo base_url('admin/pasien/list/'.$no_rm) ?>" class="btn btn-sm btn-dark">Kembali</a>
				<h4 style="text-align:center">Rekening Pasien</h4>
				<table width="100%">
					<tr>
						<td width="14%">Nama</td>
						<td width="1%">:</td>
						<td width="35%"><?php echo $nama_pasien ?></td>
						<td width="19%">No Ref Pelayanan</td>
						<td width="1%">:</td>
						<td width="30%"><?php echo $no_ref ?></td>
					</tr>
					<tr>
						<td width="14%">Nomor RM</td>
						<td width="1%">:</td>
						<td width="40%"><?php echo $no_rm ?></td>
						<td width="19%">Tanggal</td>
						<td width="1%">:</td>
						<td width="25%"><?php echo $tgl_pelayanan ?></td>
					</tr>
				</table>
				<hr>
				<table width="100%">
					<tr>
						<td style="text-align:left">Rincian Transaksi</td>
						<td></td>
						<td></td>
						<td style="text-align:right">Biaya</td>
					</tr>
					<?php
					$harga_tindakan_bp = 0;
                    if($no_bp_p != "kosong"){ 
                        
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Balai Pengobatan</i></td>
					</tr>
					<?php 
                    foreach($detail_tindakan_bp as $tindakan_bp)
                    {
						$harga_tindakan_bp += $tindakan_bp->harga_detail * $tindakan_bp->qty;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $tindakan_bp->nama ?></td>
						<td style="text-align:right"><?php echo $tindakan_bp->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_bp->harga_detail) ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_bp->harga_detail * $tindakan_bp->qty) ?></td>
					</tr>
					<?php 
                    }
                    }
                    ?>

					<?php
					$harga_tindakan_kia = 0;
                    if($no_kia_p != "kosong"){ 
                        
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Poli KIA</i></td>
					</tr>
					<?php 
                    foreach($detail_tindakan_kia as $tindakan_kia)
                    {
						$harga_tindakan_kia += $tindakan_kia->harga * $tindakan_kia->qty;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $tindakan_kia->nama ?></td>
						<td style="text-align:right"><?php echo $tindakan_kia->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_kia->harga) ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_kia->harga * $tindakan_kia->qty) ?></td>
					</tr>
					<?php 
					}
					}
					?>

					<?php
					$harga_tindakan_lab = 0;
                    if($no_lab_t != "kosong"){ 
                        
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Tindakan Laboratorium</i></td>
					</tr>
					<?php 
                    foreach($detail_tindakan_lab as $tindakan_lab)
                    {
						$harga_tindakan_lab += $tindakan_lab->harga;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $tindakan_lab->nama ?></td>
						<td style="text-align:right"><?php echo $tindakan_lab->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_lab->harga) ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_lab->harga) ?></td>
					</tr>
					<?php 
					}
					}
					?>

					<?php
					$harga_tindakan_ugd = 0;
                    if($no_ugd_p != "kosong"){ 
                        
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Tindakan UGD</i></td>
					</tr>
					<?php 
                    foreach($detail_tindakan_ugd as $tindakan_ugd)
                    {
						$harga_tindakan_ugd += $tindakan_ugd->harga;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $tindakan_ugd->nama ?></td>
						<td style="text-align:right"><?php echo $tindakan_ugd->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_ugd->harga) ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_ugd->harga) ?></td>
					</tr>
					<?php 
					}
					}
					?>

					<?php
					$harga_penjualan_obat_a = 0;
                    if($no_penjualan_obat_a != "kosong"){ 
                        
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Obat Apotek</i></td>
					</tr>
					<?php 
                    foreach($detail_penjualan_obat_apotik as $penjualan_obat_apotik)
                    {
						if($penjualan_obat_apotik->status_paket == "Ya")
						{
							$penjualan_obat_apotik->harga_jual = 0;
						}
						$harga_penjualan_obat_a += $penjualan_obat_apotik->qty * $penjualan_obat_apotik->harga_jual;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $penjualan_obat_apotik->nama ?></td>
						<td style="text-align:right"><?php echo $penjualan_obat_apotik->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($penjualan_obat_apotik->harga_jual) ?></td>
						<td style="text-align:right">
							<?php echo rupiah($penjualan_obat_apotik->qty * $penjualan_obat_apotik->harga_jual) ?></td>
					</tr>
					<?php 
					}
					}
					?>

					<?php
					$harga_kamar_ri = 0;
					$harga_tindakan_ri = 0;
					$harga_obat_ri = 0;
                    if($no_transaksi_rawat_i != "kosong"){ 
                        
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Rawat inap</i></td>
					</tr>
					<tr>
						<td style="text-align:left;padding-left:20px">Kamar</td>
					</tr>
					<?php 
					foreach($detail_transaksi_rawat_inap_k as $detail_rawat_inap_k) 
					{
						$cek_out = $detail_rawat_inap_k->tanggal_cek_out;
						$cek_in = $detail_rawat_inap_k->tanggal_cek_in;
						$format_cek_in = date('Y-m-d',strtotime($cek_in));
						$format_cek_out = date('Y-m-d',strtotime($cek_out));
						$tanggal_cek_in = new DateTime($format_cek_in);
						$tanggal_cek_out = new DateTime($format_cek_out);
						$lama_hari = $tanggal_cek_out->diff($tanggal_cek_in)->format("%a") + 1;
						$harga_kamar_ri += $lama_hari * $detail_rawat_inap_k->harga_harian;
					?>
					<tr>
						<td style="text-align:left;padding-left:40px"><?php echo $detail_rawat_inap_k->nama ?></td>
						<td style="text-align:right"><?php echo $lama_hari." hari" ?></td>
						<td style="text-align:right"><?php echo rupiah($detail_rawat_inap_k->harga_harian) ?></td>
						<td style="text-align:right"><?php echo rupiah($lama_hari * $detail_rawat_inap_k->harga_harian) ?></td>
					</tr>
					<?php 
					}
					?>
					<tr>
						<td style="text-align:left;padding-left:20px">Tindakan Rawat Inap</td>
					</tr>
					<?php 
					foreach($detail_transaksi_rawat_inap_t as $detail_rawat_inap_t) 
					{
						$harga_tindakan_ri += $detail_rawat_inap_t->harga * $detail_rawat_inap_t->qty;
					?>
					<tr>
						<td style="text-align:left;padding-left:40px"><?php echo $detail_rawat_inap_t->nama ?></td>
						<td style="text-align:right"><?php echo $detail_rawat_inap_t->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($detail_rawat_inap_t->harga) ?></td>
						<td style="text-align:right"><?php echo rupiah($detail_rawat_inap_t->harga * $detail_rawat_inap_t->qty) ?></td>
					</tr>
					<?php
					}
					?>
					<tr>
						<td style="text-align:left;padding-left:20px">Obat Rawat Inap</td>
					</tr>
					<?php 
					foreach($detail_transaksi_rawat_inap_o as $detail_rawat_inap_o) 
					{
						$harga_obat_ri += $detail_rawat_inap_o->qty * $detail_rawat_inap_o->harga_jual;
					?>
					<tr>
						<td style="text-align:left;padding-left:40px"><?php echo $detail_rawat_inap_o->nama_obat ?></td>
						<td style="text-align:right"><?php echo $detail_rawat_inap_o->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($detail_rawat_inap_o->harga_jual) ?></td>
						<td style="text-align:right">
							<?php echo rupiah($detail_rawat_inap_o->qty * $detail_rawat_inap_o->harga_jual) ?></td>
					</tr>
					<?php
					}
					?>

					<?php 
					}
					$grand_total = $harga_tindakan_bp + $harga_tindakan_kia + $harga_tindakan_lab + $harga_tindakan_ugd + $harga_penjualan_obat_a + $harga_kamar_ri + $harga_tindakan_ri + $harga_obat_ri;
					?>
					<tr style="line-height:50px;">
						<td style="text-align:left;">Jumlah Yang Harus Dibayar</td>
						<td></td>
						<td></td>
						<td style="text-align:right"><?php echo rupiah($grand_total) ?></td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>
