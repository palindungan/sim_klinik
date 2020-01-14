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
		$('#row_kamar' + row_no).remove();

		jumlah_detail_transaksi_kamar = jumlah_detail_transaksi_kamar - 1;

		cekJumlahDataTransaksi_kamar();
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

						table.row.add([no, nama_kamar, ribuan, tipe_kamar, button]);

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

		$('#detail_list_kamar').append(`

			<div id="row_kamar` + count1 + `" class="form-row">
				<div class="form-group col-sm-4">
					<input type="text" readonly name="nama_kamar[]" class="form-control form-control-sm karakter" id="nama_kamar` +
			count1 +
			`" placeholder="Nama_kamar" required value="` + nama_kamar + `">
					<input type="hidden" name="no_kamar_rawat_i[]" class="form-control form-control-sm" id="no_kamar_rawat_i` +
			count1 + `" value="` +
			kode_kamar +
			`">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_harian_kamar[]" class="form-control form-control-sm rupiah_kamar text-right" id="harga_harian_kamar` +
			count1 +
			`" placeholder="Harga Harian Kamar" required value="` + harga_harian_kamar + `">
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="tipe_kamar[]" readonly class="form-control form-control-sm rupiah" id="tipe_kamar` +
			count1 + `" placeholder="Tipe Kamar" value="` + tipe_kamar + `" required>
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="jumlah_hari[]" class="form-control form-control-sm rupiah_kamar" id="jumlah_hari` +
			count1 + `" placeholder="Jumlah Hari" value="1" required>
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count1 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_kamar">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						<span class="text">Hapus</span>
					</a>
				</div>
			</div>

		`);

		count1 = count1 + 1;
		jumlah_detail_transaksi_kamar = jumlah_detail_transaksi_kamar + 1;
		$('#exampleModalCenter_kamar').modal('hide');

		cekJumlahDataTransaksi_kamar();
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
				grandTotal();
				$('.rupiah_kamar').trigger('input'); // Will be display 
			}
		});

		validasi();
	}
	// End of Kamar///////////////////

</script>
