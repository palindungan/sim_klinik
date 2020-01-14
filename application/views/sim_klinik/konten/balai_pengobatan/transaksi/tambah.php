<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Balai Pengobatan</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">
				<div class="form-row">
					<div class="form-group col-sm-5">
						<label>Cari No Ref</label>
						<select class="form-control form-control-sm itemName" name="no_ref_pelayanan" required>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6">
								<h5>* Balai Pengobatan</h5>
								<a href="#" id="btn_search_bp" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterBP">
									<span class="icon text-white-50">
										<i class="fas fa-search-plus"></i>
									</span>
									<span class="text">Cari Tindakan</span>
								</a>
							</div>
							<div class="form-group col-sm-6">
								<h5>* Obat Apotek</h5>
								<a href="#" id="btn_search_obat" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter_obat">
									<span class="icon text-white-50">
										<i class="fas fa-search-plus"></i>
									</span>
									<span class="text">Cari Obat Apotek</span>
								</a>
							</div>
						</div>
					</div>
				</div>
				<div class="form-row">
					<div class="col-sm-12">
						<div class="row">
							<div class="form-group col-sm-6">
								<div class="row">
									<div class="col-sm-6">Nama Tindakan BP</div>
									<div class="col-sm-6">Biaya</div>
								</div>
								<div class="row">
									<div class="col-sm-12">

										<!-- start untuk keranjang tindakan -->
										<div id="detail_list_bp">
											<!-- disini isi detail -->
											<h6 id="label_kosong_bp">Detail Tindakan Masih Kosong!</h6>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
									</div>
									<div class="col-sm-4">
										<input type="text" readonly name="total_harga_bp" class="form-control form-control-sm rupiah_bp text-right" id="total_harga_bp" placeholder="0" required>
									</div>
									<div class="col-sm-2">
									</div>
								</div>
							</div>
							<div class="form-group col-sm-6">
								<div class="row">
									<label class=" col-sm-4"><b>Nama Obat</b></label>
									<label class=" col-sm-3"><b>Harga Jual</b></label>
									<label class=" col-sm-2"><b>QTY</b></label>
									<label class=" col-sm-2"><b>Paket ?</b></label>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<!-- start untuk keranjang tindakan -->
										<div id="detail_list_obat">
											<!-- disini isi detail -->
											<h6 id="label_kosong_obat">Detail Obat Masih Kosong!</h6>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6">
									</div>
									<div class="col-sm-4">
										<input type="text" readonly name="sub_total_harga_obat" class="form-control form-control-sm rupiah_obat text-right" id="sub_total_harga_obat" placeholder="0" required>
									</div>
									<div class="col-sm-2">
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-sm-2">
						<button id="action" type="submit" class="btn btn-sm btn-success btn-icon-split" onclick="return confirm('Lakukan Simpan Data ?')">
							<span class="icon text-white-50">
								<i class="fas fa-save"></i>
							</span>
							<span class="text">Simpan Data</span>
						</button>
					</div>
				</div>

			</form>
		</div>
	</div>
</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterBP" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_1" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Biaya</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody id="daftar_barang">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Stok Obat Apotek</h5>
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
						<tbody id="daftar_barang">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$('.itemName').select2({
		ajax: {
			url: "<?= base_url('balai_pengobatan/transaksi/tampil_select') ?>",
			dataType: "json",
			delay: 250,
			data: function(params) {
				return {
					no_ref: params.term,
					nama: params.term
				};
			},
			processResults: function(data) {
				var results = [];

				$.each(data, function(index, item) {
					results.push({
						id: item.no_ref_pelayanan,
						text: item.no_ref_pelayanan + " || " + item.nama
					});
				});
				return {
					results: results
				}
			}
		}
	})
</script>
<script>
	var count1 = 0;
	var jumlah_detail_transaksi = 0;

	// jika kita tekan / click button search-button
	$('#btn_search_bp').on('click', function() {
		search_proses();
	});

	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris', function() {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

		cekJumlahDataTransaksi();
	});

	// jika kita mengubah class inputan rupiah
	$(document).on('keyup', '.rupiah', function() {
		update_total();
	});

	// jika di click simpan / submit
	$(document).on('submit', '#transaksi_form', function(event) {
		event.preventDefault();

		// mengambil nilai di dalam form
		var form_data = $(this).serialize();

		// tambah ke database
		$.ajax({
			url: "<?php echo base_url() . 'balai_pengobatan/transaksi/input_transaksi_form'; ?>",
			method: "POST",
			data: form_data,
			success: function(data) {
				// if (data != "") {
				// 	alert(data);
				// }
				location.reload();
			}
		});
		// tambah ke database

	});

	// Start pencarian
	function search_proses() {

		var table;
		table = $('.table_1').DataTable({
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
			url: "<?php echo base_url() . 'balai_pengobatan/transaksi/tampil_daftar_tindakan'; ?>",
			success: function(hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function(i, item) {

						var kode = data[i].no_bp_t;
						var nama = data[i].nama;
						var harga = data[i].harga;
						var status = data[i].status;
						var reverse = harga.toString().split('').reverse().join(''),
							ribuan = reverse.match(/\d{1,3}/g);
						ribuan = ribuan.join('.').split('').reverse().join('');
						var button = `<a onclick="pilihTindakan('` + kode +
							`','` + nama + `','` + harga + `','` + status + `')" id="` + kode +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						table.row.add([no, nama, ribuan, button]);

						no = no + 1;
					});
				} else {

					$('.table_1').html('<h3>No data are available</h3>');

				}
				table.draw();

			}
		});
	}

	// Start add_row
	function pilihTindakan(kode, nama, harga, status) {
		if (status == 'Tidak Terima') {
			harga = 0;
		}
		$('#detail_list_bp').append(`

			<div id="row` + count1 + `" class="form-row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama[]" class="form-control form-control-sm karakter" id="nama` + count1 +
			`" placeholder="Nama" required value="` + nama + `">
					<input type="hidden" name="no_bp_t[]" class="form-control form-control-sm" id="no_bp_t` + count1 + `" value="` +
			kode + `">
				</div>
				<div class="form-group col-sm-5">
					<input type="text" name="harga[]" class="form-control form-control-sm rupiah_bp text-right" id="harga` + count1 +
			`" placeholder="Harga" required value="` + harga + `">
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count1 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						<span class="text">Hapus</span>
					</a>
				</div>
			</div>

		`);

		count1 = count1 + 1;
		jumlah_detail_transaksi = jumlah_detail_transaksi + 1;
		$('#exampleModalCenterBP').modal('hide');

		cekJumlahDataTransaksi();
	}

	function cekJumlahDataTransaksi() {

		var x = document.getElementById("label_kosong_bp");
		if (jumlah_detail_transaksi > 0) {
			x.style.display = "none"; // hidden
		} else {
			x.style.display = "block"; // show
		}

		update_total();
	}

	function update_total() {
		// mengambil nilai di dalam form
		var form_data = $('#transaksi_form').serialize()

		$.ajax({
			url: "<?php echo base_url() . 'balai_pengobatan/transaksi/ambil_total'; ?>",
			method: "POST",
			data: form_data,
			success: function(data) {
				$('#total_harga_bp').val(data);
				$('.rupiah_bp').trigger('input'); // Will be display 
			}
		});

		validasi();
	}

	function validasi() {
		$('.rupiah_bp').mask('000.000.000', {
			reverse: true
		});
		$('.rupiah_obat').mask('000.000.000', {
			reverse: true
		});
	}

	var count3 = 0;
	var jumlah_detail_transaksi_obat = 0;

	// Start of obat////////////////
	// jika kita tekan / click button search-button
	$('#btn_search_obat').on('click', function() {
		search_proses_obat();
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
					"targets": 4,
					"className": "text-right"
				}
			],
			"bDestroy": true
		});

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'balai_pengobatan/transaksi/tampil_daftar_obat'; ?>",
			success: function(hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function(i, item) {

						var kode_obat = data[i].no_stok_obat_a;
						var nama_obat = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;
						var qty_sekarang = data[i].qty;
						var harga_obat = data[i].harga_jual;
						var qty = 1;

						var reverse = harga_obat.toString().split('').reverse().join(''),
							ribuan = reverse.match(/\d{1,3}/g);
						ribuan = ribuan.join('.').split('').reverse().join('');

						var button = `<a
	 	onclick="pilihobat('` + kode_obat +
							`','` + nama_obat + `','` + nama_kategori + `','` + qty + `','` +
							qty_sekarang +
							`','` + harga_obat + `')" id="` + kode_obat +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						if (parseInt(qty_sekarang) > 0) {
							table.row.add([no, nama_obat, nama_kategori,
								qty_sekarang, ribuan, button
							]);

							no = no + 1;
						}
					});
				} else {

					$('.table_obat').html('<h3>No data are available</h3>');

				}
				table.draw();

			}
		});
	}

	// Start add_row
	function pilihobat(kode_obat, nama_obat, nama_kategori, qty, qty_sekarang, harga_obat) {

		$('#detail_list_obat').append(`

	 <div id="row_obat` + count3 + `" class="form-row kelas_row">
	 	<div class="form-group col-sm-4">
	 		<input type="text" readonly name="nama_obat[]" class="form-control form-control-sm karakter"
	 			id="nama_obat` + count3 + `" placeholder="Nama_obat" required value="` + nama_obat + `">
	 		<input type="hidden" name="no_stok_obat_a[]" class="form-control form-control-sm"
	 			id="no_stok_obat_a` + count3 + `" value="` + kode_obat + `">
	 	</div>
	 	<div class="form-group col-sm-3">
	 		<input type="text" name="harga_obat[]" class="form-control form-control-sm rupiah_obat text-right"
	 			id="harga_obat` + count3 + `" placeholder="harga Obar" required value="` + harga_obat + `">
	 	</div>
	 	<div class="form-group col-sm-2">
	 		<input type="text" name="qty[]" class="form-control form-control-sm qty_format_obat" id="qty` + count3 + `"
	 			placeholder="QTY" value="` + qty + `" required>
	 		<input type="hidden" name="qty_sekarang[]" id="qty_sekarang` + count3 + `"
	 			class="form-control form-control-sm" value="` + qty_sekarang + `"></input>
	 	</div>
		 <div class="form-group col-sm-2">
		 	<input type="checkbox" name="status_paket[]" class="form-control form-control-sm status_paket" id="status_paket` +
			count3 + `"
		 		placeholder="QTY" value="Ya">

		 	</a>
		 </div>
	 	<div class="form-group col-sm-1">
	 		<a id="` + count3 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_obat">
	 			<span class="icon text-white-50">
	 				<i class="fas fa-trash-alt"></i>
	 			</span>

	 		</a>
	 	</div>
		 
	 </div>

	 `);

		count3 = count3 + 1;
		jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat + 1;
		$('#exampleModalCenter_obat').modal('hide');

		cekJumlahDataTransaksi_obat();
	}



	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris_obat', function() {
		var row_no = $(this).attr("id");
		$('#row_obat' + row_no).remove();

		jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat - 1;

		cekJumlahDataTransaksi_obat();
	});



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
			url: "<?php echo base_url() . 'balai_pengobatan/transaksi/ambil_total_obat'; ?>",
			method: "POST",
			data: form_data,
			success: function(data) {
				$('#sub_total_harga_obat').val(data);
				$('.rupiah_obat').trigger('input'); // Will be display
			}
		});

		validasi();
	}

	// jika kita mengubah class inputan rupiah_obat
	$(document).on('keyup', '.rupiah_obat', function() {
		update_sub_harga_obat();
	});

	$(document).on('keyup', '.qty_format_obat', function() {

		var row_id = $(this).attr("id"); // qty1++
		var row_no = row_id.substring(3); // 1++
		var val_qty = $('#' + row_id).val();
		val_qty_sekarang = parseInt($('#qty_sekarang' + row_no).val());

		if (val_qty <= val_qty_sekarang) {
			update_sub_harga_obat();
		} else {
			alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek ");
			$('#' + row_id).val("1");
			update_sub_harga_obat();
		}
	});
</script>