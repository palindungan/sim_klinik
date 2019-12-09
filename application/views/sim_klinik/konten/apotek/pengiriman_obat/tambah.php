<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Pengiriman Obat Rawat Inap</h6>
		</div>
		<div class="card-body">
			<form method="post" id="pengiriman_form">
				<div class="form-row">
					<div class="form-group col-md-2">
						<label for="" class="mt-2">Tujuan Obat Dikirim :</label>
					</div>
					<div class="form-group col-md-4">
						<select class="form-control" name="tujuan">
							<option value="Rawat Inap">Rawat Inap</option>
						</select>
					</div>
				</div>

				<div class="form-row">

					<div class="form-group col-md-12">
						<a href="#" id="btn_search" class="btn btn-success btn-icon-split" data-toggle="modal"
							data-target="#exampleModalCenter">
							<span class="icon text-white-50">
								<i class="fas fa-search-plus"></i>
							</span>
							<span class="text">Cari Data Obat</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<label class=" col-md-5">Nama Obat</label>
					<label class=" col-md-4">Kategori</label>
					<label class=" col-md-1">QTY</label>
				</div>

				<!-- start untuk keranjang Obat -->
				<div id="detail_list">
					<!-- disini isi detail -->
					<h5 id="label_kosong">Detail Obat Masih Kosong Lakukan pilih Pencarian Obat !</h5>

				</div>
				<!-- end of untuk keranjang Obat -->

				<div class="form-row">
					<div class="form-group col-md-5"> </div>

					<div class="form-group col-md-5">
					</div>

					<div class="form-group col-md-2">
						<button id="action" type="submit" class="btn btn-primary btn-icon-split"
							onclick="return confirm('Lakukan Simpan Data ?')">
							<span class="icon text-white-50">
								<i class="fas fa-paper-plane"></i>
							</span>
							<span class="text">Kirim Obat</span>
						</button>
					</div>

				</div>

			</form>
		</div>
	</div>

</div>
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog"
	aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Data Stok Obat Apotek</h5>
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
								<th>Kategori</th>
								<th>Stok</th>
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
	var jumlah_detail_pengiriman = 0;
	// jika kita tekan / click button search-button
	$('#btn_search').on('click', function () {
		search_proses();
	});

	function search_proses() {

		var table;
		table = $('.table_1').DataTable();

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'apotek/pengiriman_obat/tampil_daftar_obat'; ?>",
			success: function (hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function (i, item) {

						var kode = data[i].no_stok_obat_a;
						var nama = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;
						var qty = data[i].qty_sekarang;

						var button = `<a onclick="pilihObat('` + kode +
							`','` + nama + `','` + nama_kategori + `')" id="` + kode +
							`" class="btn btn-danger text-white">Pilih</a>`;

						table.row.add([no, nama, nama_kategori, qty, button]);

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
	function pilihObat(kode, nama, nama_kategori) {

		$('#detail_list').append(`

        <div id="row` + count1 + `" class="form-row">
            <div class="form-group col-md-5">
                <input type="text" readonly name="nama[]" class="form-control karakter" id="nama` + count1 + `"
                    placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="kode_obat[]" class="form-control" id="kode_obat` + count1 + `"
                    value="` + kode + `">
            </div>
            <div class="form-group col-md-4">
                <input type="text" readonly name="nama_kategori[]" class="form-control rupiah" id="nama_kategori` +
			count1 + `"
                    placeholder="harga supplier" value="` + nama_kategori + `" required>
            </div>
            <div class="form-group col-md-1">
                <input type="text" name="qty[]" class="form-control rupiah" id="qty` + count1 + `"
                    placeholder="QTY" required>
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
		jumlah_detail_pengiriman = jumlah_detail_pengiriman + 1;
		$('#exampleModalCenter').modal('hide');

		cekJumlahDataPenerimaan();
	}

	function cekJumlahDataPenerimaan() {

		var x = document.getElementById("label_kosong");
		if (jumlah_detail_pengiriman > 0) {
			x.style.display = "none"; // hidden
		} else {
			x.style.display = "block"; // show
		}

	}

	$(document).on('click', '.remove_baris', function () {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_pengiriman = jumlah_detail_pengiriman - 1;

		cekJumlahDataPenerimaan();
	});

	$(document).on('submit', '#pengiriman_form', function (event) {
		event.preventDefault();

		// mengambil nilai di dalam form
		var form_data = $(this).serialize();

		// tambah ke database
		$.ajax({
			url: "<?php echo base_url() . 'apotek/pengiriman_obat/input_pengiriman_obat'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
				alert(data);
				location.reload();
			}
		});
		// tambah ke database

	});

</script>
