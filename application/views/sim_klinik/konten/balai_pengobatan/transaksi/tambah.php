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
			<form action="" method="post" id="myform">
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
						<label for="">Biodata Pasien</label>
						<div id="muncul">
						</div>
					</div>
				</div>

				<div class="form-row">

					<div class="form-group col-md-2">
						<a href="#" class="btn btn-success btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-check"></i>
							</span>
							<span class="text">Cari Tindakan</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<div class="form-group col-md-5">
						<input type="text" name="nama" class="form-control karakter" id="" placeholder="Nama" required>
					</div>
					<div class="form-group col-md-5">
						<input type="text" name="harga" class="form-control rupiah" id="" placeholder="Harga" required>
					</div>
					<div class="form-group col-md-2">
						<a href="#" class="btn btn-success btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-check"></i>
							</span>
							<span class="text">Hapus</span>
						</a>
					</div>
				</div>

				<div class="form-row">
					<div class="form-group col-md-10"> </div>

					<div class="form-group col-md-2">
						<button class="btn btn-primary btn-icon-split">
							<span class="icon text-white-50">
								<i class="fas fa-flag"></i>
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

<script>
	hari_ini();
	$(document).on('change', '#xx', function(event) {
		event.preventDefault();
		hari_ini();
	});

	function hari_ini() {
		var form_data = $("#myform").serialize();
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