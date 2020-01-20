<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Laporan Rawat Jalan</h6>
		</div>
		<div class="card-body">
		<nav class="mb-3">
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Hari Ini</a>
				<a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Bulan Ini</a>
			</div>
		</nav>
		<div class="tab-content" id="nav-tabContent">
			<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
			
				<a href="<?= base_url(); ?>admin/laporan/rj_hari_ini" class="btn btn-sm btn-success mb-3">Cetak Hari</a>
				<div class="table-responsive">
					<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama Pasien</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Gula Darah</th>
								<th class="text-center">Asam Urat</th>
								<th class="text-center">Kolesterol</th>
								<th class="text-center">Lain-lain</th>
								<th class="text-center">Periksa</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$no_hari = 1;
						foreach($rj_hari as $row_hari) 
						{
						$tanggal_hari = date('Y-m-d',strtotime($row_hari->tgl_pelayanan));
						?>
							<tr>
								<td><?php echo $no_hari++ ?></td>
								<td><?php echo $row_hari->nama_pasien ?></td>
								<td><?php echo tgl_indo($tanggal_hari) ?></td>
								<td class="text-right"><?php echo rupiah($row_hari->periksa_gula_darah) ?></td>
								<td class="text-right"><?php echo rupiah($row_hari->periksa_asam_urat) ?></td>
								<td class="text-right"><?php echo rupiah($row_hari->periksa_kolesterol) ?></td>
								<td class="text-right"><?php echo rupiah($row_hari->total_harga - ($row_hari->periksa_gula_darah +
            $row_hari->periksa_asam_urat + $row_hari->periksa_kolesterol + $row_hari->biaya_periksa)) ?></td>
								<td class="text-right"><?php echo rupiah($row_hari->biaya_periksa) ?></td>
								<td class="text-right"><?php echo rupiah($row_hari->total_harga) ?></td>
							</tr>
						<?php } ?>
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
								<th class="text-center">Nama Pasien</th>
								<th class="text-center">Tanggal</th>
								<th class="text-center">Gula Darah</th>
								<th class="text-center">Asam Urat</th>
								<th class="text-center">Kolesterol</th>
								<th class="text-center">Lain-lain</th>
								<th class="text-center">Periksa</th>
								<th class="text-center">Total</th>
							</tr>
						</thead>
						<tbody>
						<?php 
						$no_bulan = 1;
						foreach($rj_bulan as $row_bulan) 
						{
						$tanggal_bulan = date('Y-m-d',strtotime($row_bulan->tgl_pelayanan));
						?>
							<tr>
								<td><?php echo $no_bulan++ ?></td>
								<td><?php echo $row_bulan->nama_pasien ?></td>
								<td><?php echo tgl_indo($tanggal_bulan) ?></td>
								<td class="text-right"><?php echo rupiah($row_bulan->periksa_gula_darah) ?></td>
								<td class="text-right"><?php echo rupiah($row_bulan->periksa_asam_urat) ?></td>
								<td class="text-right"><?php echo rupiah($row_bulan->periksa_kolesterol) ?></td>
								<td class="text-right"><?php echo rupiah($row_bulan->total_harga - ($row_bulan->periksa_gula_darah +
            $row_bulan->periksa_asam_urat + $row_bulan->periksa_kolesterol + $row_bulan->biaya_periksa)) ?></td>
								<td class="text-right"><?php echo rupiah($row_bulan->biaya_periksa) ?></td>
								<td class="text-right"><?php echo rupiah($row_bulan->total_harga) ?></td>
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
