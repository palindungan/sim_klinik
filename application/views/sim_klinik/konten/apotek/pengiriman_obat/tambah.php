<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Pengiriman Obat Rawat Inap</h6>
		</div>
		<div class="card-body">
			<form method="post" id="pengiriman_form">
				<div class="form-row">
					<div class="form-group col-sm-2">
						<label for="" class="mt-2">Tujuan Obat Dikirim :</label>
					</div>
					<div class="form-group col-sm-4">
						<select class="form-control form-control-sm" name="tujuan">
							<option value="Rawat Inap">Rawat Inap</option>
						</select>
					</div>
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
					<label class=" col-sm-4"><b>Kategori</b></label>
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
					</div>

					<div class="form-group col-sm-2">
						<button id="action" type="submit" class="btn btn-sm btn-success btn-icon-split" onclick="return confirm('Lakukan Simpan Data ?')">
							<span class="icon text-white-50">
								<i class="fas fa-save"></i>
							</span>
							<span class="text">Kirim Obat</span>
						</button>
					</div>

				</div>

			</form>
		</div>
	</div>

</div>
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
	$('#btn_search').on('click', function() {
		search_proses();
	});

	function search_proses() {

		var table;
		table = $('.table_1').DataTable();

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'apotek/pengiriman_obat/tampil_daftar_obat'; ?>",
			success: function(hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function(i, item) {

						var kode = data[i].no_stok_obat_a;
						var nama = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;
						var qty = data[i].qty_sekarang;

						var button = `<a onclick="pilihObat('` + kode +
							`','` + nama + `','` + nama_kategori + `','` + qty + `')" id="` + kode +
							`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

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
	function pilihObat(kode, nama, nama_kategori, qty_sekarang) {

		$('#detail_list').append(`

        <div id="row` + count1 + `" class="form-row">
            <div class="form-group col-sm-5">
                <input type="text" readonly name="nama[]" class="form-control form-control-sm karakter" id="nama` +
			count1 + `"
                    placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="kode_obat[]" class="form-control form-control-sm" id="kode_obat` + count1 + `"
                    value="` + kode +
			`">
            </div>
            <div class="form-group col-sm-4">
                <input type="text" readonly name="nama_kategori[]" class="form-control form-control-sm rupiah" id="nama_kategori` +
			count1 + `"
                    placeholder="harga supplier" value="` + nama_kategori + `" required>
            </div>
            <div class="form-group col-sm-1">
                <input type="text" name="qty[]" class="form-control form-control-sm rupiah" id="qty` + count1 + `"
                    placeholder="QTY" required>
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
			$('#' + row_id).val("");
		}
	});


	$(document).on('click', '.remove_baris', function() {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_pengiriman = jumlah_detail_pengiriman - 1;

		cekJumlahDataPenerimaan();
	});

	$(document).on('submit', '#pengiriman_form', function(event) {
		event.preventDefault();

		// mengambil nilai di dalam form
		var form_data = $(this).serialize();

		// tambah ke database
		$.ajax({
			url: "<?php echo base_url() . 'apotek/pengiriman_obat/input_pengiriman_obat'; ?>",
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
</script>