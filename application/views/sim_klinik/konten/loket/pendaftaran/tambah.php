<div class="container-fluid">

	<!-- Page Heading -->
	<h5 class="h3 mb-2 text-gray-800">No. Ref Pelayanan</h5>
	<form>
		<div class="form-row">
			<div class="form-group col-md-4">
				<input type="email" class="form-control" id="inputEmail4" placeholder="No Ref Pelayanan">
			</div>
		</div>
	</form>
	<h5 class="h3 mb-2 text-gray-800">Biodata Pasien</h5>
	<form>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail1">No. RM</label>
				<input type="text" class="form-control" id="inputEmail1" placeholder="Masukan No. RM">
			</div>
			<div class="form-group col-md-6">
				<label for="inputEmail2">NIK</label>
				<input type="text" class="form-control" id="inputEmail2" placeholder="Masukan NIK pasien">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail3">Tempat Lahir</label>
				<input type="text" class="form-control" id="inputEmail3" placeholder="Masukan tanggal lahir">
			</div>
			<div class="form-group col-md-6">
				<label for="inputEmail4">Tanggal Lahir</label>
				<input type="text" class="form-control" id="inputEmail3" placeholder="Masukan tahun lahir">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail3">Jenis Kelamin</label><br><br>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline1" name="customRadioInline1" class="custom-control-input"
						checked>
					<label class="custom-control-label" for="customRadioInline1">Laki-Laki</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline2" name="customRadioInline1" class="custom-control-input">
					<label class="custom-control-label" for="customRadioInline2">Perempuan</label>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="exampleFormControlTextarea1">Alamat</label>
				<textarea class="form-control" id="exampleFormControlTextarea1" rows="2"></textarea>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail3">Layanan Tujuan</label>
				<select class="form-control" id="exampleFormControlSelect1">
					<option>Balai Pengobatan</option>
					<option>Poli KIA</option>
					<option>Laboratorium</option>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="inputEmail4">Tipe Antrian</label>
				<select class="form-control" id="exampleFormControlSelect1">
					<option>Dewasa</option>
					<option>Anak-Anak</option>
				</select>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
		<a href="" class="btn btn-link">Kembali</a>
	</form>

</div>
