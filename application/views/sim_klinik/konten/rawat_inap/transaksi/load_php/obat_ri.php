<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_obat" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Rawat Inap</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_obat" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Obat</th>
								<th>Kategori</th>
								<th>Stok</th>
								<th>Harga Jual</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody id="daftar_obat">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	// Start of obat////////////////
	// jika kita tekan / click button search-button
	$('#btn_search_obat').on('click', function () {
		search_proses_obat();
	});

	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris_obat', function () {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();
		jumlah_detail_transaksi = jumlah_detail_transaksi - 1;
		cek_jumlah_data_detail_transaksi();
		update_sub_harga_obat();
	});

	// jika kita mengubah class inputan rupiah
	$(document).on('keyup', '.rupiah', function () {
		update_sub_harga_obat();
	});

	// jika kita mengubah class inputan rupiah
	$(document).on('keyup', '.cek_qty', function () {

		var row_id = $(this).attr("id"); // qty1++
		var row_no = row_id.substring(3); // 1++

		var val_qty = $('#' + row_id).val();
		var val_qty_sekarang = parseInt($('#qty_sekarang' + row_no).val());

		if (val_qty <= val_qty_sekarang) {
			update_sub_harga_obat();
			var harga_obat = $('#harga_obat' + row_no).val()
			var val_harga_obat = parseInt(harga_obat.split('.').join(''));
			$('#harga_sub_obat' + row_no).val(val_harga_obat * val_qty);

		} else {
			alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek");
			$('#' + row_id).val("1");
			update_sub_harga_obat();
			var harga_obat = $('#harga_obat' + row_no).val()
			var val_harga_obat = parseInt(harga_obat.split('.').join(''));
			$('#harga_sub_obat' + row_no).val(val_harga_obat);
		}



	});

	// Start pencarian
	function search_proses_obat() {

		var table;
		table = $('.table_obat').DataTable({
			"columnDefs": [{
					"targets": [0, 3, 5],
					"className": "text-center"
				},
				{
					"targets": 4,
					"className": "text-right"
				}
			],
			"bDestroy": true
		});

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_obat'; ?>",
			success: function (hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function (i, item) {

						var no_stok_obat_rawat_i = data[i].no_stok_obat_rawat_i;
						var nama_obat = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;
						var qty_sekarang = data[i].qty;
						var harga_obat = data[i].harga_jual;

						var reverse = harga_obat.toString().split('').reverse().join(''),
							ribuan = reverse.match(/\d{1,3}/g);
						ribuan = ribuan.join('.').split('').reverse().join('');

						var button = `<a onclick="pilihobat('` + no_stok_obat_rawat_i +
							`','` + nama_obat + `','` + nama_kategori + `','` + qty_sekarang + `','` +
							harga_obat + `')" id="` + no_stok_obat_rawat_i +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						table.row.add([no, nama_obat, nama_kategori, qty_sekarang,
							ribuan, button
						]);

						no = no + 1;
					});
				} else {

					$('.table_obat').html('<h3>No data are available</h3>');

				}
				table.draw();

			}
		});
	}

	// Start add_row
	function pilihobat(no_stok_obat_rawat_i, nama_obat, nama_kategori, qty_sekarang, harga_obat) {

		$('#detail_list').append(`

		<tr id="row` + count_transaksi + `">
			<td>
				` + nama_obat + `
				<input type="hidden" name="no_stok_obat_rawat_i[]" class="form-control form-control-sm"
					id="no_stok_obat_rawat_i` + count_transaksi + `" value="` + no_stok_obat_rawat_i + `">
			</td>
			<td>
				<input type="text" name="qty[]" class="form-control form-control-sm cek_qty"
					id="qty` + count_transaksi + `" placeholder="QTY" value="1" required>
				<input readonly type="hidden" name="qty_sekarang[]" class="form-control form-control-sm"
					id="qty_sekarang` + count_transaksi + `" value="` + qty_sekarang + `">
			</td>
			<td>
				<input type="text" name="harga_obat[]"
					class="form-control form-control-sm rupiah text-right harga_obat_update"
					id="harga_obat` + count_transaksi + `" placeholder="Harga Obat Apotek" required
					value="` + harga_obat + `">
			</td>
			<td>
				<input type="text" class="form-control form-control-sm rupiah text-right"
					id="harga_sub_obat` + count_transaksi + `" readonly required value="` + harga_obat + `">
			</td>
			<td>
				<div class="form-group col-sm-2">
					<a id="` + count_transaksi + `" href="#"
						class="btn btn-sm btn-danger btn-icon-split remove_baris_obat">
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
		$('#exampleModalCenter_obat').modal('hide');

		cek_jumlah_data_detail_transaksi();
		update_sub_harga_obat();
	}



	function update_sub_harga_obat() {
		// mengambil nilai di dalam form
		var form_data = $('#transaksi_form').serialize()

		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/ambil_sub_total_obat'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
				$('#sub_total_harga_obat').val(data);
				update_grand_total();
				$('.rupiah').trigger('input'); // Will be display 
			}
		});

		validasi();
	}
	// End of obat///////////////////

</script>
