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
	<!-- <li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/transaksi'); ?>">
			<i class="far fa-address-card"></i>
			<span>Transaksi</span></a>
	</li> -->
	<?php 
	$admin = "admin";
	?>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/pasien'); ?>">
			<i class="fas fa-user-injured <?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="pasien"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="pasien"){echo "text-white";}?>">Pasien</span></a>
	</li>

	<!-- Heading -->
	<div class="sidebar-heading">
		Tindakan
	</div>

	<!-- Nav Item - Tables -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('kia/tindakan'); ?>">
			<i class="fas fa-stethoscope <?php if($this->uri->segment(1)=="kia" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="kia" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>">Tindakan KIA</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('ugd/tindakan'); ?>">
			<i class="fas fa-stethoscope <?php if($this->uri->segment(1)=="ugd" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="ugd" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>">Tindakan UGD</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('balai_pengobatan/tindakan'); ?>">
			<i class="fas fa-stethoscope <?php if($this->uri->segment(1)=="balai_pengobatan" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="balai_pengobatan" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>">Tindakan BP</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('laboratorium/checkup'); ?>">
			<i class="fas fa-stethoscope <?php if($this->uri->segment(1)=="laboratorium" && $this->uri->segment(2)=="checkup"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="laboratorium" && $this->uri->segment(2)=="checkup"){echo "text-white";}?>">Tindakan Laboratorium</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('rawat_inap/tindakan'); ?>">
			<i class="fas fa-stethoscope <?php if($this->uri->segment(1)=="rawat_inap" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="rawat_inap" && $this->uri->segment(2)=="tindakan"){echo "text-white";}?>">Tindakan Rawat Inap</span></a>
	</li>

	<div class="sidebar-heading">
		Data Master
	</div>
	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/kamar'); ?>">
			<i class="fas fa-bed <?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="kamar"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="kamar"){echo "text-white";}?>">Kamar</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/supplier'); ?>">
			<i class="fas fa-truck <?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="supplier"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="supplier"){echo "text-white";}?>">Supplier</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('admin/user'); ?>">
			<i class="fas fa-users <?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="user"){echo "text-white";}?>"></i>
			<span class="<?php if($this->uri->segment(1)=="admin" && $this->uri->segment(2)=="user"){echo "text-white";}?>">User</span></a>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>