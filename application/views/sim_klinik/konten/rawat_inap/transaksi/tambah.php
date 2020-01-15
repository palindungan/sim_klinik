<?php if ($this->session->flashdata('success')) : ?>
<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Rawat Inap</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">
				<div class="form-row">
					<div class="form-group col-sm-5">
						<label>Cari No Ref</label>
						<select class="form-control form-control-sm itemName" name="no_ref_pelayanan" required>
						</select>
					</div>
				</div>
				<div id="list_detail">

				</div>


				<!-- Start of Kamar /////////// -->
				<div class="form-row">
					<label>Kamar Rawat Inap</label>
					<div class="form-group col-sm-12">
						<a href="#" id="btn_search_kamar" class="btn btn-sm btn-primary btn-icon-split"
							data-toggle="modal" data-target="#exampleModalCenter_kamar">
							<span class="icon text-white-50">
								<i class="fas fa-search-plus"></i>
							</span>
							<span class="text">Cari Kamar</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<label class=" col-sm-4"><b>Nama Kamar</b></label>
					<label class=" col-sm-2"><b>Tipe</b></label>
					<label class=" col-sm-4"><b>Harga Harian</b></label>
				</div>

				<!-- start untuk keranjang Kamar -->
				<div id="detail_list_kamar">
					<!-- disini isi detail -->
					<h6 id="label_kosong_kamar">Detail Kamar Masih Kosong Lakukan pilih Pencarian Kamar !</h6>

				</div>
				<!-- end of untuk keranjang Kamar -->

				<div class="form-row">
					<div class="form-group col-sm-5"> </div>
					<div class="form-group col-sm-5">
						<input type="text" readonly name="sub_total_harga_kamar"
							class="form-control form-control-sm rupiah_kamar text-right" id="sub_total_harga_kamar"
							placeholder="Sub Total">
					</div>

				</div>
				<!-- End of Kamar ////////// -->

				<!-- Start of tindakan /////////// -->
				<div class="form-row">
					<label>Tindakan Rawat Inap</label>
					<div class="form-group col-sm-12">
						<a href="#" id="btn_search_tindakan" class="btn btn-sm btn-primary btn-icon-split"
							data-toggle="modal" data-target="#exampleModalCenter_tindakan">
							<span class="icon text-white-50">
								<i class="fas fa-search-plus"></i>
							</span>
							<span class="text">Cari tindakan</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<label class=" col-sm-5"><b>Nama tindakan</b></label>
					<label class=" col-sm-4"><b>Harga</b></label>
				</div>

				<!-- start untuk keranjang tindakan -->
				<div id="detail_list_tindakan">
					<!-- disini isi detail -->
					<h6 id="label_kosong_tindakan">Detail tindakan Masih Kosong Lakukan pilih Pencarian tindakan !</h6>

				</div>
				<!-- end of untuk keranjang tindakan -->

				<div class="form-row">
					<div class="form-group col-sm-5"> </div>
					<div class="form-group col-sm-5">
						<input type="text" readonly name="sub_total_harga_tindakan"
							class="form-control form-control-sm rupiah_tindakan text-right"
							id="sub_total_harga_tindakan" placeholder="Sub Total">
					</div>

				</div>
				<!-- End of tindakan ////////// -->

				<!-- Start of obat /////////// -->
				<div class="form-row">
					<label>Obat Rawat Inap</label>
					<div class="form-group col-sm-12">
						<a href="#" id="btn_search_obat" class="btn btn-sm btn-primary btn-icon-split"
							data-toggle="modal" data-target="#exampleModalCenter_obat">
							<span class="icon text-white-50">
								<i class="fas fa-search-plus"></i>
							</span>
							<span class="text">Cari obat</span>
						</a>
					</div>

				</div>

				<div class="form-row">
					<label class=" col-sm-5"><b>Nama Obat</b></label>
					<label class=" col-sm-4"><b>Harga Jual</b></label>
					<label class=" col-sm-1"><b>QTY</b></label>
				</div>

				<!-- start untuk keranjang obat -->
				<div id="detail_list_obat">
					<!-- disini isi detail -->
					<h6 id="label_kosong_obat">Detail obat Masih Kosong Lakukan pilih Pencarian obat !</h6>

				</div>
				<!-- end of untuk keranjang obat -->

				<div class="form-row">
					<div class="form-group col-sm-5"> </div>
					<div class="form-group col-sm-5">
						<input type="text" readonly name="sub_total_harga_obat"
							class="form-control form-control-sm rupiah_obat text-right" id="sub_total_harga_obat"
							placeholder="Sub Total">
					</div>

				</div>
				<!-- End of obat ////////// -->

				<div class="form-row">
					<div class="form-group col-sm-5">
						<input type="text" readonly name="total_harga"
							class="rupiah_grant_total form-control form-control-sm rupiah_kamar text-right"
							id="total_harga" placeholder="Total" required>
					</div>

					<div class="form-group col-sm-2">
						<button id="action" type="submit" class="btn btn-sm btn-success btn-icon-split"
							onclick="return confirm('Lakukan Simpan Data ?')">
							<span class="icon text-white-50">
								<i class="fas fa-save"></i>
							</span>
							<span class="text">Simpan Data</span>
						</button>
					</div>

				</div>

			</form>
		</div>
	</div>

</div>





<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/tindakan_ri.php') ?>
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/kamar_ri.php') ?>
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/obat_ri.php') ?>
<?php $this->view('sim_klinik/konten/rawat_inap/transaksi/load_php/submit_ri.php') ?>
