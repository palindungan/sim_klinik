<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Supplier</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>

			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Supplier</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('admin/supplier/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail2">Nama Supplier</label>
									<input type="text" name="nama" class="form-control karakterAngka" id="inputEmail2"
										placeholder="Masukan nama supplier" required>
								</div>
								<div class="form-group col-md-6">
									<label for="inputEmail2">Contact Person</label>
									<input type="text" name="cp" class="form-control hp" id="inputEmail2"
										placeholder="Contoh : 08xx-xxxx-xxxx" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail2">Email</label>
									<input type="text" name="email" class="form-control" id="inputEmail2"
										placeholder="Masukan email" required>
								</div>
								<div class="form-group col-md-6">
									<label for="inputEmail2">Alamat</label>
									<textarea class="form-control karakterAngka" name="alamat"
										placeholder="Masukan alamat" id="exampleFormControlTextarea1" rows="2"
										required></textarea>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-primary">Simpan</button>
							<button type="button" class="btn btn-link" data-dismiss="modal">Kembali</button>
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
							<th width="15%">Email</th>
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
							<td><?= $data->email ?></td>
							<td><?= $data->alamat ?></td>
							<td class="text-center">
								<a style="cursor:pointer" class="btn btn-warning text-white" data-toggle="modal"
									data-target="#modal-edit<?= $data->no_supplier ?>">Edit</a>
								<a onclick="return confirm('Anda yakin ingin menghapus data?')"
									href="<?= base_url('admin/supplier/delete/'.$data->no_supplier) ?>"
									class="btn btn-danger">Hapus</a>
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
				<h5 class="modal-title">Edit Tindakan Balai Pengobatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('admin/supplier/update'); ?>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-6">
						<input type="hidden" name="no_supplier" value="<?= $data->no_supplier ?>">
						<label for="inputEmail2">Nama Supplier</label>
						<input type="text" name="nama" value="<?= $data->nama ?>" class="form-control karakterAngka"
							id="inputEmail2" placeholder="Masukan nama supplier" required>

					</div>
					<div class="form-group col-md-6">
						<label for="inputEmail2">Contact Person</label>
						<input type="text" name="cp" value="<?= noHp($data->cp) ?>" class="form-control hp"
							id="inputEmail2" placeholder="Masukan contact person" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputEmail2">Email</label>
						<input type="text" name="email" value="<?= $data->email ?>" class="form-control"
							id="inputEmail2" placeholder="Masukan email" required>

					</div>
					<div class="form-group col-md-6">
						<label for="inputEmail2">Alamat</label>
						<textarea class="form-control karakterAngka" placeholder="Masukan alamat" name="alamat"
							id="exampleFormControlTextarea1" rows="2" required><?= $data->alamat ?></textarea>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary">Simpan</button>
				<button type="button" class="btn btn-link" data-dismiss="modal">Kembali</button>
			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
<?php endforeach; ?>
