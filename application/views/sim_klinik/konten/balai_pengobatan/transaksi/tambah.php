<style>
	.select2-selection__rendered {
		line-height: 36px !important;
	}

	.select2-selection {
		height: 38px !important;
	}

</style>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Balai Pengobatan</h6>
		</div>
		<div class="card-body">
			<!-- Page Heading -->
			<!-- <h5 class="h3 mb-2 text-gray-800">No. Ref Pelayanan</h5> -->
			<?php echo form_open('loket/pendaftaran/store'); ?>
			<div class="form-row">
				<div class="form-group col-md-6">
					<label for="inputEmail3">No Ref Pelayanan</label>
					<select id="selectSearch" class="form-control" name="no_ref_pelayanan" required>
						<option value="">-- Pilih Data --</option>
						<?php foreach($record as $data): ?>
						<option value="<?= $data->no_ref_pelayanan ?>"><?= $data->no_ref_pelayanan." || ".$data->nama ?>
						</option>
						<?php endforeach; ?>
					</select>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-md-12">
					<label for="">Biodata Pasien</label>
					<table width="100%" class="responsive">
						<tr>
							<td width="6%">
								<h5>Nama</h5>
							</td>
							<td width="2%">
								<h5>:</h5>
							</td>
							<td width="24%">
								<h5>Mohamad Rizal Ramli</h5>
							</td>
							<td width="6%">
								<h5>Umur</h5>
							</td>
							<td width="2%">
								<h5>:</h5>
							</td>
							<td width="19%">
								<h5>21 Tahun</h5>
							</td>
							<td width="8%">
								<h5>Alamat</h5>
							</td>
							<td width="2%">
								<h5>:</h5>
							</td>
							<td width="22%">
								<h5>Kunir</h5>
							</td>
						</tr>
					</table>
				</div>
			</div>

			<div class="form-row">

			</div>
			<button type="submit" class="btn btn-primary">Simpan</button>
			<a href="" class="btn btn-link">Kembali</a>
			<?php echo form_close(); ?>
		</div>
	</div>

</div>
