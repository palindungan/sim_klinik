<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Obat</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>

			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Obat</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('apotek/obat/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail2">Nama Obat</label>
									<input type="text" name="nama" class="form-control karakterAngka" id="inputEmail2"
										placeholder="Masukan nama kategori obat" required>
								</div>
								<div class="form-group col-md-6">
									<label for="inputEmail3">Kategori Obat</label>
									<select name="no_kat_obat" class="form-control" id="inputEmail3">
										<?php foreach($kategori as $row):?>
										<option value="<?= $row->no_kat_obat ?>"><?= $row->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label for="inputEmail4">Min Stok</label>
									<input type="text" name="min_stok" class="form-control min_stok" id="inputEmail4"
										placeholder="Masukan minimal stok" required>
								</div>
								<div class="form-group col-md-6">
									<label for="inputEmail5">Harga Jual</label>
									<input type="text" name="harga_jual" class="form-control rupiah" id="inputEmail5"
										placeholder="Masukan harga jual" required>
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
							<th width="5%" class="text-center">Kode</th>
							<th width="25%">Nama Obat</th>
							<th width="15%">Kategori</th>
							<th width="10%">Min. Stok</th>
							<th width="15%" class="text-center">Harga Jual</th>
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
							<td class="text-center"><?= $data->kode_obat ?></td>
							<td><?= $data->nama_obat ?></td>
							<td><?= $data->nama_kategori ?></td>
							<td><?= $data->min_stok ?></td>
							<td class="text-right"><?= $data->harga_jual ?></td>
							<td class="text-center">
								<a style="cursor:pointer" class="btn btn-warning text-white" data-toggle="modal"
									data-target="#modal-edit<?= $data->kode_obat ?>">Edit</a>
								<a onclick="return confirm('Anda yakin ingin menghapus data?')"
									href="<?= base_url('apotek/kategori_obat/delete/'.$data->kode_obat) ?>"
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
<div id="modal-edit<?=$data->kode_obat;?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Tindakan Balai Pengobatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('apotek/kategori_obat/update'); ?>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-md-8">
						<input type="hidden" name="kode_obat" value="<?= $data->kode_obat ?>">
						<label for="inputEmail2">Nama Kategori Obat</label>
						<input type="text" name="nama" value="<?= $data->nama_obat ?>" class="form-control karakter"
							id="inputEmail2" placeholder="Masukan nama kategori obat" required>
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
