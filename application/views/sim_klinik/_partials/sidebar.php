<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon">
			<i class="fas fa-hospital"></i>
		</div>
		<div class="sidebar-brand-text mx-3"><?php echo $this->session->userdata('akses'); ?><sup></sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Data Master -->
	<div class="sidebar-heading">
		Data Master
	</div>
	<?php
	if ($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Loket' || $this->session->userdata('akses') == 'Admin' || $this->session->userdata('akses') == 'Apotek' || $this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == 'Administrasi') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('admin/pasien'); ?>">
				<i class="fas fa-user-injured <?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "pasien") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "pasien") {
									echo "text-white";
								} ?>">Pasien</span></a>
		</li>
	<?php
	}
	if ($this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == 'Admin') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('admin/kamar'); ?>">
				<i class="fas fa-bed <?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "kamar") {
											echo "text-white";
										} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "kamar") {
									echo "text-white";
								} ?>">Kamar</span></a>
		</li>

		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('admin/lain'); ?>">
				<i class="fas fa-align-center <?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "lain") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "lain") {
									echo "text-white";
								} ?>">Lain - Lain</span></a>
		</li>
	<?php
	}
	if ($this->session->userdata('akses') == 'Admin' || $this->session->userdata('akses') == 'Apotek') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('admin/supplier'); ?>">
				<i class="fas fa-truck <?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "supplier") {
											echo "text-white";
										} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "supplier") {
									echo "text-white";
								} ?>">Supplier</span></a>
		</li>
	<?php
	}
	if ($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Admin') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('admin/user'); ?>">
				<i class="fas fa-users <?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "user") {
											echo "text-white";
										} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "admin" && $this->uri->segment(2) == "user") {
									echo "text-white";
								} ?>">User</span></a>
		</li>
	<?php } ?>

	<!-- Loket -->
	<?php
	if ($this->session->userdata('akses') == 'Loket') {
	?>
		<div class="sidebar-heading">
			Loket
		</div>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('loket/pendaftaran'); ?>">
				<i class="fas fa-edit <?php if ($this->uri->segment(1) == "loket" && $this->uri->segment(2) == "pendaftaran") {
											echo "text-white";
										} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "loket" && $this->uri->segment(2) == "pendaftaran") {
									echo "text-white";
								} ?>">Pendaftaran</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('loket/antrian'); ?>">
				<i class="fas fa-user-clock <?php if ($this->uri->segment(1) == "loket" && $this->uri->segment(2) == "antrian") {
												echo "text-white";
											} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "loket" && $this->uri->segment(2) == "antrian") {
									echo "text-white";
								} ?>">Antrian</span></a>
		</li>
	<?php } ?>

	<!-- Master Tindakan -->
	<?php
	if ($this->session->userdata('akses') == 'Admin' || $this->session->userdata('akses') == 'Rawat Inap') {
	?>
		<div class="sidebar-heading">
			Master Tindakan
		</div>
	<?php
	}
	if ($this->session->userdata('akses') == 'Admin') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('kia/tindakan'); ?>">
				<i class="fas fa-stethoscope <?php if ($this->uri->segment(1) == "kia" && $this->uri->segment(2) == "tindakan") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "kia" && $this->uri->segment(2) == "tindakan") {
									echo "text-white";
								} ?>">Tindakan KIA</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('ugd/tindakan'); ?>">
				<i class="fas fa-stethoscope <?php if ($this->uri->segment(1) == "ugd" && $this->uri->segment(2) == "tindakan") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "ugd" && $this->uri->segment(2) == "tindakan") {
									echo "text-white";
								} ?>">Tindakan UGD</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('balai_pengobatan/tindakan'); ?>">
				<i class="fas fa-stethoscope <?php if ($this->uri->segment(1) == "balai_pengobatan" && $this->uri->segment(2) == "tindakan") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "balai_pengobatan" && $this->uri->segment(2) == "tindakan") {
									echo "text-white";
								} ?>">Tindakan BP</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('laboratorium/checkup'); ?>">
				<i class="fas fa-stethoscope <?php if ($this->uri->segment(1) == "laboratorium" && $this->uri->segment(2) == "checkup") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "laboratorium" && $this->uri->segment(2) == "checkup") {
									echo "text-white";
								} ?>">Tindakan Laboratorium</span></a>
		</li>
	<?php
	}
	if ($this->session->userdata('akses') == 'Admin' || $this->session->userdata('akses') == 'Rawat Inap') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('rawat_inap/tindakan'); ?>">
				<i class="fas fa-stethoscope <?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "tindakan") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "tindakan") {
									echo "text-white";
								} ?>">Tindakan Rawat Inap</span></a>
		</li>
	<?php
	}
	if ($this->session->userdata('akses') == 'Rawat Inap') {
	?>

		<!-- Transaksi Rawat Inap -->
		<div class="sidebar-heading">
			Transaksi Rawat Inap
		</div>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('rawat_inap/transaksi'); ?>">
				<i class="fas fa-user-edit <?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "transaksi") {
												echo "text-white";
											} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "transaksi") {
									echo "text-white";
								} ?>">Transaksi</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('rawat_inap/akomodasi'); ?>">
				<i class="fas fa-vote-yea <?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "akomodasi") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "akomodasi") {
									echo "text-white";
								} ?>">Akomodasi Rawat Inap</span></a>
								<li class="nav-item">
			<a class="nav-link" href="<?= base_url('rawat_inap/history_akomodasi'); ?>">
				<i class="fas fa-address-card <?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "history_akomodasi") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "history_akomodasi") {
									echo "text-white";
								} ?>">History Akomodasi</span></a>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('rawat_inap/setorUang'); ?>">
				<i class="fas fa-address-card <?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "setorUang") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "rawat_inap" && $this->uri->segment(2) == "setorUang") {
									echo "text-white";
								} ?>">Setor Uang Rawat Inap</span></a>
		</li>
	<?php } ?>
	<!-- Apotek -->
	<?php
	if ($this->session->userdata('akses') == 'Apotek') {
	?>
		<div class="sidebar-heading">
			Apotek
		</div>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('apotek/penjualan_obat'); ?>">
				<i class="fas fa-comment-dollar <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penjualan_obat" && $this->uri->segment(3) == FALSE) {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penjualan_obat" && $this->uri->segment(3) == FALSE) {
									echo "text-white";
								} ?>">Penjualan</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('apotek/penerimaan'); ?>">
				<i class="fas fa-vote-yea <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penerimaan" && $this->uri->segment(3) == FALSE) {
												echo "text-white";
											} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penerimaan" && $this->uri->segment(3) == FALSE) {
									echo "text-white";
								} ?>">Penerimaan</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('apotek/pengiriman_obat'); ?>">
				<i class="fas fa-dolly-flatbed <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "pengiriman_obat" && $this->uri->segment(3) == FALSE) {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "pengiriman_obat" && $this->uri->segment(3) == FALSE) {
									echo "text-white";
								} ?>">Transfer
					Internal</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('apotek/return_obat'); ?>">
				<i class="fas fa-dolly-flatbed <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "return_obat" && $this->uri->segment(3) == FALSE) {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "return_obat" && $this->uri->segment(3) == FALSE) {
									echo "text-white";
								} ?>">Return Obat</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
				<i class="fas fa-fw fa-cog <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "obat") {
												echo "text-white";
											} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "kategori_obat") {
												echo "text-white";
											} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "obat") {
									echo "text-white";
								} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "kategori_obat") {
									echo "text-white";
								} ?>">Data
					Master Apotek</span>
			</a>
			<div id="collapseTwo" class="collapse <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "obat") {
														echo "show";
													} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "kategori_obat") {
														echo "show";
													} ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item " href="<?= base_url('apotek/obat'); ?>">Obat/Alkes</a>
					<a class="collapse-item" href="<?= base_url('apotek/kategori_obat'); ?>">Kategori Obat/Alkes</a>
				</div>
			</div>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true" aria-controls="collapseTwo">
				<i class="fas fa-history <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penjualan_obat" && $this->uri->segment(3) == "tampil_daftar_penjualan_obat") {
												echo "text-white";
											} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penerimaan" && $this->uri->segment(3) == "tampil_daftar_penerimaan_obat") {
												echo "text-white";
											} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "pengiriman_obat" && $this->uri->segment(3) == "tampil_daftar_pengiriman_obat") {
												echo "text-white";
											} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penjualan_obat" && $this->uri->segment(3) == "tampil_daftar_penjualan_obat") {
									echo "text-white";
								} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penerimaan" && $this->uri->segment(3) == "tampil_daftar_penerimaan_obat") {
									echo "text-white";
								} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "pengiriman_obat" && $this->uri->segment(3) == "tampil_daftar_pengiriman_obat") {
									echo "text-white";
								} ?>">History
					Transaksi</span>
			</a>
			<div id="collapseTwo2" class="collapse <?php if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penjualan_obat" && $this->uri->segment(3) == "tampil_daftar_penjualan_obat") {
														echo "show";
													} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "penerimaan" && $this->uri->segment(3) == "tampil_daftar_penerimaan_obat") {
														echo "show";
													} else if ($this->uri->segment(1) == "apotek" && $this->uri->segment(2) == "pengiriman_obat" && $this->uri->segment(3) == "tampil_daftar_pengiriman_obat") {
														echo "show";
													} ?>" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
				<div class="bg-white py-2 collapse-inner rounded">
					<a class="collapse-item " href="<?= base_url('apotek/penjualan_obat/tampil_daftar_penjualan_obat'); ?>">Penjualan</a>
					<a class="collapse-item" href="<?= base_url('apotek/penerimaan/tampil_daftar_penerimaan_obat'); ?>">Penerimaan</a>
					<a class="collapse-item" href="<?= base_url('apotek/pengiriman_obat/tampil_daftar_pengiriman_obat'); ?>">Transfer Internal</a>
					<a class="collapse-item" href="<?= base_url('apotek/return_obat/tampil_daftar_return_obat'); ?>">Return Obat</a>
					<a class="collapse-item" href="<?= base_url('apotek/penjualan_obat/daftar_obat_terjual'); ?>">Laporan Obat Terjual</a>
				</div>
			</div>
		</li>
	<?php
	}
	?>

	<!-- Administrasi-->
	<?php
	if ($this->session->userdata('akses') == 'Administrasi') {
	?>
		<div class="sidebar-heading">
			Administrasi
		</div>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('administrasi/tagihan'); ?>">
				<i class="fas fa-address-card <?php if ($this->uri->segment(1) == "administrasi" && $this->uri->segment(2) == "tagihan") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "administrasi" && $this->uri->segment(2) == "tagihan") {
									echo "text-white";
								} ?>">Tagihan</span></a>
		</li>
	<?php } ?>

	<!-- Laporan -->
	<?php
	if ($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Administrasi' || $this->session->userdata('akses') == 'Rawat Inap') {
	?>
		<div class="sidebar-heading">
			Laporan
		</div>
	<?php } ?>

	<?php
	if ($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Administrasi' || $this->session->userdata('akses') == 'Rawat Inap' || $this->session->userdata('akses') == 'Loket') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('laporan/rekapTagihan'); ?>">
				<i class="fas fa-address-card <?php if ($this->uri->segment(1) == "laporan" && $this->uri->segment(2) == "rekapTagihan") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "laporan" && $this->uri->segment(2) == "rekapTagihan") {
									echo "text-white";
								} ?>">Rekap Tagihan</span></a>
		</li>
	<?php
	}
	if ($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Administrasi' || $this->session->userdata('akses') == 'Rawat Inap') {
	?>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('laporan/rawatJalan'); ?>">
				<i class="fas fa-address-card <?php if ($this->uri->segment(1) == "laporan" && $this->uri->segment(2) == "rawatJalan") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "laporan" && $this->uri->segment(2) == "rawatJalan") {
									echo "text-white";
								} ?>">Rawat Jalan</span></a>
		</li>
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('laporan/rawatInap'); ?>">
				<i class="fas fa-address-card <?php if ($this->uri->segment(1) == "laporan" && $this->uri->segment(2) == "rawatInap") {
													echo "text-white";
												} ?>"></i>
				<span class="<?php if ($this->uri->segment(1) == "laporan" && $this->uri->segment(2) == "rawatInap") {
									echo "text-white";
								} ?>">Rawat Inap</span></a>
		</li>
	<?php
	}
	if ($this->session->userdata('akses') == 'Manager' || $this->session->userdata('akses') == 'Rawat Inap') {
	?>
	<?php } ?>


	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>