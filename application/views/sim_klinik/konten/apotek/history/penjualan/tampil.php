<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Penjualan Obat/Alkes</h6>
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
							<th class="text-center">Nama Pasien</th>
							<th class="text-center">Total Harga</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no = 1;
						foreach ($record as $data) :
							$tanggal = tgl_indo(date('Y-m-d',strtotime($data->tanggal_penjualan)));
							$waktu = date('H:i',strtotime($data->tanggal_penjualan));
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $data->no_penjualan_obat_a ?></td>
							<td><?= $tanggal ?></td>
							<td><?= $waktu ?></td>
							<td><?= $data->nama_pasien ?></td>
							<td class="text-right"><?= rupiah($data->total_harga) ?></td>
							<td class="text-center">
								<a href="<?= base_url('apotek/penjualan_obat/tampil_detail_daftar_penjualan_obat?no_penjualan_obat_a=' . $data->no_penjualan_obat_a) ?>"
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
