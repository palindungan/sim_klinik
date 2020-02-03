<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Laporan Rawat Inap</h6>
		</div>
		<div class="card-body">
			<!-- <h5>Laporan Custom</h5>
			<form action="<?php echo base_url('laporan/rawatInap/ri_custom') ?>" method="post">
				<div class="row mb-3">
					<div class="col-md-3">
						<input id="datepicker_awal" placeholder="tanggal mulai" name="tgl_mulai" width="250" />
					</div>
					<div class="col-md-1">
						<h6 class="mt-2 text-center">Sampai</h6>
					</div>
					<div class="col-md-3">
						<input id="datepicker_akhir" placeholder="tanggal akhir" name="tgl_akhir" width="250" />
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-sm btn-success mt-1">Cetak Custom</button>
					</div>
				</div>
			</form> -->
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
					<!-- <div style="overflow-x:auto;">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center" width="250px;">Tanggal</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Uang&nbsp;Masuk</th>
									<th class="text-center">Gizi</th>
									<th class="text-center">Kamar</th>
									<th class="text-center">BP</th>
									<th class="text-center">LAB</th>
									<th class="text-center">KIA</th>
									<th class="text-center">UGD</th>
									<th class="text-center">Ambulance</th>
									<th class="text-center">Semua&nbsp;Obat</th>
									<th class="text-center">Obat&nbsp;Oral</th>
									<th class="text-center">Koperasi</th>
									<th class="text-center">Non Primer</th>
									<th class="text-center">Lain-Lain</th>
									<th class="text-center">Pemasukan&nbsp;Bersih</th>
									<th class="text-center">Japel</th>
									<th class="text-center">Visite</th>
									<th class="text-center">Klinik&nbsp;Bersih</th>
								</tr>
							</thead>
							<tbody>
								<?php 
							$nomor = 1;
							$gizi = 0;
							$japel = 0;
							$semua_obat = 0;
							$semua_oral = 0;
							foreach($ri_hari_ini as $row){
								$gizi =  $row->gizi_hari + $row->gizi_porsi;
					            $japel = $row->japel_hari + $row->japel_setengah;
								$tgl_keluar = date('d-m-Y',strtotime($row->tgl_keluar));
								$semua_obat = $row->obat_ri + $row->obat_apotik;
								$semua_oral = (int) $row->obat_oral_ri + (int) $row->obat_oral_apotik;
								$pemasukan_bersih = $row->uang_masuk - $gizi - $row->total_bp - $row->total_lab - $row->total_kia - $row->total_ugd - $row->biaya_ambulance - $semua_oral - $row->koperasi - $row->lain_lain;
								$klinik_bersih = $pemasukan_bersih - $japel - $row->visite;
							?>
								<tr>
									<td><?php echo $nomor++; ; ?></td>
									<td><?php echo $tgl_keluar; ?></td>
									<td><?php echo $row->nama_pasien ; ?></td>
									<td class="text-right"><?php echo rupiah($row->uang_masuk) ?></td>
									<td class="text-right"><?php echo rupiah($gizi) ?></td>
									<td class="text-right"><?php echo rupiah($row->kamar) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_bp) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_lab) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_kia) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_ugd) ?></td>
									<td class="text-right"><?php echo rupiah($row->biaya_ambulance) ?></td>
									<td class="text-right"><?php echo rupiah($semua_obat) ?></td>
									<td class="text-right"><?php echo rupiah($semua_oral) ?></td>
									<td class="text-right"><?php echo rupiah($row->koperasi) ?></td>
									<td class="text-right"><?php echo rupiah($row->tindakan_ri_non_primer) ?></td>
									<td class="text-right"><?php echo rupiah($row->lain_lain) ?></td>
									<td class="text-right"><?php echo rupiah($pemasukan_bersih) ?></td>
									<td class="text-right"><?php echo rupiah($japel) ?></td>
									<td class="text-right"><?php echo rupiah($row->visite) ?></td>
									<td class="text-right"><?php echo rupiah($klinik_bersih) ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div> -->
				</div>
				<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
					<!-- <a href="<?= base_url(); ?>laporan/rawatInap/ri_bulan_ini" class="btn btn-sm btn-success mb-3">Cetak
						Bulan</a>
					<div style="overflow-x:auto;">
						<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th class="text-center">No</th>
									<th class="text-center" width="250px;">Tanggal</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Uang&nbsp;Masuk</th>
									<th class="text-center">Gizi</th>
									<th class="text-center">Kamar</th>
									<th class="text-center">BP</th>
									<th class="text-center">LAB</th>
									<th class="text-center">KIA</th>
									<th class="text-center">UGD</th>
									<th class="text-center">Ambulance</th>
									<th class="text-center">Semua&nbsp;Obat</th>
									<th class="text-center">Obat&nbsp;Oral</th>
									<th class="text-center">Pemasukan&nbsp;Bersih</th>
									<th class="text-center">Japel</th>
									<th class="text-center">Visite</th>
									<th class="text-center">Klinik&nbsp;Bersih</th>
									<th class="text-center">Saldo</th>
								</tr>
							</thead>
							<tbody>
								<?php 
							$nomor = 1;
							$gizi = 0;
							$japel = 0;
							foreach($ri_bulan_ini as $row){
								$gizi =  $row->gizi_hari + $row->gizi_porsi;
					            $japel = $row->japel_hari + $row->japel_setengah;
								$tgl_keluar = date('d-m-Y',strtotime($row->tgl_keluar));
								$semua_obat = $row->obat_ri + $row->obat_apotik;
								$obat_oral = (int) $row->obat_oral;
								$pemasukan_bersih = $row->uang_masuk - $gizi - $row->kamar - $row->total_bp - $row->total_lab - $row->total_kia - $row->total_ugd - $row->biaya_ambulance - $semua_obat - $obat_oral;
								$klinik_bersih = $pemasukan_bersih - $japel - $row->visite;
							?>
								<tr>
									<td><?php echo $nomor++; ; ?></td>
									<td><?php echo $tgl_keluar; ; ?></td>
									<td><?php echo $row->nama_pasien ; ?></td>
									<td class="text-right"><?php echo rupiah($row->uang_masuk) ?></td>
									<td class="text-right"><?php echo rupiah($gizi) ?></td>
									<td class="text-right"><?php echo rupiah($row->kamar) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_bp) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_lab) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_kia) ?></td>
									<td class="text-right"><?php echo rupiah($row->total_ugd) ?></td>
									<td class="text-right"><?php echo rupiah($row->biaya_ambulance) ?></td>
									<td class="text-right"><?php echo rupiah($semua_obat) ?></td>
									<td class="text-right"><?php echo rupiah($obat_oral) ?></td>
									<td class="text-right"><?php echo rupiah($pemasukan_bersih) ?></td>
									<td class="text-right"><?php echo rupiah($japel) ?></td>
									<td class="text-right"><?php echo rupiah($row->visite) ?></td>
									<td class="text-right"><?php echo rupiah($klinik_bersih) ?></td>
									<td class="text-right"><?php echo rupiah($row->saldo) ?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div> -->
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
