<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th width="5%" class="text-center">No</th>
							<th width="10%">No RM</th>
							<th width="20%">NIK</th>
							<th width="25%">Nama</th>
							<th width="10%">Jenkel</th>
							<th width="20%">Alamat</th>
							<th width="15%">Detail</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						foreach($record as $data):
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $data->no_rm ?></td>
							<td><?= $data->nik ?></td>
							<td><?= $data->nama ?></td>
							<td><?= $data->jenkel ?></td>
							<td><?= $data->alamat ?></td>
                            <td>
                            <a href="<?= base_url('admin/pasien/list/'.$data->no_rm) ?>"
									class="btn btn-sm btn-info">Detail</a>
                            </td>
							
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>