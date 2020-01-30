<?php 
foreach($row as $data) :
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
					<input type="text" name="no_rm" class="form-control form-control-sm" id="inputEmail2"
						value="<?php echo $data->no_rm ?>" placeholder="Masukan NO RM" readonly required>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail2">Nama</label>
					<input type="text" name="nama" class="form-control form-control-sm" id="inputEmail2"
						placeholder="Masukkan Nama" value="<?php echo $data->nama ?>" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail2">Alamat</label>
					<textarea class="form-control form-control-sm" name="alamat" placeholder="Masukan alamat"
						id="exampleFormControlTextarea1" rows="2" required><?php echo $data->alamat ?></textarea>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail2">Umur</label>
					<input type="text" name="umur" class="form-control form-control-sm" id="inputEmail2"
						placeholder="Masukkan Nama" value="<?php echo $data->umur ?>" required>
				</div>
			</div>
			<button type="submit" class="btn btn-sm btn-success">Update</button>
			<button type="button" onclick="window.history.back()" class="btn btn-sm btn-link">Kembali</button>
			<?php echo form_close(); ?>

		</div>
	</div>

</div>
<?php endforeach; ?>
