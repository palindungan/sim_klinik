<?php
foreach ($row as $data) :
?>
	<div class="container-fluid">
		<div class="card shadow mb-4">
			<div class="card-header py-3">
				<h6 class="m-0 font-weight-bold text-primary">Edit Data Pasien</h6>
			</div>
			<div class="card-body">
				<!-- Page Heading -->
				<!-- <h5 class="h3 mb-2 text-gray-800">No. Ref Pelayanan</h5> -->
				<?php echo form_open('admin/pasien/update'); ?>

				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">No RM</label>
						<input value="<?php echo $data->no_rm ?>" type="text" minlength="12" name="no_rm" maxlength="12" class="form-control form-control-sm" id="no_rm" placeholder="Masukan NO RM" required>
						<input readonly value="<?php echo $data->no_rm ?>" type="hidden" minlength="12" name="no_rm_lama" maxlength="12" class="form-control form-control-sm" id="no_rm_lama" required>
					</div>
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Nama</label>
						<input value="<?php echo $data->nama ?>" type="text" name="nama" class="form-control form-control-sm" id="nama" placeholder="Masukkan Nama Pasien" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Nama KK</label>
						<input value="<?php echo $data->nama_kk ?>" type="text" name="nama_kk" class="form-control form-control-sm" id="nama_kk" placeholder="Masukkan Nama KK" required>
					</div>
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Tanggal Lahir</label>
						<input value="<?php echo $data->tgl_lahir ?>" type="date" name="tgl_lahir" class="form-control form-control-sm" id="tgl_lahir" placeholder="Tanggal Lahir" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Alamat</label>
						<textarea class="form-control form-control-sm" name="alamat" placeholder="Masukan alamat" id="alamat" rows="2" required><?php echo $data->alamat ?></textarea>
					</div>
				</div>
				<button type="submit" class="btn btn-sm btn-success">Update</button>
				<button type="button" onclick="window.history.back()" class="btn btn-sm btn-link">Kembali</button>
				<?php echo form_close(); ?>

			</div>
		</div>

	</div>
<?php endforeach; ?>