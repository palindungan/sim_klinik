<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Rekap Tagihan</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">No.Pelayanan</th>
							<th class="text-center">No.RM</th>
                            <th class="text-center">Atas Nama</th>
                            <th class="text-center">Tipe</th>
							<th class="text-center">Detail</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						foreach($record as $data):
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?php echo date("d-m-Y",strtotime($data->tgl_pelayanan)); ?></td>
							<td><?php echo $data->no_ref_pelayanan; ?></td>
							<td><?php echo $data->no_rm; ?></td>
                            <td><?php echo $data->nama; ?></td>
                            <td><?php echo $data->tipe_pelayanan; ?></td>
							<td class="text-center">
								<a href="<?php echo base_url('admin/pasien/detail/'.$data->no_ref_pelayanan); ?>"
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
