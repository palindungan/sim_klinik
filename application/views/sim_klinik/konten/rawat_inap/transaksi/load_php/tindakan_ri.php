<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_tindakan" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan Rawat Inap</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_tindakan" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama tindakan</th>
								<th>Harga</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody id="daftar_tindakan">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// Start of tindakan////////////////
	// jika kita tekan / click button search-button
	$('#btn_search_tindakan').on('click', function () {
		search_proses_tindakan();
	});

	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris_tindakan', function () {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_transaksi = jumlah_detail_transaksi - 1;
		cek_jumlah_data_detail_transaksi();
		update_sub_harga_tindakan()
	});

	// jika kita mengubah class inputan rupiah_tindakan
	$(document).on('keyup', '.rupiah_tindakan', function () {
		update_sub_harga_tindakan();
	});

	// Start pencarian
	function search_proses_tindakan() {

		var table;
		table = $('.table_tindakan').DataTable({
			"columnDefs": [{
					"targets": [0, 3],
					"className": "text-center"
				},
				{
					"targets": 2,
					"className": "text-right"
				}
			],
			"bDestroy": true
		});

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_tindakan'; ?>",
			success: function (hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function (i, item) {

						var kode_tindakan = data[i].no_rawat_inap_t;
						var nama_tindakan = data[i].nama;
						var harga_tindakan = data[i].harga;

						var reverse = harga_tindakan.toString().split('').reverse().join(''),
							ribuan = reverse.match(/\d{1,3}/g);
						ribuan = ribuan.join('.').split('').reverse().join('');

						var button = `<a onclick="pilihtindakan('` + kode_tindakan +
							`','` + nama_tindakan + `','` + harga_tindakan + `')" id="` +
							kode_tindakan +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						table.row.add([no, nama_tindakan, ribuan, button]);

						no = no + 1;
					});
				} else {

					$('.table_tindakan').html('<h3>No data are available</h3>');

				}
				table.draw();

			}
		});
	}

	// Start add_row
	function pilihtindakan(kode_tindakan, nama_tindakan, harga_tindakan) {

		$('#detail_list').append(`

		<tr id="row` + count_transaksi + `">
			<td>
				` + nama_tindakan + `
				<input type="hidden" name="no_rawat_inap_t[]" class="form-control form-control-sm" id="no_rawat_inap_t` +
			count_transaksi + `"
					value="` + kode_tindakan + `">
			</td>
			<td>1</td>
			<td>
				<input type="text" name="harga_tindakan[]"
					class="form-control form-control-sm rupiah text-right harga_tindakan_update"
					id="harga_tindakan` + count_transaksi + `" placeholder="Harga Tindakan" required
					value="` + harga_tindakan + `">
			</td>
			<td>
				<input type="text" class="form-control form-control-sm rupiah text-right"
					id="sub_total_harga_tindakan` + count_transaksi + `" readonly required value="` + harga_tindakan + `"></td>
			<td>
				<div class="form-group col-sm-2">
					<a id="` + count_transaksi + `" href="#"
						class="btn btn-sm btn-danger btn-icon-split remove_baris_tindakan">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
					</a>
				</div>
			</td>
		</tr>

		`);

		count_transaksi = count_transaksi + 1;
		jumlah_detail_transaksi = jumlah_detail_transaksi + 1;
		$('#exampleModalCenter_tindakan').modal('hide');

		cek_jumlah_data_detail_transaksi();
		update_sub_harga_tindakan();
	}


	function update_sub_harga_tindakan() {
		// mengambil nilai di dalam form
		var form_data = $('#transaksi_form').serialize()

		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/ambil_sub_total_tindakan'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
				$('#sub_total_harga_tindakan').val(data);
				update_grand_total();
				$('.rupiah').trigger('input'); // Will be display
			}
		});

		validasi();
	}

</script>
