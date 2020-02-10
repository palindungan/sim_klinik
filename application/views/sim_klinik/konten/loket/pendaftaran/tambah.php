<?php if ($this->session->flashdata('pendaftaran')) : ?>
	<div class="pesan-pendaftaran" data-flashdata="<?= $this->session->flashdata('pendaftaran'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Pendaftaran Pasien</h6>
		</div>
		<div class="card-body">

			<?php echo form_open('loket/pendaftaran/store'); ?>

			<button type="button" id="btn_search" class="btn btn-primary btn-sm mb-1" data-toggle="modal" data-target="#exampleModalCenter"><i class="fas fa-search-plus"></i> Cari Pasien</button>

			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail2">No RM</label>
					<input type="text" name="no_rm" maxlength="12" class="form-control form-control-sm" id="no_rm" placeholder="Masukan NO RM" value="<?php echo $no_rm ?>" required>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail2">Nama</label>
					<input type="text" name="nama" class="form-control form-control-sm" id="nama" placeholder="Masukkan Nama Pasien" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail2">Nama KK</label>
					<input type="text" name="nama_kk" class="form-control form-control-sm" id="nama_kk" placeholder="Masukkan Nama KK" required>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail2">Tanggal Lahir</label>
					<input type="date" name="tgl_lahir" class="form-control form-control-sm" id="tgl_lahir" placeholder="Tanggal Lahir" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail2">Alamat</label>
					<textarea class="form-control form-control-sm" name="alamat" placeholder="Masukan alamat" id="alamat" rows="2" required></textarea>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-sm-5">
					<label for="inputEmail3">Layanan Tujuan</label>
					<select name="layanan_tujuan" class="form-control form-control-sm" id="layanan_tujuan" onchange="control_waktu_pendaftaran_bp()" required>
						<option value="">---Pilih Layanan Tujuan--</option>
						<option value="Balai Pengobatan">Balai
							Pengobatan
						</option>
						<option value="Poli KIA">Poli KIA</option>
						<option value="Laboratorium">Laboratorium
						</option>
						<option value="UGD">UGD</option>
					</select>
				</div>
				<div class="form-group col-sm-5">
					<label for="inputEmail4">Tipe Antrian</label>
					<select name="tipe_antrian" class="form-control form-control-sm" id="tipe_antrian" required>
						<option value="Dewasa">Dewasa</option>
						<option value="Anak-Anak">Anak-Anak</option>
					</select>
				</div>
			</div>

			<div class="form-row" id="control_tipe_antrian">
				<div class="form-group col-sm-5">
					<label for="inputEmail4">Waktu Antrian</label>
					<select name="waktu_antrian" class="form-control form-control-sm" id="waktu_antrian" required>
						<option value="Pagi">Pagi</option>
						<option value="Sore">Sore</option>
					</select>
				</div>
			</div>

			<div class="form-row">
				<div class="form-group col-sm-5">
					<button type="submit" class="btn btn-sm btn-success">Simpan</button>
					<a href="" class="btn btn-sm btn-link">Kembali</a>
					<?php echo form_close(); ?>
				</div>
			</div>

		</div>

	</div>

	<!-- Modal -->
	<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-xl" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Daftar Pasien</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table_pasien table-bordered table_1" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th class="text-center">No RM</th>
									<th class="text-center">Nama</th>
									<th class="text-center">Umur</th>
									<th class="text-center">Alamat</th>
									<th class="text-center">Aksi</th>
								</tr>
							</thead>
							<tbody id="daftar_pasien">
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
	<script>
		$(document).ready(function() {
			$("#control_tipe_antrian").hide();
			search_proses();
		});

		function control_waktu_pendaftaran_bp() {
			if ($("#layanan_tujuan").val() == "Balai Pengobatan") {
				$("#control_tipe_antrian").show();
			} else {
				$("#control_tipe_antrian").hide();
			}
		}

		function search_proses() {

			var table;
			table = $('.table_pasien').DataTable({
				"processing": true,
				"serverSide": true,
				"ajax": "<?php echo base_url() . 'loket/pendaftaran/showDataPasienFastLoad'; ?>",
				"columnDefs": [{
					"targets": -1,
					"className": "text-center",
					render: function(data, type, row, meta) {
						return '<button class="btn btn-sm btn-warning btn-pilih btn-edit">Pilih</button>'
					}
				}]
			});

			$('.table_pasien tbody').on('click', '.btn-pilih', function() {
				var data = table.row($(this).parents('tr')).data();

				var kode = data[0];
				var nama = data[1];
				var alamat = data[2];
				var tgl_lahir = data[3];
				var nama_kk = data[4];

				// 	array('db' => 'no_rm', 'dt' => 0),
				// 	array('db' => 'nama',  'dt' => 1),
				// 	array('db' => 'alamat',  'dt' => 2),
				// 	array('db' => 'tgl_lahir',  'dt' => 3),
				// 	array('db' => 'nama_kk',  'dt' => 4),

				pilihPasien(kode, nama, alamat, tgl_lahir, nama_kk);
			});
		}

		function pilihPasien(kode, nama, alamat, tgl_lahir, nama_kk) {
			document.getElementById("no_rm").value = kode;
			$("#pilih_rm").val("yes");
			$("#no_rm").val(kode);
			$("#nama").val(nama);
			$("#alamat").val(alamat);
			$("#tgl_lahir").val(tgl_lahir);
			$("#nama_kk").val(nama_kk);
			$('#exampleModalCenter').modal('hide');
		}
	</script>