<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Laboratorium<sup></sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Sistem Informasi Klinik
	</div>

	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('laboratorium/transaksi'); ?>">
			<i class="fas fa-user-edit <?php if($this->uri->segment(1)=="laboratorium" && $this->uri->segment(2)=="transaksi"){echo "text-white";} ?>"></i>
			<span class="<?php if($this->uri->segment(1)=="laboratorium" && $this->uri->segment(2)=="transaksi"){echo "text-white";} ?>">Transaksi</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
