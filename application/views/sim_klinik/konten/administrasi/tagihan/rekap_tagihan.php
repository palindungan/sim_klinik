<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Rekap Tagihan</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" class="table_1" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">Tanggal</th>
							<th class="text-center">No.Pelayanan</th>
							<th class="text-center">No.RM</th>
							<th class="text-center">Atas Nama</th>
							<th class="text-center">Tipe</th>
							<th class="text-center">Detail</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<script>
	// jika kita tekan / click button search-button
	$(document).ready(function () {
		//DOM manipulation code
		search_proses();
	});

	function search_proses() {
		var table;
		table = $('.table_1').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url() . 'laporan/RekapTagihan/tampil_data_tagihan'; ?>"
		});
	}

</script>
