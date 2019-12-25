<style>
	.select2-selection__rendered {
		line-height: 36px !important;
	}

	.select2-selection {
		height: 38px !important;
	}
</style>
<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Penjualan Obat</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label>Cari No Ref</label>
						<select class="form-control form-control-sm" name="no_ref_pelayanan" id="xx" required>
							<option value="">-- Pilih Data --</option>
							<?php foreach ($record as $data) : ?>
								<option value="<?= $data->no_ref_pelayanan ?>">
									<?= $data->no_ref_pelayanan . " || " . $data->nama ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>

					<table width="100%" class="responsive">
						<tr>
							<td width="6%">
								<h5>Nama</h5>
							</td>
							<td width="2%">
								<h5>:</h5>
							</td>
							<td width="24%">
								<h5 id="txt_nama"></h5>
							</td>
							<td width="6%">
								<h5>Umur</h5>
							</td>
							<td width="2%">
								<h5>:</h5>
							</td>
							<td width="19%">
								<h5 id="txt_umur"></h5>
							</td>
							<td width="8%">
								<h5>Alamat</h5>
							</td>
							<td width="2%">
								<h5>:</h5>
							</td>
							<td width="22%">
								<h5 id="txt_alamat"></h5>
							</td>
						</tr>
					</table>

					<!-- <div class="form-group col-sm-6">
                        <label>Tanggal</label>
                        <input type="date" name="tgl_penerimaan_o" class="form-control form-control-sm" required>
                    </div> -->
				</div>

				<div class="form-row">

					<div class="form-group col-sm-12">
						<a href="#" id="btn_search" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
							<span class="icon text-white-50">
								<i class="fas fa-search-plus"></i>
							</span>
							<span class="text">Cari Data Obat</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<label class=" col-sm-5"><b>Nama Obat</b></label>
					<label class=" col-sm-4"><b>Harga Jual</b></label>
					<label class=" col-sm-1"><b>QTY</b></label>
				</div>

				<!-- start untuk keranjang Obat -->
				<div id="detail_list">
					<!-- disini isi detail -->
					<h6 id="label_kosong">Detail Obat Masih Kosong Lakukan pilih Pencarian Data Obat !</h6>

				</div>
				<!-- end of untuk keranjang Obat -->

				<div class="form-row">
					<div class="form-group col-sm-5"> </div>

					<div class="form-group col-sm-5">
						<input type="text" readonly name="total_harga" class="form-control form-control-sm rupiah text-right" id="total_harga" placeholder="Total" required>
					</div>

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
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Stok Obat Apotek</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_1" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Obat</th>
								<th>Kategori</th>
								<th>Tanggal Penerimaan</th>
								<th>Stok Saat Ini</th>
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

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>

<script>
	var count1 = 0;
	var jumlah_detail_transaksi = 0;

	$(document).on('change', '#xx', function(event) {
		var nilai_value = $('#xx').val();

		// Fetch data
		$.ajax({
			url: "<?php echo base_url() . 'apotek/penjualan_obat/get_pasien_by_no_ref_pelayanan'; ?>",
			type: 'post',
			data: {
				nilai: nilai_value
			},
			success: function(hasil) {

				// parse
				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					$.each(data, function(i, item) {

						var nama = data[i].nama;
						var alamat = data[i].alamat;
						var tgl_lahir = data[i].tgl_lahir;

						// parse
						var tahun = tgl_lahir.substring(0, 4);

						var date = new Date();
						var year = date.getFullYear();

						var umur = year - tahun;

						$("#txt_nama").html(nama);
						$("#txt_alamat").html(alamat);
						$("#txt_umur").html(umur);
					});
				} else {

					alert("Data Dengan Kode : " + nilai_value + " Tidak Ditemukan !");

				}
			}
		});
	});

	// jika kita tekan / click button search-button
	$('#btn_search').on('click', function() {
		search_proses();
	});

	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris', function() {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

		cekJumlahDataDetailTransaksi();
	});

	// jika kita mengubah class inputan rupiah
	$(document).on('keyup', '.rupiah', function() {

		var row_id = $(this).attr("id"); // qty1++
		var row_no = row_id.substring(3); // 1++

		var val_qty = parseInt($('#' + row_id).val());
		var val_qty_sekarang = parseInt($('#qty_sekarang' + row_no).val());

		if (val_qty <= val_qty_sekarang) {
			update_total();
		} else {
			alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek");
			$('#' + row_id).val("1");
			update_total();
		}
	});

	// jika di click simpan / submit
	$(document).on('submit', '#transaksi_form', function(event) {
		event.preventDefault();

		// mengambil nilai di dalam form
		var form_data = $(this).serialize();

		// tambah ke database
		$.ajax({
			url: "<?php echo base_url() . 'apotek/penjualan_obat/input_transaksi_form'; ?>",
			method: "POST",
			data: form_data,
			success: function(data) {
				if (data != "") {
					alert(data);
				}
				location.reload();
			}
		});
		// tambah ke database

	});

	// Start pencarian
	function search_proses() {

		var table;
		table = $('.table_1').DataTable();

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'apotek/penjualan_obat/tampil_daftar_obat'; ?>",
			success: function(hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function(i, item) {

						var kode = data[i].no_stok_obat_a;
						var nama = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;
						var tgl_penerimaan_o = data[i].tgl_penerimaan_o;
						var qty_sekarang = data[i].qty_sekarang;
						var harga_jual = data[i].harga_jual;

						var button = `<a onclick="pilihObat('` + kode +
							`','` + nama + `','` + harga_jual + `','` + qty_sekarang + `')" id="` + kode +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						table.row.add([no, nama, nama_kategori, tgl_penerimaan_o, qty_sekarang,
							harga_jual, button
						]);

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
	function pilihObat(kode, nama, harga_jual, qty_sekarang) {

		$('#detail_list').append(`

			<div id="row` + count1 + `" class="form-row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama[]" class="form-control form-control-sm karakter" id="nama` + count1 +
			`" placeholder="Nama" required value="` + nama + `">
					<input type="hidden" name="no_stok_obat_a[]" class="form-control form-control-sm" id="no_stok_obat_a` + count1 +
			`" value="` +
			kode + `">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_jual[]" class="form-control form-control-sm rupiah text-right" id="harga_jual` +
			count1 +
			`" placeholder="harga supplier" required value="` + harga_jual + `">
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="qty[]" class="form-control form-control-sm rupiah" id="qty` + count1 + `" placeholder="QTY" value="1" required>
					<input type="hidden" name="qty_sekarang[]" id="qty_sekarang` + count1 + `" class="form-control form-control-sm" value="` + qty_sekarang + `"></input>
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
		$('#exampleModalCenter').modal('hide');

		cekJumlahDataDetailTransaksi();
	}

	function cekJumlahDataDetailTransaksi() {

		var x = document.getElementById("label_kosong");
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
			url: "<?php echo base_url() . 'apotek/penjualan_obat/ambil_total'; ?>",
			method: "POST",
			data: form_data,
			success: function(data) {
				$('#total_harga').val(data);
				$('.rupiah').trigger('input'); // Will be display 
			}
		});

		validasi();
	}

	function validasi() {
		$('.rupiah').mask('000.000.000', {
			reverse: true
		});
	}
</script>