<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Laporan Rawat Inap</h6>
		</div>
		<div class="card-body">
			<h5>Laporan Custom</h5>
				<form action="<?php echo base_url('admin/laporan/rj_custom') ?>" method="post">
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
				</form>
		<nav class="mb-3">
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Hari Ini</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bulan Ini</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			
				<a href="<?= base_url(); ?>laporan/rawatInap/ri_hari_ini" class="btn btn-sm btn-success mb-3">Cetak Hari</a>
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
								<th class="text-center">UGD</th>
								<th class="text-center">Apotik</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
                                <td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
				<a href="<?= base_url(); ?>admin/laporan/rj_bulan_ini" class="btn btn-sm btn-success mb-3">Cetak Bulan</a>
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
								<th class="text-center">UGD</th>
								<th class="text-center">Apotik</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
								<td>asd</td>
							</tr>
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