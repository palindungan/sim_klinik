<?php if ($this->session->flashdata('success')) : ?>
<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Rawat Inap</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">
				<div class="form-row">
					<div class="form-group col-sm-5">
						<label>Cari No Ref</label>
						<select class="form-control form-control-sm noRef" name="no_ref_pelayanan" required>
						</select>
					</div>
				</div>
				<div class="row">
					<div class="form-group col-md-2">
						<a href="#" id="btn_search_kamar" class="btn btn-sm btn-primary col-md-12" data-toggle="modal"
							data-target="#exampleModalCenter_kamar">Kamar Rawat Inap</a>
					</div>
					<div class="form-group col-md-2">
						<a href="#" id="btn_search_tindakan" class="btn btn-sm btn-primary col-md-12"
							data-toggle="modal" data-target="#exampleModalCenter_tindakan">Tindakan Rawat Inap</a>
					</div>
					<div class="form-group col-md-2">
						<a href="#" id="btn_search_obat" class="btn btn-sm btn-primary col-md-12" data-toggle="modal"
							data-target="#exampleModalCenter_obat">Obat Rawat Inap</a>
					</div>
				</div>

				<input type="hidden" readonly name="sub_total_harga_tindakan"
					class="form-control form-control-sm rupiah text-right" id="sub_total_harga_tindakan">
				<input type="hidden" readonly name="sub_total_harga_kamar"
					class="form-control form-control-sm rupiah text-right" id="sub_total_harga_kamar">
				<input type="hidden" readonly name="sub_total_harga_obat"
					class="form-control form-control-sm rupiah text-right" id="sub_total_harga_obat">

				<div class="row">
					<div class="col-md-12">
						<table class="table table-sm table-bordered table-striped">
							<thead>
								<tr>
									<td>Rincian</td>
									<td width="10%">Qty</td>
									<td>Biaya</td>
									<td>Sub Total</td>
									<td width="10%">Hapus</td>
								</tr>
							</thead>
							<tbody id="detail_list">

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
							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td align="right">Grand Total :</td>
									<td>
										<input readonly type="text" name="grand_total"
											class="form-control form-control-sm rupiah text-right" id="grand_total"
											placeholder="0" required value="">
									</td>
									<td></td>
								</tr>
							</tfoot>
						</table>
					</div>
				</div>




				<div id="list_detail">

				</div>

				<!-- <div class="form-row">
					<div class="form-group col-sm-5">
						<input type="text" readonly name="total_harga"
							class="rupiah_grant_total form-control form-control-sm rupiah_kamar text-right"
							id="total_harga" placeholder="Total" required>
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
				</div> -->

			</form>
		</div>
	</div>

</div>





<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script>
	$('.noRef').select2({
		ajax: {
			url: "<?= base_url('apotek/penjualan_obat/tampil_select') ?>",
			dataType: "json",
			delay: 250,
			data: function (params) {
				return {
					no_ref: params.term,
					nama: params.term
				};
			},
			processResults: function (data) {
				var results = [];

				$.each(data, function (index, item) {
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
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/tindakan_ri.php') ?>
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/kamar_ri.php') ?>
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/obat_ri.php') ?>
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/submit_ri.php') ?>

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

		var sub_total_harga_kamar = $('#sub_total_harga_kamar').val();
		var sub_total_harga_kamar_v = 0;
		if (sub_total_harga_kamar != "") {
			sub_total_harga_kamar_v = parseInt(sub_total_harga_kamar.split('.').join(''));
		}

		var sub_total_harga_tindakan = $('#sub_total_harga_tindakan').val();
		var sub_total_harga_tindakan_v = 0;
		if (sub_total_harga_tindakan != "") {
			sub_total_harga_tindakan_v = parseInt(sub_total_harga_tindakan.split('.').join(''));
		}

		var sub_total_harga_obat = $('#sub_total_harga_obat').val();
		var sub_total_harga_obat_v = 0;
		if (sub_total_harga_obat != "") {
			sub_total_harga_obat_v = parseInt(sub_total_harga_obat.split('.').join(''));
		}


		$('#grand_total').val(sub_total_harga_kamar_v + sub_total_harga_tindakan_v + sub_total_harga_obat_v);
		$('#grand_total').trigger('input'); // Will be display 
	}

</script>
