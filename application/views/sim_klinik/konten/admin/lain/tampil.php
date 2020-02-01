<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<?php if ($this->session->flashdata('update')) : ?>
	<div class="pesan-update" data-flashdata="<?= $this->session->flashdata('update'); ?>"></div>
<?php endif; ?>
<?php if ($this->session->flashdata('hapus')) : ?>
	<div class="pesan-hapus" data-flashdata="<?= $this->session->flashdata('hapus'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Lain</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Lain</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('admin/lain/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Nama Lain</label>
									<input type="text" name="nama" class="form-control form-control-sm" id="inputEmail2" placeholder="Masukan nama" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Harga</label>
									<input type="text" name="harga" class="form-control form-control-sm rupiah" id="inputEmail2" placeholder="Masukan Harga" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Tipe</label>
									<select name="tipe" class="form-control form-control-sm" id="exampleFormControlSelect1" required>
										<option value="">---Pilih Tipe--</option>
										<option value="Koperasi">Koperasi</option>
										<option value="EKG">EKG</option>
										<option value="Lain">Lain</option>
									</select>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-sm btn-success">Simpan</button>
							<button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Nama Lain</th>
							<th width="15%" class="text-center">Biaya</th>
							<th width="15%" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($record as $data) :
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $data->nama ?></td>
								<td class="text-right"><?= rupiah($data->harga) ?></td>
								<td class="text-center">
									<a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#modal-edit<?= $data->no_lain ?>">Edit</a>
									<a href="<?= base_url('admin/lain/delete/' . $data->no_lain) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- Modal Edit -->
<?php foreach ($record as $data) :  ?>
	<div id="modal-edit<?= $data->no_lain; ?>" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Data Lain</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php echo form_open('admin/lain/update'); ?>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="inputEmail2">Nama Lain</label>
							<input type="text" name="nama" class="form-control form-control-sm" id="inputEmail2" placeholder="Masukan nama" required>
						</div>
						<div class="form-group col-sm-6">
							<label for="inputEmail2">Harga</label>
							<input type="text" name="harga" class="form-control form-control-sm rupiah" id="inputEmail2" placeholder="Masukan Harga" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="inputEmail2">Tipe</label>
							<select name="tipe" class="form-control form-control-sm" id="exampleFormControlSelect1" required>
								<option value="">---Pilih Tipe--</option>
								<option value="Koperasi">Koperasi</option>
								<option value="EKG">EKG</option>
								<option value="Lain">Lain</option>
							</select>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-success">Update</button>
					<button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
				</div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
<?php endforeach; ?>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
	$('.tombol-hapus').on('click', function(e) {
		e.preventDefault();
		var href = $(this).attr('href');
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data lain akan dihapus",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#7f8c8d',
			confirmButtonText: 'Hapus',
			cancelButtonText: 'Batal'
		}).then((result) => {
			if (result.value) {
				document.location.href = href;
				// Swal.fire(
				// 	'Deleted!',
				// 	'Your file has been deleted.',
				// 	'success'
				// )
			}
		})
	});
</script>