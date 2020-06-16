<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Rekap Tagihan</h6>
		</div>
		<div class="card-body">
			<div class="row mb-2">
				<div class="col-md-4">
					<label for="">Filter Rekap Tagihan</label>
					<select class="form-control form-control-sm" id="filter_rekap" onchange="search_proses()" required>
						<option value="Semua Data">Semua Data</option>
						<option value="Lunas">Lunas</option>
						<option value="Belum Lunas">Belum Lunas</option>
					</select>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered table_1" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">Tanggal</th>
							<th class="text-center">No.Pelayanan</th>
							<th class="text-center">No.RM</th>
							<th class="text-center">Atas Nama</th>
							<th class="text-center">Tipe</th>
							<th class="text-center">Status</th>
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
	$(document).ready(function () {
		search_proses();
	});

	function search_proses() {
		var filter_rekap = $("#filter_rekap").val();
		
		//Delete Datatable First if Datatable already - Fix Cannot reinitialise Datatable Again
		if ($.fn.DataTable.isDataTable('.table_1')) {
			$('.table_1').DataTable().destroy();
		}
		
		//Create Datatable
		var table = $('.table_1').DataTable({
			"processing": true,
			"serverSide": true,
			"order" : [[1,'desc']],
			"ajax": {
				type : "GET",
				url : '<?php echo base_url() ?>laporan/RekapTagihan/tampil_data_tagihan?filter='+filter_rekap,
			},
			"columnDefs": [
				{
					"targets": 5,
					"className": "text-center",
					render: function (data, type, row, meta) {
						var badge_option = '';
						if(row[5] == 'Lunas'){
							badge_option = 'badge-primary'
						}else if(row[5] == 'Belum Lunas'){
							badge_option = 'badge-warning'
						}
						return '<span class="badge '+badge_option+'">  '+row[5]+'  </span>';
					}
				},
				{
					"targets": -1,
					"className": "text-center",
					render: function (data, type, row, meta) {
						return '<a class="btn btn-sm btn-info" href="<?php echo base_url().'admin/pasien/detail/'; ?>'+row[1]+'">Detail</a>'
					}
				}
			]
		});
	}
	

</script>
