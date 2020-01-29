<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Transfer Obat/Alkes</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Kode</th>
							<th class="text-center">Tujuan</th>
							<th class="text-center">Tanggal</th>
							<th class="text-center">Waktu</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no = 1;
						foreach ($record as $data) :
							$tanggal = tgl_indo(date('Y-m-d',strtotime($data->tgl_obat_keluar_i)));
							$waktu = date('H:i',strtotime($data->tgl_obat_keluar_i));
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $data->no_obat_keluar_i ?></td>
							<td><?= $data->tujuan ?></td>
							<td><?= $tanggal ?></td>
							<td><?= $waktu ?></td>
							<td class="text-center">
								<a href="<?= base_url('apotek/pengiriman_obat/tampil_detail_daftar_pengiriman_obat?no_obat_keluar_i=' . $data->no_obat_keluar_i) ?>"
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

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
