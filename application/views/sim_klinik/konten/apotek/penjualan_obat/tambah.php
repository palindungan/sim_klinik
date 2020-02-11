<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Penjualan</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">

				<div class="form-row">
					<div class="form-group col-sm-5">
						<label>Cari No Ref</label>
						<select id="xx" class="form-control form-control-sm itemName" name="no_ref_pelayanan" required>
						</select>
					</div>
					<div class="form-group col-sm-5">
						<label for="inputEmail4">Tipe Pelayanan</label>
						<select name="tipe_pelayanan" class="form-control form-control-sm" id="tipe_pelayanan" required>
							<option value="">-</option>
							<option value="Rawat Jalan">Rawat Jalan</option>
							<option value="Rawat Inap">Rawat Inap</option>
							<option value="IGD">IGD</option>
						</select>
					</div>
				</div>

				<div class="row">
					<div class="form-group col-md-2">
						<a href="#" id="btn_search_apotek_obat" class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#exampleModalCenter_apotek_obat">Obat Apotek</a>
					</div>
				</div>

				<input type="hidden" readonly name="sub_total_apotek_obat" class="angka_default form-control form-control-sm rupiah text-right" id="sub_total_apotek_obat" placeholder="Sub Total Obat Apotek">

				<div class="row">
					<div class="col-md-12">
						<table class="table table-sm table-bordered table-striped">
							<thead>
								<tr>
									<td>Rincian</td>
									<td width="10%">Qty</td>
									<td>Biaya</td>
									<td width="20%">Sub Total</td>
									<td width="5%">Hapus</td>
								</tr>
							</thead>

							<tbody>
								<tr id="label_kosong">
									<td>
										Detail Transaksi Masih Kosong !
									</td>
									<td></td>
									<td></td>
									<td></td>
									<td></td>
								</tr>
							</tbody>

							<tbody id="detail_list_apotek_obat"></tbody>

							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td align="right">Grand Total :</td>
									<td>
										<input readonly type="hidden" name="grand_total_lainnya" class="angka_default form-control form-control-sm rupiah text-right" id="grand_total_lainnya" placeholder="Grand Total Lainnya" required value="">
										<input readonly type="text" name="grand_total" class="angka_default form-control form-control-sm rupiah text-right" id="grand_total" placeholder="Grand Total" required value="">
									</td>
									<td></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>

				<div class="form-row">
					<div class="col-sm-2">
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

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/select2.min.js"></script>
<script type="text/javascript">
	$('.itemName').select2({
		ajax: {
			url: "<?= base_url('apotek/penjualan_obat/tampil_select') ?>",
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

	// Deklarasi Variable 
	var count_transaksi = 0;
	var jumlah_detail_transaksi = 0;
</script>

<!-- start of pecahan codingan script -->
<?php $this->view('sim_klinik/konten/administrasi/tagihan/load_php/apotek_obat.php') ?>

<?php $this->view('sim_klinik/konten/apotek/penjualan_obat/load_php/load_all_detail.php') ?>
<!-- end of pecahan codingan script -->

<script>
	function cek_jumlah_data_detail_transaksi() {

		var x = document.getElementById("label_kosong").style;
		if (jumlah_detail_transaksi > 0) {
			x.display = "none"; // hidden
		} else {
			x.display = "table-row"; // show
		}
		update_grand_total();
	}

	function validasi() {
		$('.rupiah').mask('000.000.000', {
			reverse: true
		});
	}

	function update_grand_total() {

		var sub_total_apotek_obat = $('#sub_total_apotek_obat').val();
		var sub_total_apotek_obat_v = 0;
		if (sub_total_apotek_obat != "") {
			sub_total_apotek_obat_v = parseInt(sub_total_apotek_obat.split('.').join(''));
		}

		$('#grand_total').val(sub_total_apotek_obat_v);
		$('#grand_total').trigger('input'); // Will be display 
	}

	// jika di click simpan / submit
	$(document).on('submit', '#transaksi_form', function(event) {
		event.preventDefault();

		if (jumlah_detail_transaksi > 0) {

			// mengambil nilai di dalam form
			var form_data = $(this).serialize();

			// tambah ke database
			$.ajax({
				url: "<?php echo base_url() . 'apotek/penjualan_obat/input_transaksi_form'; ?>",
				method: "POST",
				data: form_data,
				success: function(data) {
					location.reload();
				}
			});
			// tambah ke database
		} else {
			alert("Detail Transaksi Kosong !");
		}
	});
</script>