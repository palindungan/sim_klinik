<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Laporan Rawat Jalan</h6>
		</div>
		<div class="card-body">
			<h5>Laporan Custom</h5>
				<form action="<?php echo base_url('laporan/rawatJalan/rj_custom') ?>" method="post">
					<div class="row mb-3">
							<div class="col-md-3">
								<input type="date" class="form-control form-control-sm" placeholder="Tanggal Mulai" name="tgl_mulai">
							</div>
							<div class="col-md-1">
								<h6 class="mt-2 text-center">Sampai</h6>
							</div>
							<div class="col-md-3">
								<input type="date" class="form-control form-control-sm" placeholder="Tanggal Mulai" name="tgl_akhir">
							</div>
							<div class="col-md-2">
								<button type="submit" class="btn btn-sm btn-success">Cetak Custom</button>
							</div>
					</div>
				</form>
		<nav class="mb-3">
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Hari Ini</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bulan Ini</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			
				<a href="<?= base_url(); ?>laporan/rawatJalan/rj_hari_ini" class="btn btn-sm btn-success mb-3">Cetak Hari</a>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Nama Pasien</th>
								<th class="text-center">GD</th>
								<th class="text-center">AU</th>
								<th class="text-center">Chol</th>
								<th class="text-center">BP</th>
								<th class="text-center">LAB</th>
								<th class="text-center">KIA</th>
								<th class="text-center">Apotik</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$no_hari = 1;
						$grand_total_hari = 0;
						foreach($rj_hari as $row_hari) 
						{
						$tanggal_hari = date('d-m-Y',strtotime($row_hari->tgl_pelayanan));
						$grand_total_hari = $row_hari->gula_darah + $row_hari->asam_urat + $row_hari->cholesterol + $row_hari->total_bp + $row_hari->lab_non_primer + $row_hari->total_kia + $row_hari->total_obat_apotik;
						?>
							<tr>
								<td><?php echo $no_hari++ ?></td>
								<td><?php echo $tanggal_hari ?></td>
								<td><?php echo $row_hari->nama_pasien ?></td>
								<td class="text-right"><?php echo ($row_hari->gula_darah == NULL) ? '0' : rupiah($row_hari->gula_darah);  ?></td>
								<td class="text-right"><?php echo ($row_hari->asam_urat == NULL) ? '0' : rupiah($row_hari->asam_urat);  ?></td>
								<td class="text-right"><?php echo ($row_hari->cholesterol == NULL) ? '0' : rupiah($row_hari->cholesterol);  ?></td>
								<td class="text-right"><?php echo ($row_hari->total_bp == NULL) ? '0' : rupiah($row_hari->total_bp);  ?></td>
								<td class="text-right"><?php echo ($row_hari->lab_non_primer == NULL) ? '0' : rupiah($row_hari->lab_non_primer);  ?></td>
								<td class="text-right"><?php echo ($row_hari->total_kia == NULL) ? '0' : rupiah($row_hari->total_kia);  ?></td>
								<td class="text-right"><?php echo ($row_hari->total_obat_apotik == NULL) ? '0' : rupiah($row_hari->total_obat_apotik);  ?></td>
								<td class="text-right"><?php echo rupiah($grand_total_hari) ?></td>
							</tr>
						<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<a href="<?= base_url(); ?>laporan/rawatJalan/rj_bulan_ini" class="btn btn-sm btn-success mb-3">Cetak Bulan</a>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Nama Pasien</th>
								<th class="text-center">GD</th>
								<th class="text-center">AU</th>
								<th class="text-center">Chol</th>
								<th class="text-center">BP</th>
								<th class="text-center">LAB</th>
								<th class="text-center">KIA</th>
								<th class="text-center">Apotik</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$no_bulan = 1;
						$grand_total_bulan = 0;
						foreach($rj_bulan as $row_bulan) 
						{
						$tanggal_bulan = date('d-m-Y',strtotime($row_bulan->tgl_pelayanan));
						$grand_total_bulan = $row_bulan->gula_darah + $row_bulan->asam_urat + $row_bulan->cholesterol + $row_bulan->total_bp + $row_bulan->lab_non_primer + $row_bulan->total_kia + $row_bulan->total_obat_apotik;
						?>
							<tr>
								<td><?php echo $no_bulan++ ?></td>
								<td><?php echo $tanggal_bulan ?></td>
								<td><?php echo $row_bulan->nama_pasien ?></td>
								<td class="text-right"><?php echo ($row_bulan->gula_darah == NULL) ? '0' : rupiah($row_bulan->gula_darah);  ?></td>
								<td class="text-right"><?php echo ($row_bulan->asam_urat == NULL) ? '0' : rupiah($row_bulan->asam_urat);  ?></td>
								<td class="text-right"><?php echo ($row_bulan->cholesterol == NULL) ? '0' : rupiah($row_bulan->cholesterol);  ?></td>
								<td class="text-right"><?php echo ($row_bulan->total_bp == NULL) ? '0' : rupiah($row_bulan->total_bp);  ?></td>
								<td class="text-right"><?php echo ($row_bulan->lab_non_primer == NULL) ? '0' : rupiah($row_bulan->lab_non_primer);  ?></td>
								<td class="text-right"><?php echo ($row_bulan->total_kia == NULL) ? '0' : rupiah($row_bulan->total_kia);  ?></td>
								<td class="text-right"><?php echo ($row_bulan->total_obat_apotik == NULL) ? '0' : rupiah($row_bulan->total_obat_apotik);  ?></td>
								<td class="text-right"><?php echo rupiah($grand_total_bulan) ?></td>
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