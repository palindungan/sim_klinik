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
					<input type="text" maxlength="12" name="no_rm" id="no_rm" class="no_rmnya form-control form-control-sm" value="<?php echo $no_rm ?>" id="no_rm" placeholder="No RM" required>
				</div>
				<div class="form-group col-sm-2">
					<input type="hidden" id="pilih_rm" class="form-control form-control-sm" value="no"></input>
				</div>
				<div class="form-group col-sm-2">
					<label for="inputEmail2">&nbsp</label>
					<a style="display:block" href="#" id="btn_search" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
						<span class="icon text-white-50">
							<i class="fas fa-search-plus"></i>
						</span>
						<span class="text">Pencarian Pasien</span>
					</a>
				</div>



			</div>
			<!-- <h5 class="h3 mb-2 text-gray-800">Biodata Pasien</h5> -->
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail1">Nama</label>
					<input type="text" class="form-control form-control-sm" name="nama" id="nama" placeholder="Masukan Nama" required>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail1">Umur</label>
					<input type="text" class="form-control form-control-sm" name="umur" id="umur" placeholder="Masukan umur" required>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="alamat">Alamat</label>
					<textarea class="form-control form-control-sm" name="alamat" id="alamat" required></textarea>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail3">Layanan Tujuan</label>
					<select name="layanan_tujuan" class="form-control form-control-sm" id="exampleFormControlSelect1" required>
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
				<div class="form-group col-sm-6">
					<label for="inputEmail4">Tipe Antrian</label>
					<select name="tipe_antrian" class="form-control form-control-sm" id="exampleFormControlSelect1" required>
						<option value="">---Pilih Tipe Antrian--</option>
						<option value="Dewasa">Dewasa</option>
						<option value="Anak-Anak">Anak-Anak</option>
					</select>
				</div>
				<button type="submit" class="btn btn-sm btn-success">Simpan</button>
				<a href="" class="btn btn-sm btn-link">Kembali</a>
				<?php echo form_close(); ?>

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
			//DOM manipulation code
			search_proses();

		});

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
						// return '<a type="button" class="btn btn-danger btn-block" href="http://google.com"  >删除</a>';
						return '<button class="btn btn-sm btn-warning btn-pilih btn-edit">Pilih</button>'
					}
				}]
			});

			$('.table_pasien tbody').on('click', '.btn-pilih', function() {
				var data = table.row($(this).parents('tr')).data();

				var kode = data[0];
				var nama = data[1];
				var umur = data[2];
				var alamat = data[3];

				pilihPasien(kode, nama, alamat, umur);
			});
		}

		function pilihPasien(kode, nama, alamat, umur) {
			document.getElementById("no_rm").value = kode;
			$("#pilih_rm").val("yes");
			$("#no_rm").val(kode);
			$("#nama").val(nama);
			$("#alamat").val(alamat);
			$("#umur").val(umur);
			$('#exampleModalCenter').modal('hide');
		}
	</script>