<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Admin<sup></sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Sistem Informasi Klinik
	</div>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/transaksi'); ?>">
			<i class="far fa-address-card"></i>
			<span>Transaksi</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/pasien'); ?>">
			<i class="far fa-address-card"></i>
			<span>Pasien</span></a>
	</li>

	<!-- Heading -->
	<div class="sidebar-heading">
		Tindakan
	</div>

	<!-- Nav Item - Tables -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('kia/tindakan'); ?>">
			<i class="fas fa-sort-amount-down-alt"></i>
			<span>Tindakan KIA</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('ugd/tindakan'); ?>">
			<i class="fas fa-sort-amount-down-alt"></i>
			<span>Tindakan UGD</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('balai_pengobatan/tindakan'); ?>">
			<i class="fas fa-sort-amount-down-alt"></i>
			<span>Tindakan BP</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('laboratorium/checkup'); ?>">
			<i class="fas fa-sort-amount-down-alt"></i>
			<span>Tindakan Laboratorium</span></a>
	</li>

	<div class="sidebar-heading">
		Data Master
	</div>
	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/kamar'); ?>">
			<i class="far fa-address-card"></i>
			<span>Kamar</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/supplier'); ?>">
			<i class="far fa-address-card"></i>
			<span>Supplier</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/user'); ?>">
			<i class="far fa-address-card"></i>
			<span>User</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>