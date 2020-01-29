<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Return Obat</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Kode</th>
							<th class="text-center">Tanggal</th>
							<th class="text-center">Waktu</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no = 1;
						foreach ($record as $data) :
							$tanggal = tgl_indo(date('Y-m-d',strtotime($data->tanggal)));
							$waktu = date('H:i',strtotime($data->tanggal));
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $data->no_return_obat ?></td>
							<td><?= $tanggal ?></td>
							<td><?= $waktu ?></td>
							<td class="text-center">
								<a href="<?= base_url('apotek/return_obat/tampil_detail_daftar_return_obat?no_return_obat=' . $data->no_return_obat) ?>"
									class="btn btn-sm btn-info">Lihat</a>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

