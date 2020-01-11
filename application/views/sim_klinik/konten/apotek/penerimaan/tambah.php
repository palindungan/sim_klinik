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
			<h6 class="m-0 font-weight-bold text-primary">Penerimaan Obat</h6>
		</div>
		<div class="card-body">
			<form method="post" id="penerimaan_form">
				<div class="form-row">
					<div class="form-group col-sm-4">
						<label>Suplier</label>
						<select class="form-control form-control-sm" name="no_supplier" required>
							<option value="">-- Pilih Data --</option>
							<?php foreach ($record as $data) : ?>
							<option value="<?= $data->no_supplier ?>">
								<?= $data->no_supplier . " || " . $data->nama ?>
							</option>
							<?php endforeach; ?>
						</select>
					</div>

					<!-- <div class="form-group col-sm-6">
                        <label>Tanggal</label>
                        <input type="date" name="tgl_penerimaan_o" class="form-control form-control-sm" required>
                    </div> -->
				</div>

				<div class="form-row">

					<div class="form-group col-sm-12">
						<a href="#" id="btn_search" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal"
							data-target="#exampleModalCenter">
							<span class="icon text-white-50">
								<i class="fas fa-search-plus"></i>
							</span>
							<span class="text">Cari Data Obat</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<label class=" col-sm-5"><b>Nama Obat</b></label>
					<label class=" col-sm-4"><b>Harga Supplier</b></label>
					<label class=" col-sm-1"><b>QTY</b></label>
				</div>

				<!-- start untuk keranjang Obat -->
				<div id="detail_list">
					<!-- disini isi detail -->
					<h6 id="label_kosong">Detail Obat Masih Kosong Lakukan pilih Pencarian Obat !</h6>

				</div>
				<!-- end of untuk keranjang Obat -->

				<div class="form-row">
					<div class="form-group col-sm-5"> </div>

					<div class="form-group col-sm-5">
						<input type="text" readonly name="total_harga"
							class="form-control form-control-sm rupiah text-right" id="total_harga" placeholder="Total"
							required>
					</div>

					<div class="form-group col-sm-2">
						<button id="action" type="submit" class="btn btn-sm btn-success btn-icon-split"
							onclick="return confirm('Lakukan Simpan Data ?')">
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
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_1" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th width="10%">No</th>
								<th width="45%">Nama</th>
								<th width="40%">Kategori</th>
								<th width="5%">Aksi</th>
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
	var jumlah_detail_penerimaan = 0;

	// jika kita tekan / click button search-button
	$('#btn_search').on('click', function () {
		search_proses();
	});

	// jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris', function () {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_penerimaan = jumlah_detail_penerimaan - 1;

		cekJumlahDatapenerimaan();
	});

	// jika kita mengubah class inputan rupiah
	$(document).on('keyup', '.rupiah', function () {
		update_total();
	});

	// jika di click simpan / submit
	$(document).on('submit', '#penerimaan_form', function (event) {
		event.preventDefault();

		// mengambil nilai di dalam form
		var form_data = $(this).serialize();

		// tambah ke database
		$.ajax({
			url: "<?php echo base_url() . 'apotek/penerimaan/input_penerimaan_form'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
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
			url: "<?php echo base_url() . 'apotek/penerimaan/tampil_daftar_obat'; ?>",
			success: function (hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function (i, item) {

						var kode = data[i].kode_obat;
						var nama = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;

						var button = `<a onclick="pilihObat('` + kode +
							`','` + nama + `')" id="` + kode +
							`" class="btn btn-sm btn-dark text-white text-center">Pilih</a>`;

						table.row.add([no, nama, nama_kategori, button]);

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
	function pilihObat(kode, nama) {

		$('#detail_list').append(`

			<div id="row` + count1 + `" class="form-row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama[]" class="form-control form-control-sm karakter" id="nama` + count1 +
			`" placeholder="Nama" required value="` + nama + `">
					<input type="hidden" name="kode_obat[]" class="form-control form-control-sm" id="kode_obat` + count1 +
			`" value="` + kode +
			`">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_supplier[]" class="form-control form-control-sm rupiah text-right" id="harga_supplier` +
			count1 + `" placeholder="harga supplier" required>
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="qty[]" class="form-control form-control-sm  rupiah" id="qty` + count1 + `" placeholder="QTY" value="1" required>
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
		jumlah_detail_penerimaan = jumlah_detail_penerimaan + 1;
		$('#exampleModalCenter').modal('hide');

		cekJumlahDatapenerimaan();
	}

	function cekJumlahDatapenerimaan() {

		var x = document.getElementById("label_kosong");
		if (jumlah_detail_penerimaan > 0) {
			x.style.display = "none"; // hidden
		} else {
			x.style.display = "block"; // show
		}

		update_total();
	}

	function update_total() {
		// mengambil nilai di dalam form
		var form_data = $('#penerimaan_form').serialize()

		$.ajax({
			url: "<?php echo base_url() . 'apotek/penerimaan/ambil_total'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
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
