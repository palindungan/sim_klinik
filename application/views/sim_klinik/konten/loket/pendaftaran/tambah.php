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
					<input type="text" name="no_rm" id="no_rm" value="<?= set_value('no_rm') ?>" class="no_rmnya form-control form-control-sm <?php if (form_error('no_rm') == true) {
																																		echo "is-invalid";
																																	} ?>" id="no_rm" placeholder="No RM">
																																	<div class="invalid-feedback">
									<?= form_error('no_rm'); ?>
								</div>
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
					<label for="inputEmail2">NIK</label>
					<input type="text" name="nik" value="<?= set_value('nik') ?>" class="niknya form-control form-control-sm nik <?php if (form_error('nik') == true) {
																																		echo "is-invalid";
																																	} ?>" id="nik" placeholder="Masukan NIK pasien">
					<div class="invalid-feedback">
						<?= form_error('nik'); ?>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="inputEmail1">Nama</label>
					<input type="text" name="nama" value="<?= set_value('nama') ?>" class="form-control form-control-sm karakter <?php if (form_error('nama') == true) {
																																		echo "is-invalid";
																																	} ?>" id="nama" placeholder="Masukan Nama">
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
																																					} ?>" id="tempat_lahir" placeholder="Masukan tempat lahir">
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
																					} ?>" id="hari">
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
																						} ?>" id="bulan">
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
																						} ?>" id="tahun">
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
						<input type="radio" id="jenis_kelamin" name="jenis_kelamin" class="custom-control-input" value="Laki-Laki" checked>
						<label class="custom-control-label" for="jenis_kelamin">Laki-Laki</label>
					</div>
					<div class="custom-control custom-radio custom-control-inline">
						<input type="radio" id="jenis_kelamin2" name="jenis_kelamin" class="custom-control-input" value="Perempuan">
						<label class="custom-control-label" for="jenis_kelamin2">Perempuan</label>
					</div>
				</div>
				<div class="form-group col-sm-6">
					<label for="alamat">Alamat</label>
					<textarea class="form-control form-control-sm karakterAngka <?php if (form_error('alamat') == true) {
																					echo "is-invalid";
																				} ?>" name="alamat" id="alamat" rows="2"><?= set_value('alamat') ?></textarea>
					<div class="invalid-feedback">
						<?= form_error('alamat'); ?>
					</div>
				</div>
			</div>
			<div class="form-row">
				<div class="form-group col-sm-6">
					<label for="inputEmail3">Layanan Tujuan</label>
					<select name="layanan_tujuan" class="form-control form-control-sm" id="exampleFormControlSelect1" required>
						<option value="">---Pilih Layanan Tujuan--</option>
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
					<select name="tipe_antrian" class="form-control form-control-sm" id="exampleFormControlSelect1" required>
						<option value="">---Pilih Tipe Antrian--</option>
						<option value="Dewasa" <?= set_select('tipe_antrian', 'Dewasa'); ?>>Dewasa</option>
						<option value="Anak-Anak" <?= set_select('tipe_antrian', 'Anak-Anak'); ?>>Anak-Anak</option>
					</select>
				</div>
				<div class="form-group col-sm-12">
                                    <div class="row">
                                        <div class="col-sm-4">
                                            <label>Fasilitas Ambulance</label>
                                            <select class="form-control form-control-sm status_pakai" name="status_pakai_ambulan" required>
                                                <option value="">--Pilih Status--</option>
                                                <option value="Pakai">Pakai</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4" id="tujuan_ambulan">
                                            <label>Tujuan</label>
                                            <select class="form-control form-control-sm tujuan_ambulan" name="tujuan_ambulan">
                                                <option value="RS Ambulu">RS Ambulu</option>
                                                <option value="Kota Jember">Kota Jember</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4" id="harga_ambulan">
                                            <label>Harga</label>
                                            <input type="text" readonly name="harga_ambulan" id="harga_ambulans" class="form-control form-control-sm rupiah_ambulan text-right harga_ambulan" placeholder="Sub Total">
                                        </div>
                                    </div>
                                </div>
			</div>
			<button type="submit" class="btn btn-sm btn-success">Simpan</button>
			<a href="" class="btn btn-sm btn-link">Kembali</a>
			<?php echo form_close(); ?>

		</div>
	</div>

</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Pasien</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_1" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">No RM</th>
								<th class="text-center">Nama</th>
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
		auto_complete();

	});

	// codingan untuk autocomplete start
	function auto_complete() {

		$(function() {

			// untuk no_rm
			$(".no_rmnya").autocomplete({
				source: function(request, response) {
					// Fetch data
					$.ajax({
						url: "<?php echo base_url() . 'loket/pendaftaran/get_autocomplete_no_rm'; ?>",
						type: 'post',
						dataType: "json",
						data: {
							nilai: request.term
						},
						success: function(data) {
							response(data);
						}
					});
				},
				select: function(event, ui) {},
			});

			$(".no_rmnya").on("autocompleteselect", function(event, ui) {

				var id = ui.item.value

				// Fetch data
				$.ajax({
					url: "<?php echo base_url() . 'loket/pendaftaran/get_pasien_by_no_rm'; ?>",
					type: 'post',
					data: {
						nilai: id
					},
					success: function(hasil) {

						// parse
						var obj = JSON.parse(hasil);
						let data = obj['tbl_data'];

						if (data != '') {

							$.each(data, function(i, item) {

								var nik = data[i].nik;
								var nama = data[i].nama;
								var tempat_lahir = data[i].tempat_lahir;
								var alamat = data[i].alamat;

								$("#nik").val(nik);
								$("#nama").val(nama);
								$("#tempat_lahir").val(tempat_lahir);
								$("#alamat").val(alamat);

								var tgl_lahir = data[i].tgl_lahir;

								// parse
								var hari = tgl_lahir.substring(8);
								var bulan = tgl_lahir.substring(5, 7);
								var tahun = tgl_lahir.substring(0, 4);

								$("#hari").val(hari).change();
								$("#bulan").val(bulan).change();
								$("#tahun").val(tahun).change();

								var jenkel = data[i].jenkel;

								if (jenkel == "Laki-Laki") {
									$("#jenis_kelamin").prop("checked", true);
									$("#jenis_kelamin2").prop("checked", false);
								} else {
									$("#jenis_kelamin").prop("checked", false);
									$("#jenis_kelamin2").prop("checked", true);
								}

							});

							$("#pilih_rm").val("yes");
						} else {

							alert("Data Dengan Kode : " + id + " Tidak Ditemukan !");

						}
					}
				});
			});

			$(".no_rmnya").on("autocompletesearch", function(event, ui) {
				$("#pilih_rm").val("no");
				$("#nik").val("");
				//$("#no_rm").val("");
				$("#nama").val("");
				$("#tempat_lahir").val("");
				$("#alamat").val("");
				$("#hari").val("01").change();
				$("#bulan").val("01").change();
				$("#tahun").val("1980").change();
				$("#jenis_kelamin").prop("checked", true);
				$("#jenis_kelamin2").prop("checked", false);
			});

			// end of untuk no_rm

			// untuk NIK 
			$(".niknya").autocomplete({
				source: function(request, response) {
					// Fetch data
					$.ajax({
						url: "<?php echo base_url() . 'loket/pendaftaran/get_autocomplete_nik'; ?>",
						type: 'post',
						dataType: "json",
						data: {
							nilai: request.term
						},
						success: function(data) {
							response(data);
						}
					});
				},
				select: function(event, ui) {},
			});

			$(".niknya").on("autocompleteselect", function(event, ui) {

				var id = ui.item.value

				// Fetch data
				$.ajax({
					url: "<?php echo base_url() . 'loket/pendaftaran/get_pasien_by_nik'; ?>",
					type: 'post',
					data: {
						nilai: id
					},
					success: function(hasil) {

						// parse
						var obj = JSON.parse(hasil);
						let data = obj['tbl_data'];

						if (data != '') {

							$.each(data, function(i, item) {

								var no_rm = data[i].no_rm;
								var nama = data[i].nama;
								var tempat_lahir = data[i].tempat_lahir;
								var alamat = data[i].alamat;

								$("#no_rm").val(no_rm);
								$("#nama").val(nama);
								$("#tempat_lahir").val(tempat_lahir);
								$("#alamat").val(alamat);

								var tgl_lahir = data[i].tgl_lahir;

								// parse
								var hari = tgl_lahir.substring(8);
								var bulan = tgl_lahir.substring(5, 7);
								var tahun = tgl_lahir.substring(0, 4);

								$("#hari").val(hari).change();
								$("#bulan").val(bulan).change();
								$("#tahun").val(tahun).change();

								var jenkel = data[i].jenkel;

								if (jenkel == "Laki-Laki") {
									$("#jenis_kelamin").prop("checked", true);
									$("#jenis_kelamin2").prop("checked", false);
								} else {
									$("#jenis_kelamin").prop("checked", false);
									$("#jenis_kelamin2").prop("checked", true);
								}

							});

							$("#pilih_rm").val("yes");
						} else {

							alert("Data Dengan Kode : " + id + " Tidak Ditemukan !");

						}
					}
				});
			});

			$(".niknya").on("autocompletesearch", function(event, ui) {
				// $("#nik").val("");
				// $("#no_rm").val("");

				if ($("#pilih_rm").val() == "yes") {

					$("#no_rm").val("");
					$("#pilih_rm").val("no");

				}

				$("#nama").val("");
				$("#tempat_lahir").val("");
				$("#alamat").val("");
				$("#hari").val("01").change();
				$("#bulan").val("01").change();
				$("#tahun").val("1980").change();
				$("#jenis_kelamin").prop("checked", true);
				$("#jenis_kelamin2").prop("checked", false);

			});
			// end of untuk NIK

		});

	}
	// codingan untuk autocomplete end
</script>
<script>
// jika kita tekan / click button search-button
$('#btn_search').on('click', function() {
		search_proses();
	});

	function search_proses() {

	var table;
	table = $('.table_1').DataTable({
			"columnDefs": [{
				"targets": [0,4],
				"className" : "text-center"
			}
		],
			"bDestroy": true
		});

	table.clear();

	$.ajax({
		url: "<?php echo base_url() . 'loket/pendaftaran/tampil_daftar_pasien'; ?>",
		success: function(hasil) {

			var obj = JSON.parse(hasil);
			let data = obj['tbl_data'];

			if (data != '') {

				var no = 1;

				$.each(data, function(i, item) {

					var kode = data[i].no_rm;
					var nama = data[i].nama;
					var nik = data[i].nik;
					var tempat_lahir = data[i].tempat_lahir;
					var tgl_lahir = data[i].tgl_lahir;
					var jenkel = data[i].jenkel;
					var alamat = data[i].alamat;
					var button = `<a onclick="pilihTindakan('` + kode +
						`','` + nik +`','` + nama +`','` + tempat_lahir +`','` + tgl_lahir +`','` + jenkel +`','` + alamat +`')" id="` + kode +
						`" class="btn btn-sm btn-dark text-white">Pilih</a>`;

					table.row.add([no,kode, nama, alamat, button]);

					no = no + 1;
				});
			} else {

				$('.table_1').html('<h3>No data are available</h3>');

			}
			table.draw();

		}
	});
	}
	function pilihTindakan(kode,nik,nama,tempat_lahir,tgl_lahir,jenkel,alamat) {

	document.getElementById("no_rm").value= kode;
	$("#pilih_rm").val("yes");
	$("#no_rm").val(kode);
	$("#nik").val(nik);
	$("#nama").val(nama);
	$("#tempat_lahir").val(tempat_lahir);
	$("#alamat").val(alamat);


	// parse
	var hari = tgl_lahir.substring(8);
	var bulan = tgl_lahir.substring(5, 7);
	var tahun = tgl_lahir.substring(0, 4);

	$("#hari").val(hari).change();
	$("#bulan").val(bulan).change();
	$("#tahun").val(tahun).change();

	if (jenkel == "Laki-Laki") {
		$("#jenis_kelamin").prop("checked", true);
		$("#jenis_kelamin2").prop("checked", false);
	} else {
		$("#jenis_kelamin").prop("checked", false);
		$("#jenis_kelamin2").prop("checked", true);
	}
	$('#exampleModalCenter').modal('hide');
	}
</script>

<script>
	function validasi() {
        $('.rupiah_ambulan').mask('000.000.000', {
            reverse: true
        });
    }
    $("#tujuan_ambulan").hide();
    $("#harga_ambulan").hide();
    $('.status_pakai').on('change', function() {
        if(this.value == "")
        {
            $("#tujuan_ambulan").hide();
            $("#harga_ambulan").hide();
        }
        else if(this.value == "Pakai")
        {
            $("#tujuan_ambulan").show();
            $("#harga_ambulan").show();
            var id = $('.tujuan_ambulan').find(":selected").text();
            $.ajax({
            url: "<?php echo base_url() . 'loket/pendaftaran/ambil_harga_ambulan'; ?>",
            method: "POST",
            data: {id: id},
            success: function(data) {
                $('#harga_ambulans').val(data);
                $('.rupiah_ambulan').trigger('input'); // Will be display 
            }
            });
            validasi();
        }
        else if(this.value == "Tidak")
        {
            $("#tujuan_ambulan").hide();
            $("#harga_ambulan").hide();
        }
    });
    $('.tujuan_ambulan').change(function(){
            var id = this.value;
            $.ajax({
            url: "<?php echo base_url() . 'loket/pendaftaran/ambil_harga_ambulan'; ?>",
            method: "POST",
            data: {id: id},
            success: function(data) {
                $('#harga_ambulans').val(data);
                $('.rupiah_ambulan').trigger('input'); // Will be display 
            }
            });
            validasi();
        });
</script>