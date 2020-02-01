<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Akomodasi Rawat Inap</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">

				<div class="row">
					<div class="form-group col-md-2">
						<a href="#" id="btn_search_apotek_obat" class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#exampleModalCenter_apotek_obat">Obat / Alkes</a>
					</div>
					<div class="form-group col-md-2">
						<a href="#" id="btn_search_lain" class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#exampleModalCenter_lain">Lain-Lain</a>
					</div>
				</div>

				<input type="hidden" readonly name="sub_total_apotek_obat" class="angka_default form-control form-control-sm rupiah text-right" id="sub_total_apotek_obat" placeholder="Sub Total RI Obat">
				<input type="hidden" readonly name="sub_total_lain" class="angka_default form-control form-control-sm rupiah text-right" id="sub_total_lain" placeholder="Sub Total Lain">

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
							<tbody id="detail_list_lain"></tbody>

							<tfoot>
								<tr>
									<td></td>
									<td></td>
									<td align="right">Grand Total :</td>
									<td>
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

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>

<script>
    var count_transaksi = 0;
    var jumlah_detail_transaksi = 0;
</script>
<?php $this->view('sim_klinik/konten/rawat_inap/akomodasi/load_php/obat.php') ?>
<?php $this->view('sim_klinik/konten/rawat_inap/akomodasi/load_php/lain.php') ?>

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

        var sub_total_lain = $('#sub_total_lain').val();
        var sub_total_lain_v = 0;
        if (sub_total_lain != "") {
            sub_total_lain_v = parseInt(sub_total_lain.split('.').join(''));
        }

        $('#grand_total').val(sub_total_apotek_obat_v + sub_total_lain_v);
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
				url: "<?php echo base_url() . 'rawat_inap/akomodasi/input_transaksi_form'; ?>",
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
