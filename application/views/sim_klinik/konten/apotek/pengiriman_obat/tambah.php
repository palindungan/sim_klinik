<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Transfer Internal</h6>
		</div>
		<div class="card-body">
			<form method="post" id="pengiriman_form" action="<?= base_url() . 'apotek/pengiriman_obat/input_pengiriman_obat'; ?>">
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
							<span class="text">Cari Data Obat/Alkes</span>
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
					<h6 id="label_kosong">Detail Obat Masih Kosong Lakukan Pencarian Obat !</h6>

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
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Data Stok Obat Apotek</h5>
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
	// jika kita tekan / click button search-button
	$('#btn_search').on('click', function() {
		search_proses();
	});

	function search_proses() {

		var table;
		table = $('.table_obat').DataTable({
			"columnDefs": [{
				"targets": [0, 3, 4],
				"className": "text-center"
			}],
			"bDestroy": true,
			"pageLength": 5
		});

		table.clear();

		$.ajax({
			url: "<?php echo base_url() . 'apotek/pengiriman_obat/tampil_daftar_obat'; ?>",
			success: function(hasil) {

				var obj = JSON.parse(hasil);
				let data = obj['tbl_data'];

				if (data != '') {

					var no = 1;

					$.each(data, function(i, item) {

						var kode_obat = data[i].kode_obat;
						var nama_obat = data[i].nama_obat;
						var nama_kategori = data[i].nama_kategori;
						var qty_sekarang = data[i].qty;

						var button = `<a onclick="tambah_detail_obat('` + kode_obat +
							`','` + nama_obat + `','` + nama_kategori + `','` + qty_sekarang + `')" id="` + kode_obat + `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

						table.row.add([no, nama_obat, nama_kategori, qty_sekarang, button]);

						no = no + 1;
					});
				} else {

					$('.table_obat').html('<h3>Tidak Ada Data Yang Tersedia</h3>');

				}
				table.draw();

			}
		});
	}

	var count_pengiriman_obat = 0;
	var jumlah_detail_pengiriman_obat = 0;
	// Start add_row
	function tambah_detail_obat(kode_obat, nama_obat, nama_kategori, qty_sekarang) {

		$('#detail_list').append(`

        <div id="row` + count_pengiriman_obat + `" class="form-row">
            <div class="form-group col-sm-5">
                <input type="text" readonly name="nama_obat[]" class="form-control form-control-sm karakter" id="nama_obat` + count_pengiriman_obat + `" placeholder="Nama" required value="` + nama_obat + `">
                <input type="hidden" name="kode_obat[]" class="form-control form-control-sm" id="kode_obat` + count_pengiriman_obat + `" value="` + kode_obat + `">
            </div>
            <div class="form-group col-sm-4">
                <input type="text" readonly name="nama_kategori[]" class="form-control form-control-sm" id="nama_kategori` + count_pengiriman_obat + `" value="` + nama_kategori + `">
            </div>
            <div class="form-group col-sm-1">
                <input type="text" name="qty[]" class="form-control form-control-sm cek_qty" id="qty` + count_pengiriman_obat + `" placeholder="QTY" required>
				<input type="hidden" name="qty_sekarang[]" id="qty_sekarang` + count_pengiriman_obat + `" class="form-control form-control-sm" value="` + qty_sekarang + `"></input>
			</div>
            <div class="form-group col-sm-2">
                <a id="` + count_pengiriman_obat + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                    <span class="text">Hapus</span>
                </a>
            </div>
        </div>

    	`);

		count_pengiriman_obat = count_pengiriman_obat + 1;
		jumlah_detail_pengiriman_obat = jumlah_detail_pengiriman_obat + 1;
		$('#exampleModalCenter').modal('hide');

		cekJumlahDataPenerimaan();
	}

	function cekJumlahDataPenerimaan() {

		var label = document.getElementById("label_kosong");
		if (jumlah_detail_pengiriman_obat > 0) {
			label.style.display = "none"; // hidden
		} else {
			label.style.display = "block"; // show
		}

	}

	// jika kita mengubah class inputan rupiah
	$(document).on('keyup', '.cek_qty', function() {

		var row_id = $(this).attr("id"); // qty1++
		var row_no = row_id.substring(3); // 1++

		var val_qty = parseInt($('#' + row_id).val());
		var val_qty_sekarang = parseInt($('#qty_sekarang' + row_no).val());

		if (val_qty <= val_qty_sekarang) {

		} else {
			// alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek");
			// $('#' + row_id).val("");
		}
	});

	$(document).on('click', '.remove_baris', function() {
		var row_no = $(this).attr("id");
		$('#row' + row_no).remove();

		jumlah_detail_pengiriman_obat = jumlah_detail_pengiriman_obat - 1;

		cekJumlahDataPenerimaan();
	});
</script>