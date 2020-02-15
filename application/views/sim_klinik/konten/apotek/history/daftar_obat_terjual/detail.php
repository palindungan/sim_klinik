<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">History Obat Terjual Tanggal <?php echo $judul_mulai." sampai ".$judul_akhir ?></h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Obat</th>
							<th class="text-center">QTY</th>
						</tr>
					</thead>
					<tbody>
						<?php
                        $no = 1;
                        $qty = 0;
                        foreach ($obat_semua as $data) :
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td class="text-center"><?= $data->nama ?></td>
							<td class="text-center"><?= $data->qty ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
