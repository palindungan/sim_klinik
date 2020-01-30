<?php if($this->session->flashdata('success')) : ?>
<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<?php if($this->session->flashdata('update')) : ?>
<div class="pesan-update" data-flashdata="<?= $this->session->flashdata('update'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
		</div>
		<div class="card-body">

			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>

			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Pasien</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('admin/pasien/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">No RM</label>
									<input type="text" name="no_rm" class="form-control form-control-sm"
										id="inputEmail2" placeholder="Masukan NO RM" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Nama</label>
									<input type="text" name="nama" class="form-control form-control-sm" id="inputEmail2"
										placeholder="Masukkan Nama" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Alamat</label>
									<textarea class="form-control form-control-sm" name="alamat"
										placeholder="Masukan alamat" id="exampleFormControlTextarea1" rows="2"
										required></textarea>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Umur</label>
									<textarea class="form-control form-control-sm karakterAngka" name="umur"
										placeholder="Masukan Umur" id="exampleFormControlTextarea1" required></textarea>
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
							<th class="text-center">No RM</th>
							<th class="text-center">Nama</th>
							<th class="text-center">Alamat</th>
							<th>Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						foreach($record as $data):
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $data->no_rm ?></td>
							<td><?= $data->nama ?></td>
							<td><?= $data->alamat ?></td>
							<td class="text-center">
								<a href="<?php echo base_url('admin/pasien/view_edit/'.$data->no_rm) ?>"
									class="btn btn-sm btn-warning">Edit Data</a>
								<a href="<?php echo base_url('admin/pasien/list/'.$data->no_rm) ?>"
									class="btn btn-sm btn-info">Detail Kunjungan</a>
							</td>

						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
