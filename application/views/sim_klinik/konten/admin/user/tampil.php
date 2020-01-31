<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<?php if ($this->session->flashdata('update')) : ?>
	<div class="pesan-update" data-flashdata="<?= $this->session->flashdata('update'); ?>"></div>
<?php endif; ?>
<?php if ($this->session->flashdata('hapus')) : ?>
	<div class="pesan-hapus" data-flashdata="<?= $this->session->flashdata('hapus'); ?>"></div>
<?php endif; ?>
<?php if ($this->session->flashdata('username')) : ?>
	<div class="cek-username" data-flashdata="<?= $this->session->flashdata('username'); ?>"></div>
<?php endif; ?>
<?php if ($this->session->flashdata('password')) : ?>
	<div class="cek-password" data-flashdata="<?= $this->session->flashdata('password'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data User</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('admin/user/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail1">Nama</label>
									<input type="text" name="nama" class="form-control form-control-sm karakter" id="inputEmail1" placeholder="Masukan nama user" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Username</label>
									<input type="text" name="username" class="form-control form-control-sm" id="inputEmail2" placeholder="Masukan username" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail3">Password</label>
									<input type="password" name="password" class="form-control form-control-sm" id="inputEmail3" placeholder="Masukan password" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail4">Konfirmasi Password</label>
									<input type="password" name="konfirmasi_password" class="form-control form-control-sm" id="inputEmail4" placeholder="Masukan konfirmasi password" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail5">Jenis Akses</label>
									<select name="jenis_akses" class="form-control form-control-sm" id="inputEmail5">
										<option value="Manager">Manager</option>
										<option value="Admin">Admin</option>
										<option value="Loket">Loket</option>
										<option value="Apotek">Apotek</option>
										<option value="Administrasi">Administrasi</option>
										<option value="Rawat Inap">Rawat Inap</option>
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
							<th width="5%" class="text-center">No</th>
							<th width="10%">Kode</th>
							<th width="20%">Nama</th>
							<th width="15%">Akses</th>
							<th width="15%">Username</th>
							<th width="18%" class="text-center">Ganti Password</th>
							<th width="17%" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no = 1;
						foreach ($record as $data) :
						?>
							<tr>
								<td class="text-center"><?= $no++ ?></td>
								<td><?= $data->no_user_pegawai ?></td>
								<td><?= $data->nama ?></td>
								<td><?= $data->jenis_akses ?></td>
								<td><?= $data->username ?></td>
								<td class="text-center">
									<a style="cursor:pointer" class="btn btn-sm btn-secondary text-white" data-toggle="modal" data-target="#modal-edit2<?= $data->no_user_pegawai ?>">Ganti
										Password</a>
								</td>
								<td class="text-center">
									<a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal" data-target="#modal-edit<?= $data->no_user_pegawai ?>">Edit</a>
									<a href="<?= base_url('admin/user/delete/' . $data->no_user_pegawai) ?>" class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- 
<!-- Modal Edit -->
<?php foreach ($record as $data) :  ?>
	<div id="modal-edit<?= $data->no_user_pegawai; ?>" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Edit Data User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php echo form_open('admin/user/update'); ?>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="inputEmail1">Nama</label>
							<input type="hidden" name="no_user_pegawai" value="<?= $data->no_user_pegawai ?>">
							<input type="text" name="nama" value="<?= $data->nama ?>" class="form-control form-control-sm karakter" id="inputEmail1" placeholder="Masukan nama user" required>
						</div>
						<div class="form-group col-sm-6">
							<label for="inputEmail2">Username</label>
							<input type="text" name="username" value="<?= $data->username ?>" class="form-control form-control-sm" id="inputEmail2" placeholder="Masukan username" required>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="inputEmail5">Jenis Akses</label>
							<select name="jenis_akses" class="form-control form-control-sm" id="inputEmail5">
								<option value="Manager" <?php if ($data->jenis_akses == "Manager") {
															echo 'selected';
														} ?>>Manager
								</option>
								<option value="Admin" <?php if ($data->jenis_akses == "Admin") {
															echo 'selected';
														} ?>>Admin
								</option>
								<option value="Loket" <?php if ($data->jenis_akses == "Loket") {
															echo 'selected';
														} ?>>Loket
								</option>
								<option value="Apotek" <?php if ($data->jenis_akses == "Apotek") {
															echo 'selected';
														} ?>>Apotek
								</option>
								<option value="Administrasi" <?php if ($data->jenis_akses == "Administrasi") {
																	echo 'selected';
																} ?>>
									Administrasi</option>
								<option value="Rawat Inap" <?php if ($data->jenis_akses == "Rawat Inap") {
																echo 'selected';
															} ?>>
									Rawat Inap</option>
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


<!-- Modal Edit -->
<?php foreach ($record as $data) :  ?>
	<div id="modal-edit2<?= $data->no_user_pegawai; ?>" class="modal fade">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Ganti Password User</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<?php echo form_open('admin/user/update_password'); ?>
				<div class="modal-body">
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="inputEmail1">Username</label>
							<input type="hidden" name="no_user_pegawai" value="<?= $data->no_user_pegawai ?>">
							<input type="text" name="username" value="<?= $data->username ?>" class="form-control form-control-sm karakterAngka" id="inputEmail1" placeholder="Masukan username" readonly>
						</div>
						<div class="form-group col-sm-6">
							<label for="inputEmail2">Akses</label>
							<input type="text" name="akses" class="form-control form-control-sm" id="inputEmail2" value=<?= $data->jenis_akses ?> placeholder="Masukan password lama" required readonly>
						</div>
					</div>
					<div class="form-row">
						<div class="form-group col-sm-6">
							<label for="inputEmail5">Password Baru</label>
							<input type="password" name="password_baru" class="form-control form-control-sm" id="inputEmail5" placeholder="Masukan password" required>
						</div>
						<div class="form-group col-sm-6">
							<label for="inputEmail6">Konfirmasi Password Baru</label>
							<input type="password" name="konfirmasi_password" class="form-control form-control-sm" id="inputEmail6" placeholder="Masukan konfirmasi password baru" required>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="submit" class="btn btn-sm btn-success">Ganti</button>
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
			text: "Data user akan dihapus",
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