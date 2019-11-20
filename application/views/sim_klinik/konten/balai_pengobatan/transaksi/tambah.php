<style>
	.select2-selection__rendered {
		line-height: 36px !important;
	}

	.select2-selection {
		height: 38px !important;
	}
</style>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Balai Pengobatan</h6>
		</div>
		<div class="card-body">
			<form action="" method="post" id="transaksi_form">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputEmail3">No Ref Pelayanan</label>
						<select id="xx" class="form-control" name="no_ref_pelayanan" required>
							<option value="">-- Pilih Data --</option>
							<?php foreach ($record as $data) : ?>
								<option value="<?= $data->no_ref_pelayanan ?>">
									<?= $data->no_ref_pelayanan . " || " . $data->nama ?>
								</option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-12">
						<label>Biodata Pasien</label>
						<div id="muncul">
						</div>
					</div>
				</div>

				<div class="form-row">

					<div class="form-group col-md-12">
						<a href="#" id="btn_search" class="btn btn-success btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
							<span class="icon text-white-50">
								<i class="fas fa-search-plus"></i>
							</span>
							<span class="text">Cari Tindakan</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<label class=" col-md-5">Nama Tindakan</label>
					<label class=" col-md-5">Biaya</label>
				</div>

				<!-- start untuk keranjang tindakan -->
				<div id="detail_list">
					<!-- disini isi detail -->
					<h5 id="label_kosong">Detail Tindakan Masih Kosong Lakukan pilih Pencarian Tindakan !</h5>

				</div>
				<!-- end of untuk keranjang tindakan -->

				<div class="form-row">
					<div class="form-group col-md-5"> </div>

					<div class="form-group col-md-5">
						<input type="text" readonly name="total_harga" class="form-control rupiah" id="total_harga" placeholder="Total" required>
					</div>

					<div class="form-group col-md-2">
						<button class="btn btn-primary btn-icon-split" onclick="return confirm('Lakukan Simpan Data ?')">
							<span class="icon text-white-50">
								<i class="fas fa-paper-plane"></i>
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
								<th>No</th>
								<th>Nama</th>
								<th>Harga</th>
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
	hari_ini();
	$(document).on('change', '#xx', function(event) {
		event.preventDefault();
		hari_ini();
	});

	function hari_ini() {
		var form_data = $("#transaksi_form").serialize();
		$.ajax({
			url: "<?php echo base_url(); ?>balai_pengobatan/transaksi/tampil",
			method: "POST",
			data: form_data,
			success: function(data) {
				$("#muncul").html(data);
			}
		});
	}
</script>

<script>
	var count1 = 0;
	var jumlah_detail_transaksi = 0;

	// jika kita tekan / click button search-button
	$('#btn_search').on('click', function() {
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
			url: "<?php echo base_url() . 'manager/pemasokan/input_transaksi_form'; ?>",
			method: "POST",
			data: form_data,
			success: function(data) {
				alert(data);
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
						var button = `<a onclick="pilihTindakan('` + kode +
							`','` + nama + `','` + harga + `')" id="` + kode + `" class="btn btn-danger text-white">Pilih</a>`;

						table.row.add([no, nama, harga, button]);

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
	function pilihTindakan(kode, nama, harga) {

		$('#detail_list').append(`

			<div id="row` + count1 + `" class="form-row">
				<div class="form-group col-md-5">
					<input type="text" name="nama[]" class="form-control karakter" id="nama` + count1 + `" placeholder="Nama" required value="` + nama + `">
					<input type="hidden" name="no_bp_t[]" class="form-control" id="no_bp_t` + count1 + `" value="` + kode + `">
				</div>
				<div class="form-group col-md-5">
					<input type="text" name="harga[]" class="form-control rupiah" id="harga` + count1 + `" placeholder="Harga" required value="` + harga + `">
				</div>
				<div class="form-group col-md-2">
					<a id="` + count1 + `" href="#" class="btn btn-success btn-icon-split remove_baris">
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

		cekJumlahDataTransaksi();
	}

	function cekJumlahDataTransaksi() {

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
			url: "<?php echo base_url() . 'balai_pengobatan/transaksi/ambil_total'; ?>",
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