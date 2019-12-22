<?php if ($this->session->flashdata('pendaftaran')) : ?>
<div class="pesan-pendaftaran" data-flashdata="<?= $this->session->flashdata('pendaftaran'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Pendaftaran Pasien</h6>
		</div>
		<div class="card-body">
			<!-- Page Heading -->
			<!-- <h5 class="h3 mb-2 text-gray-800">No. Ref Pelayanan</h5> -->
			<?php echo form_open('loket/pendaftaran/store'); ?>
			<div class="form-row">
				<div class="form-group col-sm-4">
					<label for="inputEmail2">No RM</label>
					<input type="text" name="no_rm" value="<?= set_value('no_rm') ?>" class="form-control form-control-sm <?php if (form_error('no_rm') == true) {
																												echo "is-invalid";
																											} ?>" id="inputEmail4" placeholder="No RM">
					<div class="invalid-feedback">
						<?= form_error('no_rm'); ?>
					</div>
				</div>
			</div>
			<!-- <h5 class="h3 mb-2 text-gray-800">Biodata Pasien</h5> -->
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail2">NIK</label>
					<input type="text" name="nik" value="<?= set_value('nik') ?>" class="form-control form-control-sm nik <?php if (form_error('nik') == true) {
																												echo "is-invalid";
																											} ?>" id="inputEmail2" placeholder="Masukan NIK pasien">
					<div class="invalid-feedback">
						<?= form_error('nik'); ?>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail1">Nama</label>
					<input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control form-control-sm karakter <?php if (form_error('nama') == true) {
																														echo "is-invalid";
																													} ?>" id="inputEmail1" placeholder="Masukan Nama">
					<div class="invalid-feedback">
						<?= form_error('nama'); ?>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail3">Tempat Lahir</label>
					<input type="text" name="tempat_lahir" value="<?= set_value('tempat_lahir') ?>" class=" form-control form-control-sm karakter <?php if (form_error('tempat_lahir') == true) {
																																		echo "is-invalid";
																																	} ?>" id="inputEmail3" placeholder="Masukan tempat lahir">
					<div class="invalid-feedback">
						<?= form_error('tempat_lahir'); ?>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail4">Tanggal Lahir</label>
					<div class="row">
						<div class="col-sm-3">
							<select name="hari" class="form-control form-control-sm <?php if (form_error('hari') == true) {
																		echo "is-invalid";
																	} ?>" id="exampleFormControlSelect1">
								<?php
								for ($i = 1; $i < 32; ++$i) {
									if ($i < 10) {
										$i = "0" . $i;
									}
									?>
								<option value="<?= $i ?>" <?= set_select('hari', $i); ?>><?= $i; ?></option>
								<?php
								}
								?>

							</select>
						</div>
						<div class="col-sm-6">
							<select name="bulan" class="form-control form-control-sm <?php if (form_error('hari') == true) {
																			echo "is-invalid";
																		} ?>" id="exampleFormControlSelect1">
								<option value="01" <?= set_select('bulan', '01'); ?>>Januari</option>
								<option value="02" <?= set_select('bulan', '02'); ?>>Februari</option>
								<option value="03" <?= set_select('bulan', '03'); ?>>Maret</option>
								<option value="04" <?= set_select('bulan', '04'); ?>>April</option>
								<option value="05" <?= set_select('bulan', '05'); ?>>Mei</option>
								<option value="06" <?= set_select('bulan', '06'); ?>>Juni</option>
								<option value="07" <?= set_select('bulan', '07'); ?>>Juli</option>
								<option value="08" <?= set_select('bulan', '08'); ?>>Agustus</option>
								<option value="09" <?= set_select('bulan', '09'); ?>>September</option>
								<option value="10" <?= set_select('bulan', '10'); ?>>Oktober</option>
								<option value="11" <?= set_select('bulan', '11'); ?>>November</option>
								<option value="12" <?= set_select('bulan', '12'); ?>>Desember</option>
							</select>
						</div>
						<div class="col-sm-3">
							<select name="tahun" class="form-control form-control-sm <?php if (form_error('hari') == true) {
																			echo "is-invalid";
																		} ?>" id="exampleFormControlSelect1">
								<?php
								$tgl = date("Y");
								$tgl_fix = $tgl - 110;
								for ($j = 0; $j <= 110; ++$j) {
									?>
								<option value="<?= $tgl_fix; ?>" <?php if ($tgl_fix == 1980) {
																				echo 'selected';
																			} ?> <?= set_select('tahun', $tgl_fix); ?>>
									<?= $tgl_fix++ ?>
								</option>
								<?php
								}
								?>
							</select>
						</div>
						<small style="margin-top:4px;margin-left:12px;color:#E74A3B">
							<?= form_error('hari'); ?>
						</small>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail3">Jenis Kelamin</label><br><br>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="customRadioInline1" name="jenis_kelamin" class="custom-control-input"
							value="Laki-Laki" checked>
						<label class="custom-control-label" for="customRadioInline1">Laki-Laki</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="customRadioInline2" name="jenis_kelamin" class="custom-control-input"
							value="Perempuan">
						<label class="custom-control-label" for="customRadioInline2">Perempuan</label>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="exampleFormControlTextarea1">Alamat</label>
					<textarea class="form-control form-control-sm karakterAngka <?php if (form_error('alamat') == true) {
																	echo "is-invalid";
																} ?>" name="alamat" id="exampleFormControlTextarea1" rows="2"><?= set_value('alamat') ?></textarea>
					<div class="invalid-feedback">
						<?= form_error('alamat'); ?>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail3">Layanan Tujuan</label>
					<select name="layanan_tujuan" class="form-control form-control-sm" id="exampleFormControlSelect1">
						<option value="Balai Pengobatan" <?= set_select('layanan_tujuan', 'Balai Pengobatan'); ?>>Balai
							Pengobatan
						</option>
						<option value="Poli KIA" <?= set_select('layanan_tujuan', 'Poli KIA'); ?>>Poli KIA</option>
						<option value="Laboratorium" <?= set_select('layanan_tujuan', 'Laboratorium'); ?>>Laboratorium
						</option>
						<option value="UGD" <?= set_select('layanan_tujuan', 'UGD'); ?>>UGD</option>
					</select>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail4">Tipe Antrian</label>
					<select name="tipe_antrian" class="form-control form-control-sm" id="exampleFormControlSelect1">
						<option value="Dewasa" <?= set_select('tipe_antrian', 'Dewasa'); ?>>Dewasa</option>
						<option value="Anak-Anak" <?= set_select('tipe_antrian', 'Anak-Anak'); ?>>Anak-Anak</option>
					</select>
				</div>
			</div>
			<button type="submit" class="btn btn-sm btn-success">Simpan</button>
			<a href="" class="btn btn-sm btn-link">Kembali</a>
			<?php echo form_close(); ?>

		</div>
	</div>

</div>
