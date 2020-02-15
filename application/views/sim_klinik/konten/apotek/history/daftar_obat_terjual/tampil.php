<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">History Obat Terjual</h6>
		</div>
		<div class="card-body">
		<h5>Laporan Obat</h5>
			<form action="<?php echo base_url('apotek/penjualan_obat/cetak_custom') ?>" method="post">
				<div class="row mb-3">
					<div class="col-md-3">
						<input type="date" class="form-control form-control-sm" placeholder="Tanggal Mulai" name="tgl_mulai"/>
					</div>
					<div class="col-md-1">
						<h6 class="mt-2 text-center">Sampai</h6>
					</div>
					<div class="col-md-3">
						<input type="date" class="form-control form-control-sm" placeholder="Tanggal Akhir" name="tgl_akhir"/>
					</div>
					<div class="col-md-2">
						<button type="submit" class="btn btn-sm btn-success">Cetak Custom</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
