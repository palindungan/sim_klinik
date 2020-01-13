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
			<h6 class="m-0 font-weight-bold text-primary">Data Logistik</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
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
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Nama Obat / Alkes</label>
									<input type="text" name="nama" class="form-control form-control-sm" id="inputEmail2"
										placeholder="Masukan nama kategori obat" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail3">Kategori Obat</label>
									<select name="no_kat_obat" class="form-control form-control-sm" id="inputEmail3">
										<?php foreach($kategori as $row):?>
										<option value="<?= $row->no_kat_obat ?>"><?= $row->nama ?></option>
										<?php endforeach; ?>
									</select>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail4">Min Stok</label>
									<input type="text" name="min_stok" class="form-control form-control-sm min_stok"
										id="inputEmail4" placeholder="Masukan minimal stok" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail5">Harga Jual</label>
									<input type="text" name="harga_jual" class="form-control form-control-sm rupiah"
										id="inputEmail5" placeholder="Masukan harga jual" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail3">Tipe Logistik</label>
									<select name="tipe_logistik" class="form-control form-control-sm" id="inputEmail3">
										<option value="Obat">Obat</option>
										<option value="Alkes">Alkes</option>
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
							<th width="5%" class="text-center">Kode</th>
							<th width="20%">Nama Obat / Alkes</th>
							<th width="15%">Kategori</th>
							<th width="10%">Min. Stok</th>
							<th width="10%" class="text-center">Harga Jual</th>
							<th width="10%" class="text-center">Tipe Logistik</th>
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
							<td class="text-right"><?= rupiah($data->harga_jual) ?></td>
							<td><?= $data->tipe ?></td>
							<td class="text-center">
								<a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
									data-target="#modal-edit<?= $data->kode_obat ?>">Edit</a>
								<a href="<?= base_url('apotek/obat/delete/'.$data->kode_obat) ?>"
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
<div id="modal-edit<?=$data->kode_obat;?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Tindakan Balai Pengobatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<?php echo form_open('apotek/obat/update'); ?>
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Nama Obat / Alkes</label>
						<input type="hidden" name="kode_obat" value="<?= $data->kode_obat ?>">
						<input type="text" name="nama" value="<?= $data->nama_obat ?>"
							class="form-control form-control-sm" id="inputEmail2"
							placeholder="Masukan nama kategori obat" required>
					</div>
					<div class="form-group col-sm-6">
						<label for="inputEmail3">Kategori Obat</label>
						<select name="no_kat_obat" class="form-control form-control-sm" id="inputEmail3">
							<?php foreach($kategori as $row):?>
							<option value="<?= $row->no_kat_obat ?>"
								<?php if($row->no_kat_obat == $data->no_kat){echo 'selected';} ?>>
								<?= $row->nama ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail4">Min Stok</label>
						<input type="text" name="min_stok" value="<?= $data->min_stok ?>"
							class="form-control form-control-sm min_stok" id="inputEmail4"
							placeholder="Masukan minimal stok" required>
					</div>
					<div class="form-group col-sm-6">
						<label for="inputEmail5">Harga Jual</label>
						<input type="text" name="harga_jual" value="<?= rupiah($data->harga_jual) ?>"
							class="form-control form-control-sm rupiah" id="inputEmail5"
							placeholder="Masukan harga jual" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail3">Tipe Logistik</label>
						<select name="tipe_logistik" class="form-control form-control-sm" id="inputEmail3">
							<option value="Obat" <?php if($data->tipe == 'Obat'){ echo "selected";} ?>>Obat</option>
							<option value="Alkes" <?php if($data->tipe == 'Alkes'){ echo "selected";} ?>>Alkes</option>
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
	$('.tombol-hapus').on('click', function (e) {
		e.preventDefault();
		var href = $(this).attr('href');
		Swal.fire({
			title: 'Apakah anda yakin?',
			text: "Data obat akan dihapus",
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
