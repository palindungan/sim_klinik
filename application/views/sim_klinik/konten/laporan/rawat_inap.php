<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Laporan Rawat Inap</h6>
		</div>
		<div class="card-body">
			<h5>Laporan Custom</h5>
			<form action="<?php echo base_url('laporan/rawatInap/ri_custom') ?>" method="post">
				<div class="row mb-3">
					<div class="col-md-3">
						<input type="date" class="form-control form-control-sm" placeholder="Tanggal Mulai" name="tgl_mulai"/>
					</div>
					<div class="col-md-1">
						<h6 class="mt-2 text-center">Sampai</h6>
					</div>
					<div class="col-md-3">
						<input type="date" class="form-control form-control-sm" placeholder="Tanggal Akhir" name="tgl_akhir"/>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-sm btn-success mt-1">Cetak Custom</button>
					</div>
				</div>
			</form>
			<nav class="mb-3">
				<div class="nav nav-tabs" id="nav-tab" role="tablist">
					<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab"
						aria-controls="nav-home" aria-selected="true">Hari Ini</a>
					<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab"
						aria-controls="nav-profile" aria-selected="false">Bulan Ini</a>
				</div>
			</nav>
			<div class="tab-content" id="nav-tabContent">
				<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

					<a href="<?= base_url(); ?>laporan/rawatInap/ri_hari_ini" class="btn btn-sm btn-success mb-3">Cetak
						Hari</a>
					<div style="overflow-x:auto;">
						<table class="table table-bordered table-sm" id="dataTable3" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th class="text-center" rowspan="2">No.</th>
									<th class="text-center" rowspan="2">Uraian</th>
									<th class="text-center" rowspan="2">Uang&nbsp;Masuk</th>
									<th class="text-center" colspan="8">Pengeluaran</th>
									<th class="text-center" rowspan="2">Pemasukan&nbsp;Bersih</th>
									<th class="text-center" colspan="3">Akomodasi</th>
									<th class="text-center" rowspan="2">Sisa&nbsp;Per&nbsp;Hari</th>
									<th class="text-center" rowspan="2">Japel</th>
									<th class="text-center" rowspan="2">Visite</th>
									<th class="text-center" rowspan="2">Klinik</th>
									<th class="text-center" rowspan="2">Setoran</th>
									<th class="text-center" rowspan="2">Saldo</th>
								</tr>
								<tr>
									<th class="text-center">Gizi</th>
									<th class="text-center">GDA</th>
									<th class="text-center">LAB</th>
									<th class="text-center">AMB</th>
									<th class="text-center">KIA</th>
									<th class="text-center">EKG</th>
									<th class="text-center">Lain2</th>
									<th class="text-center">Oral</th>
									<th class="text-center">Obat</th>
									<th class="text-center">Alkes</th>
									<th class="text-center">Lain2</th>
								</tr>
							</thead>
							<tbody>
							<?php 
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

							//Loop Data Transaksi Per Hari
							foreach($ri_harian as $row){
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

								
								if($row->tipe_pelayanan == "Rawat Inap"){
							?>
								<tr>
									<td><?php echo $nomor++; ; ?></td>
									<td><?php echo $row->nama_pasien ; ?></td>
									<td class="text-right"><?php echo rupiah($uang_masuk); ?></td>
									<td class="text-right"><?php echo rupiah($gizi); ?></td>
									<td class="text-right"><?php echo rupiah($gda); ?></td>
									<td class="text-right"><?php echo rupiah($lab); ?></td>
									<td class="text-right"><?php echo rupiah($biaya_ambulance); ?></td>
									<td class="text-right"><?php echo rupiah($total_kia); ?></td>
									<td class="text-right"><?php echo rupiah($ekg); ?></td>
									<td class="text-right"><?php echo rupiah($lain_lain); ?></td>
									<td class="text-right"><?php echo rupiah($obat_oral_ri); ?></td>
									<td class="text-right"><?php echo rupiah($pemasukan_bersih); ?></td>
									<td class="text-right"><?php echo 0; ?></td>
									<td class="text-right"><?php echo 0; ?></td>
									<td class="text-right"><?php echo 0; ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($japel) ?></td>
									<td class="text-right"><?php echo rupiah($visite) ?></td>
									<td class="text-right"><?php echo rupiah($klinik_bersih) ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo += $pemasukan_bersih); ?></td>
									
								</tr>
								<?php 
								}else if($row->tipe_pelayanan == "IGD"){
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
								}else if($row->tipe_pelayanan == "Rawat Jalan"){ //End If IGD, Start IG Rawat Jalan
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

							} 
								if($jumlah_pasien_igd > 0){
							?>
								<!-- Menampilkan Total IGD -->
								<tr>
									<td><?php echo $nomor++; ?></td>
									<td>IGD</td>
									<td class="text-right"><?php echo rupiah($IGD_uang_masuk); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_gizi); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_gda); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_lab); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_biaya_ambulance); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_total_kia); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_ekg); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_lain_lain); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_obat_oral_ri); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_pemasukan_bersih); ?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($IGD_japel) ?></td>
									<td class="text-right"><?php echo rupiah($IGD_visite) ?></td>
									<td class="text-right"><?php echo rupiah($IGD_klinik_bersih) ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo += $IGD_pemasukan_bersih); ?></td>
								</tr>
							<?php
								}
								if($jumlah_pasien_rj > 0){
							?>
								<!-- Menampilkan Total Rawat Jalan -->
								<tr>
									<td><?php echo $nomor++; ?></td>
									<td>BP/Rawat Inap</td>
									<td class="text-right"><?php echo rupiah($RJ_uang_masuk); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_gizi); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_gda); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_lab); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_biaya_ambulance); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_total_kia); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_ekg); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_lain_lain); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_obat_oral_ri); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_pemasukan_bersih); ?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($RJ_japel) ?></td>
									<td class="text-right"><?php echo rupiah($RJ_visite) ?></td>
									<td class="text-right"><?php echo rupiah($RJ_klinik_bersih) ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo += $RJ_pemasukan_bersih); ?></td>
								</tr>
							<?php
								}
								if($jumlah_trx_akomodasi > 0){
							?>
								<!-- Jumlah Akomodasi -->
								<tr>
									<td><?php echo $nomor++; ?></td>
									<td>Akomodasi</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($AK_akomodasi_obat); ?></td>
									<td class="text-right"><?php echo rupiah($AK_akomodasi_alkes); ?></td>
									<td class="text-right"><?php echo rupiah($AK_akomodasi_lain); ?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo -= ($AK_akomodasi_obat + $AK_akomodasi_alkes + $AK_akomodasi_lain)); ?></td>
								</tr>
							<?php
								}
								if($jumlah_trx_setoran > 0){
							?>
								<!-- Jumlah Setoran -->
								<tr>
									<td colspan="2" class="font-weight-bold">Setoran</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($SETORAN_jumlah_setoran); ?></td>
									<td class="text-right"><?php echo rupiah($grand_saldo -= $SETORAN_jumlah_setoran); ?></td>
								</tr>
							<?php } ?>
								<!-- Grand Total -->
								<?php
								for($i=0;$i<$jumlah_pasien_paket_rj;$i++){
									$GT_uang_masuk += $uang_masuk_bp_ke_ri;
									$GT_obat_oral_ri += $potong_obat_oral; 
									$GT_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri; 
								}
								?>
								<tr>
									<td colspan="2" class="font-weight-bold">Total</td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_uang_masuk); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_gizi); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_gda); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_lab); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_biaya_ambulance); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_total_kia); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_ekg); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_lain_lain); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_obat_oral_ri); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_pemasukan_bersih); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_akomodasi_obat); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_akomodasi_alkes); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_akomodasi_lain); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($grand_saldo); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_japel) ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_visite) ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_klinik_bersih) ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_jumlah_setoran) ?></td>
									<td></td>
								</tr>
								
							</tbody>
						</table>
					</div>
				</div>
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<a href="<?= base_url(); ?>laporan/rawatInap/ri_bulan_ini" class="btn btn-sm btn-success mb-3">Cetak
						Bulan</a>
					<div style="overflow-x:auto;">
						<table class="table table-bordered table-sm" id="" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th class="text-center" rowspan="2">No.</th>
									<th class="text-center" rowspan="2">Uraian</th>
									<th class="text-center" rowspan="2">Uang&nbsp;Masuk</th>
									<th class="text-center" colspan="8">Pengeluaran</th>
									<th class="text-center" rowspan="2">Pemasukan&nbsp;Bersih</th>
									<th class="text-center" colspan="3">Akomodasi</th>
									<th class="text-center" rowspan="2">Sisa&nbsp;Per&nbsp;Hari</th>
									<th class="text-center" rowspan="2">Japel</th>
									<th class="text-center" rowspan="2">Visite</th>
									<th class="text-center" rowspan="2">Klinik</th>
									<th class="text-center" rowspan="2">Setoran</th>
									<th class="text-center" rowspan="2">Saldo</th>

								</tr>
								<tr>
									<th class="text-center">Gizi</th>
									<th class="text-center">GDA</th>
									<th class="text-center">LAB</th>
									<th class="text-center">AMB</th>
									<th class="text-center">KIA</th>
									<th class="text-center">EKG</th>
									<th class="text-center">Lain2</th>
									<th class="text-center">Oral</th>
									<th class="text-center">Obat</th>
									<th class="text-center">Alkes</th>
									<th class="text-center">Lain2</th>
								</tr>
							</thead>
							<tbody>
							<?php 
							foreach($data_bulanan as $day=>$yesterday_saldo){
							?>	
								<tr>
									<td colspan="21" class="font-weight-bolder"><?php echo "--".$day."--"; ?></td>
								</tr>
							<?php 
							//Get Saldo Kemarin
							$grand_saldo = $yesterday_saldo; //Diambil Record Hari Kemarin Dari Tabel Saldo Temp
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

							//Loop Data Transaksi Per Hari
							foreach($ri_bulanan[$day] as $row){
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

								
								if($row->tipe_pelayanan == "Rawat Inap"){
							?>
								<tr>
									<td><?php echo $nomor++; ; ?></td>
									<td><?php echo $row->nama_pasien ; ?></td>
									<td class="text-right"><?php echo rupiah($uang_masuk); ?></td>
									<td class="text-right"><?php echo rupiah($gizi); ?></td>
									<td class="text-right"><?php echo rupiah($gda); ?></td>
									<td class="text-right"><?php echo rupiah($lab); ?></td>
									<td class="text-right"><?php echo rupiah($biaya_ambulance); ?></td>
									<td class="text-right"><?php echo rupiah($total_kia); ?></td>
									<td class="text-right"><?php echo rupiah($ekg); ?></td>
									<td class="text-right"><?php echo rupiah($lain_lain); ?></td>
									<td class="text-right"><?php echo rupiah($obat_oral_ri); ?></td>
									<td class="text-right"><?php echo rupiah($pemasukan_bersih); ?></td>
									<td class="text-right"><?php echo 0; ?></td>
									<td class="text-right"><?php echo 0; ?></td>
									<td class="text-right"><?php echo 0; ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($japel) ?></td>
									<td class="text-right"><?php echo rupiah($visite) ?></td>
									<td class="text-right"><?php echo rupiah($klinik_bersih) ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo += $pemasukan_bersih); ?></td>
									
								</tr>
								<?php 
								}else if($row->tipe_pelayanan == "IGD"){
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
								}else if($row->tipe_pelayanan == "Rawat Jalan"){ //End If IGD, Start IG Rawat Jalan
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

							} 
								if($jumlah_pasien_igd > 0){
							?>
								<!-- Menampilkan Total IGD -->
								<tr>
									<td><?php echo $nomor++; ?></td>
									<td>IGD</td>
									<td class="text-right"><?php echo rupiah($IGD_uang_masuk); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_gizi); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_gda); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_lab); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_biaya_ambulance); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_total_kia); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_ekg); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_lain_lain); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_obat_oral_ri); ?></td>
									<td class="text-right"><?php echo rupiah($IGD_pemasukan_bersih); ?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($IGD_japel) ?></td>
									<td class="text-right"><?php echo rupiah($IGD_visite) ?></td>
									<td class="text-right"><?php echo rupiah($IGD_klinik_bersih) ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo += $IGD_pemasukan_bersih); ?></td>
								</tr>
							<?php
								}
								if($jumlah_pasien_rj > 0){
							?>
								<!-- Menampilkan Total Rawat Jalan -->
								<tr>
									<td><?php echo $nomor++; ?></td>
									<td>BP/Rawat Inap</td>
									<td class="text-right"><?php echo rupiah($RJ_uang_masuk); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_gizi); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_gda); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_lab); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_biaya_ambulance); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_total_kia); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_ekg); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_lain_lain); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_obat_oral_ri); ?></td>
									<td class="text-right"><?php echo rupiah($RJ_pemasukan_bersih); ?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($RJ_japel) ?></td>
									<td class="text-right"><?php echo rupiah($RJ_visite) ?></td>
									<td class="text-right"><?php echo rupiah($RJ_klinik_bersih) ?></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo += $RJ_pemasukan_bersih); ?></td>
								</tr>
							<?php
								}
								if($jumlah_trx_akomodasi > 0){
							?>
								<!-- Jumlah Akomodasi -->
								<tr>
									<td><?php echo $nomor++; ?></td>
									<td>Akomodasi</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($AK_akomodasi_obat); ?></td>
									<td class="text-right"><?php echo rupiah($AK_akomodasi_alkes); ?></td>
									<td class="text-right"><?php echo rupiah($AK_akomodasi_lain); ?></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($grand_saldo -= ($AK_akomodasi_obat + $AK_akomodasi_alkes + $AK_akomodasi_lain)); ?></td>
								</tr>
							<?php
								}
								if($jumlah_trx_setoran > 0){
							?>
								<!-- Jumlah Setoran -->
								<tr>
									<td colspan="2">Setoran</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
									<td class="text-right"><?php echo rupiah($SETORAN_jumlah_setoran); ?></td>
									<td class="text-right"><?php echo rupiah($grand_saldo -= $SETORAN_jumlah_setoran); ?></td>
								</tr>
							<?php } ?>
								<!-- Grand Total -->
								<?php
								for($i=0;$i<$jumlah_pasien_paket_rj;$i++){
									$GT_uang_masuk += $uang_masuk_bp_ke_ri;
									$GT_obat_oral_ri += $potong_obat_oral; 
									$GT_pemasukan_bersih += $pemasukan_bersih_bp_ke_ri; 
								}
								?>
								<tr>
									<td colspan="2" class="font-weight-bold">Total</td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_uang_masuk); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_gizi); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_gda); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_lab); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_biaya_ambulance); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_total_kia); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_ekg); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_lain_lain); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_obat_oral_ri); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_pemasukan_bersih); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_akomodasi_obat); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_akomodasi_alkes); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_akomodasi_lain); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($grand_saldo); ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_japel) ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_visite) ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_klinik_bersih) ?></td>
									<td class="text-right font-weight-bold"><?php echo rupiah($GT_jumlah_setoran) ?></td>
									<td></td>
								</tr>
							<?php } ?>
								
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/gijgo.min.js" type="text/javascript"></script>
<script>
	$('#datepicker_awal').datepicker({
		format: 'dd-mm-yyyy',
		uiLibrary: 'bootstrap4'
	});
	$('#datepicker_akhir').datepicker({
		format: 'dd-mm-yyyy',
		uiLibrary: 'bootstrap4'
	});

</script>
