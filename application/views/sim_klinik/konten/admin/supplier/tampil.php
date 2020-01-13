<?php if($this->session->flashdata('success')) : ?>
<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<?php if($this->session->flashdata('update')) : ?>
<div class="pesan-update" data-flashdata="<?= $this->session->flashdata('update'); ?>"></div>
<?php endif; ?>
<?php if($this->session->flashdata('hapus')) : ?>
<div class="pesan-hapus" data-flashdata="<?= $this->session->flashdata('hapus'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Supplier</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>

			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Supplier</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('admin/supplier/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Nama Supplier</label>
									<input type="text" name="nama" class="form-control form-control-sm karakterAngka"
										id="inputEmail2" placeholder="Masukan nama supplier" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Contact Person</label>
									<input type="text" name="cp" class="form-control form-control-sm hp"
										id="inputEmail2" placeholder="Contoh : 08xx-xxxx-xxxx" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Alamat</label>
									<textarea class="form-control form-control-sm karakterAngka" name="alamat"
										placeholder="Masukan alamat" id="exampleFormControlTextarea1" rows="2"
										required></textarea>
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
							<th width="5%">Kode</th>
							<th width="20%">Nama Supplier</th>
							<th width="15%">Contact</th>
							<th width="20%">Alamat</th>
							<th width="15%" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						foreach($record as $data):
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $data->no_supplier ?></td>
							<td><?= $data->nama ?></td>
							<td><?= noHp($data->cp) ?></td>
							<td><?= $data->alamat ?></td>
							<td class="text-center">
								<a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
									data-target="#modal-edit<?= $data->no_supplier ?>">Edit</a>
								<a href="<?= base_url('admin/supplier/delete/'.$data->no_supplier) ?>"
									class="btn btn-sm btn-danger tombol-hapus">Hapus</a>
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
<?php foreach($record as $data):  ?>
<div id="modal-edit<?=$data->no_supplier;?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Supplier</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('admin/supplier/update'); ?>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-sm-6">
						<input type="hidden" name="no_supplier" value="<?= $data->no_supplier ?>">
						<label for="inputEmail2">Nama Supplier</label>
						<input type="text" name="nama" value="<?= $data->nama ?>"
							class="form-control form-control-sm karakterAngka" id="inputEmail2"
							placeholder="Masukan nama supplier" required>

					</div>
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Contact Person</label>
						<input type="text" name="cp" value="<?= noHp($data->cp) ?>"
							class="form-control form-control-sm hp" id="inputEmail2"
							placeholder="Masukan contact person" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Alamat</label>
						<textarea class="form-control form-control-sm karakterAngka" placeholder="Masukan alamat"
							name="alamat" id="exampleFormControlTextarea1" rows="2"
							required><?= $data->alamat ?></textarea>
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
	$('.tombol-hapus').on('click', function (e) {
		e.preventDefault();
		var href = $(this).attr('href');
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data supplier akan dihapus",
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
