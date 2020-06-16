<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">History Akomodasi Rawat Inap</h6>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered table_1" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">Tanggal</th>
							<th class="text-center">Kode Akomodasi</th>
							<th class="text-center">Total Harga</th>
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
		$('.table_1').DataTable({
			"processing": true,
			"serverSide": true,
			"ajax": "<?php echo base_url() . 'rawat_inap/history_akomodasi/tampil_data_akomodasi'; ?>",
			"columnDefs": [{
				"targets": -1,
				"className": "text-center",
				render: function (data, type, row, meta) {
					// return '<a type="button" class="btn btn-danger btn-block" href="http://google.com">删除</a>';
					return '<button class="btn btn-sm btn-info btn-detail">Detail</button>'
				}
			}]
		});

		$('.table_1 tbody').on('click', '.btn-detail', function () {
			var data = table.row($(this).parents('tr')).data();
			// alert(data[1]);
			var url = "<?php echo base_url().'rawat_inap/history_akomodasi/detail_akomodasi/'; ?>" + data[1] + "";
			window.location = url;
		});
	}

</script>
