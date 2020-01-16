<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_kamar" tabindex="-1" role="dialog"
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
					<table class="table table-bordered table_kamar" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Kamar</th>
								<th>Tipe</th>
								<th>Harga Harian</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody id="daftar_kamar">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var count1 = 0;
	var jumlah_detail_transaksi_kamar = 0;

	// Start of kamar////////////////
	// jika kita tekan / click button search-button
	$('#btn_search_kamar').on('click', function () {
		search_proses_kamar();
	});

	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris_kamar', function () {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_transaksi = jumlah_detail_transaksi - 1;
		cek_jumlah_data_detail_transaksi();
		update_sub_harga_kamar()
	});

	// jika kita mengubah class inputan rupiah_kamar
	$(document).on('keyup', '.rupiah_kamar', function () {
		update_sub_harga_kamar();
	});

	// Start pencarian
	function search_proses_kamar() {

		var table;
		table = $('.table_kamar').DataTable({
			"columnDefs": [{
					"targets": [0, 4],
					"className": "text-center"
				},
				{
					"targets": 3,
					"className": "text-right"
				}
			],
			"bDestroy": true
		});

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_kamar'; ?>",
			success: function (hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function (i, item) {

						var kode_kamar = data[i].no_kamar_rawat_i;
						var nama_kamar = data[i].nama;
						var harga_harian_kamar = data[i].harga_harian;
						var tipe_kamar = data[i].tipe;

						var reverse = harga_harian_kamar.toString().split('').reverse().join(''),
							ribuan = reverse.match(/\d{1,3}/g);
						ribuan = ribuan.join('.').split('').reverse().join('');

						var button = `<a onclick="pilihKamar('` + kode_kamar +
							`','` + nama_kamar + `','` + harga_harian_kamar + `','` + tipe_kamar +
							`')" id="` + kode_kamar +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						table.row.add([no, nama_kamar, tipe_kamar, ribuan, button]);

						no = no + 1;
					});
				} else {

					$('.table_kamar').html('<h3>No data are available</h3>');

				}
				table.draw();

			}
		});
	}

	// Start add_row
	function pilihKamar(kode_kamar, nama_kamar, harga_harian_kamar, tipe_kamar) {

		$('#detail_list').append(`

		<tr id="row` + count_transaksi + `">
			<td>
				` + nama_kamar + `
				<input type="hidden" name="no_kamar_rawat_i[]" class="form-control form-control-sm" id="no_kamar_rawat_i` +
			count_transaksi + `" value="` + kode_kamar + `">
			</td>
			<td>1</td>
			<td>
				<input type="text" name="harga_harian_kamar[]"
					class="form-control form-control-sm rupiah text-right harga_harian_kamar"
					id="harga_tindakan` + count_transaksi + `" placeholder="Harga Tindakan" required
					value="` + harga_harian_kamar + `">
			</td>
			<td>
				<input type="text" class="form-control form-control-sm rupiah text-right"
					id="sub_total_harga_kamar` + count_transaksi + `" readonly required value="` + harga_harian_kamar + `">
			</td>
			<td>
				<div class="form-group col-sm-2">
					<a id="` + count_transaksi + `" href="#"
						class="btn btn-sm btn-danger btn-icon-split remove_baris_kamar">
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
		$('#exampleModalCenter_kamar').modal('hide');

		cek_jumlah_data_detail_transaksi();
		update_sub_harga_kamar();
	}

	function cekJumlahDataTransaksi_kamar() {

		var x = document.getElementById("label_kosong_kamar");
		if (jumlah_detail_transaksi_kamar > 0) {
			x.style.display = "none"; // hidden
		} else {
			x.style.display = "block"; // show
		}

		update_sub_harga_kamar();
	}

	function update_sub_harga_kamar() {
		// mengambil nilai di dalam form
		var form_data = $('#transaksi_form').serialize()

		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/ambil_sub_total_kamar'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
				$('#sub_total_harga_kamar').val(data);
				update_grand_total();
				$('.rupiah').trigger('input'); // Will be display 
			}
		});

		validasi();
	}
	// End of Kamar///////////////////

</script>
