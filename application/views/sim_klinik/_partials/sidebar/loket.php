<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Loket<sup></sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Sistem Informasi Klinik
	</div>

	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('loket/pendaftaran'); ?>">
			<i class="fas fa-edit <?php if($this->uri->segment(1)=="loket" && $this->uri->segment(2)=="pendaftaran"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="loket" && $this->uri->segment(2)=="pendaftaran"){echo "text-white";}?>">Pendaftaran</span></a>
	</li>

	<!-- Nav Item - Tables -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('loket/antrian'); ?>">
			<i class="fas fa-user-clock <?php if($this->uri->segment(1)=="loket" && $this->uri->segment(2)=="antrian"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="loket" && $this->uri->segment(2)=="antrian"){echo "text-white";}?>">Antrian</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
