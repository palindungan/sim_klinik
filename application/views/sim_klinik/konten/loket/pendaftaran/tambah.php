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
				<input type="text" name="no_rm" class="form-control" id="inputEmail1" placeholder="Masukan No. RM">
			</div>
			<div class="form-group col-md-6">
				<label for="inputEmail2">NIK</label>
				<input type="text" name="nik" class="form-control" id="inputEmail2" placeholder="Masukan NIK pasien">
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail3">Tempat Lahir</label>
				<input type="text" name="tempat_lahir" class="form-control" id="inputEmail3"
					placeholder="Masukan tanggal lahir">
			</div>
			<div class="form-group col-md-6">
				<label for="inputEmail4">Tanggal Lahir</label>
				<div class="row">
					<div class="col-md-3">
						<select name="hari" class="form-control" id="exampleFormControlSelect1">
							<?php
							for($i=1;$i<32;++$i)
							{
								if($i<10){ $i="0" .$i; }
							?>
							<option value="<?= $i ?>"><?= $i; ?></option>
							<?php 
							}
							?>

						</select>
					</div>
					<div class="col-md-6">
						<select name="bulan" class="form-control" id="exampleFormControlSelect1">
							<option value="01">Januari</option>
							<option value="02">Februari</option>
							<option value="03">Maret</option>
							<option value="04">April</option>
							<option value="05">Mei</option>
							<option value="06">Juni</option>
							<option value="07">Juli</option>
							<option value="08">Agustus</option>
							<option value="09">September</option>
							<option value="10">Oktober</option>
							<option value="11">November</option>
							<option value="12">Desember</option>
						</select>
					</div>
					<div class="col-md-3">
						<select name="tahun" class="form-control" id="exampleFormControlSelect1">
							<?php
							$tgl = date("Y");
							$tgl_fix = $tgl - 110;
							for($j=0;$j<110;++$j)
							{
							?>
							<option value="<?= $tgl_fix; ?>" <?php if($tgl_fix==1980){ echo 'selected'; } ?>>
								<?= $tgl_fix++ ?>
							</option>
							<?php 
							} 
							?>
						</select>
					</div>
				</div>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail3">Jenis Kelamin</label><br><br>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline1" name="jenis_kelamin" class="custom-control-input"
						checked>
					<label class="custom-control-label" for="customRadioInline1">Laki-Laki</label>
				</div>
				<div class="custom-control custom-radio custom-control-inline">
					<input type="radio" id="customRadioInline2" name="jenis_kelamin" class="custom-control-input">
					<label class="custom-control-label" for="customRadioInline2">Perempuan</label>
				</div>
			</div>
			<div class="form-group col-md-6">
				<label for="exampleFormControlTextarea1">Alamat</label>
				<textarea class="form-control" name="alamat" id="exampleFormControlTextarea1" rows="2"></textarea>
			</div>
		</div>
		<div class="form-row">
			<div class="form-group col-md-6">
				<label for="inputEmail3">Layanan Tujuan</label>
				<select name="layanan_tujuan" class="form-control" id="exampleFormControlSelect1">
					<option value="Balai Pengobatan">Balai Pengobatan</option>
					<option value="Poli KIA">Poli KIA</option>
					<option value="Laboratorium">Laboratorium</option>
				</select>
			</div>
			<div class="form-group col-md-6">
				<label for="inputEmail4">Tipe Antrian</label>
				<select name="tipe_antrian" class="form-control" id="exampleFormControlSelect1">
					<option value="Dewasa">Dewasa</option>
					<option value="Anak-Anak">Anak-Anak</option>
				</select>
			</div>
		</div>
		<button type="submit" class="btn btn-primary">Simpan</button>
		<a href="" class="btn btn-link">Kembali</a>
	</form>

</div>
