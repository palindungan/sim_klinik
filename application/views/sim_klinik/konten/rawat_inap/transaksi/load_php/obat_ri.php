<script>
	var count3 = 0;
	var jumlah_detail_transaksi_obat = 0;

	// Start of obat////////////////
	// jika kita tekan / click button search-button
	$('#btn_search_obat').on('click', function () {
		search_proses_obat();
	});

	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris_obat', function () {
		var row_no = $(this).attr("id");
		$('#row_obat' + row_no).remove();

		jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat - 1;

		cekJumlahDataTransaksi_obat();
	});

	// jika kita mengubah class inputan rupiah_obat
	$(document).on('keyup', '.rupiah_obat', function () {
		update_sub_harga_obat();
	});

	// jika kita mengubah class inputan rupiah
	$(document).on('keyup', '.qty_format', function () {

		var row_id = $(this).attr("id"); // qty1++
		var row_no = row_id.substring(3); // 1++

		var val_qty = parseInt($('#' + row_id).val());
		var val_qty_sekarang = parseInt($('#qty_sekarang' + row_no).val());

		if (val_qty <= val_qty_sekarang) {
			cekJumlahDataTransaksi_obat();
		} else {
			alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek");
			$('#' + row_id).val("1");
			cekJumlahDataTransaksi_obat();
		}
	});

	// Start pencarian
	function search_proses_obat() {

		var table;
		table = $('.table_obat').DataTable({
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
			url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_obat'; ?>",
			success: function (hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function (i, item) {

						var kode_obat = data[i].no_stok_obat_rawat_i;
						var nama_obat = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;
						var tgl_obat_keluar_i = data[i].tgl_obat_keluar_i;
						var qty_sekarang = data[i].qty_sekarang;
						var harga_obat = data[i].harga_jual;

						var reverse = harga_obat.toString().split('').reverse().join(''),
							ribuan = reverse.match(/\d{1,3}/g);
						ribuan = ribuan.join('.').split('').reverse().join('');

						var button = `<a onclick="pilihobat('` + kode_obat +
							`','` + nama_obat + `','` + nama_kategori + `','` + qty_sekarang + `','` +
							harga_obat + `')" id="` + kode_obat +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						table.row.add([no, nama_obat, nama_kategori, tgl_obat_keluar_i, qty_sekarang,
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
	function pilihobat(kode_obat, nama_obat, nama_kategori, qty_sekarang, harga_obat) {

		$('#detail_list_obat').append(`

            <div id="row_obat` + count3 + `" class="form-row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama_obat[]" class="form-control form-control-sm karakter" id="nama_obat` +
			count3 +
			`" placeholder="Nama_obat" required value="` + nama_obat +
			`">
					<input type="hidden" name="no_stok_obat_rawat_i[]" class="form-control form-control-sm" id="no_stok_obat_rawat_i` +
			count3 +
			`" value="` +
			kode_obat +
			`">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_obat[]" class="form-control form-control-sm rupiah_obat text-right" id="harga_obat` +
			count3 +
			`" placeholder="harga Obar" required value="` + harga_obat + `">
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="qty[]" class="form-control form-control-sm qty_format" id="qty` + count3 + `" placeholder="QTY" value="1" required>
					<input type="hidden" name="qty_sekarang[]" id="qty_sekarang` + count3 +
			`" class="form-control form-control-sm" value="` + qty_sekarang + `"></input>
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count3 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_obat">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						<span class="text">Hapus</span>
					</a>
				</div>
			</div>

		`);

		count3 = count3 + 1;
		jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat + 1;
		$('#exampleModalCenter_obat').modal('hide');

		cekJumlahDataTransaksi_obat();
	}

	function cekJumlahDataTransaksi_obat() {

		var x = document.getElementById("label_kosong_obat");
		if (jumlah_detail_transaksi_obat > 0) {
			x.style.display = "none"; // hidden
		} else {
			x.style.display = "block"; // show
		}

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
				grandTotal();
				$('.rupiah_obat').trigger('input'); // Will be display 
			}
		});

		validasi();
	}
	// End of obat///////////////////

</script>
