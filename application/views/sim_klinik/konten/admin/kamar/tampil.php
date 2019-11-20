<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Kamar</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>
			<?php if($this->session->flashdata('success')) : ?>
			<div class="flash-data" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
			<?php endif; ?>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Kamar</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('admin/kamar/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail2">Nama Kamar</label>
									<input type="text" name="nama" class="form-control karakterAngka" id="inputEmail2"
										placeholder="Masukan nama kamar" required>
								</div>
								<div class="form-group col-md-6">
									<label for="inputEmail2">Tipe</label>
									<input type="text" name="tipe" class="form-control karakterAngka" id="inputEmail2"
										placeholder="Masukan tipe kamar" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail2">Harga</label>
									<input type="text" name="harga" class="form-control rupiah" id="inputEmail2"
										placeholder="Masukan harga/hari" required>
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
							<th width="10%">Kode</th>
							<th width="25%">Nama Kamar</th>
							<th width="20%">Tipe</th>
							<th width="15%" class="text-center">Harga</th>
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
							<td><?= $data->no_kamar_rawat_i ?></td>
							<td><?= $data->nama ?></td>
							<td><?= $data->tipe ?></td>
							<td class="text-right"><?= rupiah($data->harga_harian) ?></td>
							<td class="text-center">
								<a style="cursor:pointer" class="btn btn-warning text-white" data-toggle="modal"
									data-target="#modal-edit<?= $data->no_kamar_rawat_i ?>">Edit</a>
								<a onclick="return confirm('Anda yakin ingin menghapus data?')"
									href="<?= base_url('admin/kamar/delete/'.$data->no_kamar_rawat_i) ?>"
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
<div id="modal-edit<?=$data->no_kamar_rawat_i;?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Kamar</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('admin/kamar/update'); ?>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputEmail2">Nama Kamar</label>
						<input type="hidden" name="no_kamar_rawat_i" value="<?= $data->no_kamar_rawat_i ?>">
						<input type="text" name="nama" value="<?= $data->nama ?>" class="form-control karakterAngka"
							id="inputEmail2" placeholder="Masukan nama kamar" required>
					</div>
					<div class="form-group col-md-6">
						<label for="inputEmail2">Tipe</label>
						<input type="text" name="tipe" value="<?= $data->tipe ?>" class="form-control karakterAngka"
							id="inputEmail2" placeholder="Masukan tipe kamar" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-md-6">
						<label for="inputEmail2">Harga</label>
						<input type="text" name="harga" value="<?= rupiah($data->harga_harian) ?>"
							class="form-control rupiah" id="inputEmail2" placeholder="Masukan harga/hari" required>
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
