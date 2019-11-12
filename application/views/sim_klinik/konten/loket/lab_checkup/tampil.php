<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tindakan Lab Checkup</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>

			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Tindakan Lab Checkup</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('loket/labCheckup/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail2">Nama Tindakan</label>
									<input type="text" name="nama" value="<?= set_value('nik') ?>"
										class="form-control <?php if (form_error('nik') == true) {echo "is-invalid";} ?>"
										id="inputEmail2" placeholder="Masukan nama tindakan">
									<div class="invalid-feedback">
										<?= form_error('nik'); ?>
									</div>
								</div>
								<div class="form-group col-md-6">
									<label for="inputEmail1">Harga Tindakan</label>
									<input type="text" name="harga" value="<?= set_value('nama') ?>"
										class="form-control <?php if (form_error('nama') == true) {echo "is-invalid";} ?>"
										id="inputEmail1" placeholder="Masukan harga tindakan">
									<div class="invalid-feedback">
										<?= form_error('nama'); ?>
									</div>
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
							<th width="20%">Kode</th>
							<th width="40%">Nama Tindakan</th>
							<th width="20%" class="text-center">Harga</th>
							<th width="15%" class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						<?php
                            $no=1;
                            foreach($record as $data)
                            {
                        ?>
						<tr>
							<td class="text-center"><?= $no++ ?></td>
							<td><?= $data->no_lab_c ?></td>
							<td><?= $data->nama ?></td>
							<td class="text-right"><?= $data->harga ?></td>
							<td>
								<a href="" class="btn btn-info">Edit</a>
								<a onclick="return confirm('Anda yakin ingin menghapus data?')"
									href="<?= base_url('loket/labCheckup/delete/'.$data->no_lab_c) ?>"
									class="btn btn-danger">Hapus</a>
							</td>
						</tr>
						<?php 
                            }
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
