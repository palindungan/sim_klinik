<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
			<h6 class="m-0 font-weight-bold text-primary">Detail Kunjungan Pasien</h6>
			<div class="dropdown no-arrow">
				<?php $print_url = base_url('administrasi/tagihan/cetak/' . $pelayanan->no_ref_pelayanan); ?>
				<button onclick="window.open('<?php echo $print_url ?>','_blank')" class="btn btn-sm btn-primary"><i class="fa fa-print"></i> Cetak</button>
			</div>
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
				<table width="100%">
					<tr>
						<td width="14%" class="font-weight-bold">Nama</td>
						<td width="1%">:</td>
						<td width="35%"><?php echo $nama_pasien ?></td>
						<td width="19%" class="font-weight-bold">No Ref Pelayanan</td>
						<td width="1%">:</td>
						<td width="30%"><?php echo $no_ref ?></td>
					</tr>
					<tr>
						<td class="font-weight-bold">Nomor RM</td>
						<td>:</td>
						<td><?php echo $no_rm ?></td>
						<td class="font-weight-bold">Tanggal</td>
						<td>:</td>
						<td><?php echo date("d-m-Y H:i:s",strtotime($tgl_pelayanan)); ?></td>
					</tr>
				</table>
				<hr>
				<table width="100%">
					<tr>
						<td class="font-weight-bold">Rincian Transaksi</td>
						<td></td>
						<td></td>
						<td class="text-right font-weight-bold">Biaya</td>
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
						$harga_tindakan_lab += $tindakan_lab->harga * $tindakan_lab->qty;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $tindakan_lab->nama ?></td>
						<td style="text-align:right"><?php echo $tindakan_lab->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_lab->harga) ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_lab->harga * $tindakan_lab->qty) ?></td>
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
						$harga_tindakan_ugd += $tindakan_ugd->harga * $tindakan_ugd->qty;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $tindakan_ugd->nama ?></td>
						<td style="text-align:right"><?php echo $tindakan_ugd->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_ugd->harga) ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_ugd->harga * $tindakan_ugd->qty) ?></td>
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
						$harga_kamar_ri += $detail_rawat_inap_k->jumlah_hari * $detail_rawat_inap_k->harga_harian;
					?>
					<tr>
						<td style="text-align:left;padding-left:40px"><?php echo $detail_rawat_inap_k->nama ?></td>
						<td style="text-align:right"><?php echo $detail_rawat_inap_k->jumlah_hari." hari" ?></td>
						<td style="text-align:right"><?php echo rupiah($detail_rawat_inap_k->harga_harian) ?></td>
						<td style="text-align:right"><?php echo rupiah($detail_rawat_inap_k->jumlah_hari * $detail_rawat_inap_k->harga_harian) ?></td>
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
					
					
					?>

					<?php
					$harga_lain = 0;
                    if($no_transaksi_lain != "kosong"){ 
                        
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Lain-lain</i></td>
					</tr>
					<?php 
                    foreach($detail_tindakan_lain as $tindakan_lain)
                    {
						$harga_lain += $tindakan_lain->harga * $tindakan_lain->qty;
                    ?>
					<tr>
						<td style="text-align:left;padding-left:20px"><?php echo $tindakan_lain->nama ?></td>
						<td style="text-align:right"><?php echo $tindakan_lain->qty." x" ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_lain->harga) ?></td>
						<td style="text-align:right"><?php echo rupiah($tindakan_lain->harga * $tindakan_lain->qty) ?></td>
					</tr>
					<?php 
                    }
                    }
                    ?>

					<?php
					$harga_ambulance = 0;
                    if($no_pelayanan_a != "kosong"){
						foreach($data_ambulance as $row_ambulance)
						{
							$harga_ambulance += $row_ambulance->total_harga;
						} 
                    ?>
					<tr>
						<td style="text-align:left;padding-left:10px"><i>Biaya Ambulance</i></td>
						<td></td>
						<td></td>
						<td style="text-align:right"><?php echo rupiah($harga_ambulance) ?></td>
					</tr>
					<?php 
					}
					$grand_total = $harga_tindakan_bp + $harga_tindakan_kia + $harga_tindakan_lab + $harga_tindakan_ugd + $harga_penjualan_obat_a + $harga_kamar_ri + $harga_tindakan_ri + $harga_obat_ri + $harga_lain + $harga_ambulance;
					?>
					<tr style="line-height:50px;">
						<td class="font-weight-bold">Jumlah Yang Harus Dibayar</td>
						<td></td>
						<td></td>
						<td class="text-right font-weight-bold"><?php echo rupiah($grand_total) ?></td>
					</tr>

				</table>
			</div>
		</div>
	</div>
</div>
