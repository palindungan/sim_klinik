<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

	<!-- Sidebar - Brand -->
	<a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
		<div class="sidebar-brand-icon rotate-n-15">
			<i class="fas fa-laugh-wink"></i>
		</div>
		<div class="sidebar-brand-text mx-3">Apotek<sup></sup></div>
	</a>

	<!-- Divider -->
	<hr class="sidebar-divider">

	<!-- Heading -->
	<div class="sidebar-heading">
		Sistem Informasi Klinik
	</div>

	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('apotek/penjualan_obat'); ?>">
			<i
				class="fas fa-comment-dollar <?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penjualan_obat" && $this->uri->segment(3) == FALSE){echo "text-white";}?>"></i>
			<span
				class="<?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penjualan_obat" && $this->uri->segment(3) == FALSE){echo "text-white";}?>">Penjualan
				Obat</span></a>
	</li>

	<!-- Nav Item - Charts -->
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('apotek/penerimaan'); ?>">
			<i
				class="fas fa-vote-yea <?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penerimaan" && $this->uri->segment(3) == FALSE){echo "text-white";}?>"></i>
			<span
				class="<?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penerimaan" && $this->uri->segment(3) == FALSE){echo "text-white";}?>">Penerimaan
				Obat</span></a>
	</li>
	<li class="nav-item">
		<a class="nav-link" href="<?= base_url('apotek/pengiriman_obat'); ?>">
			<i
				class="fas fa-dolly-flatbed <?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="pengiriman_obat" && $this->uri->segment(3) == FALSE){echo "text-white";}?>"></i>
			<span
				class="<?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="pengiriman_obat" && $this->uri->segment(3) == FALSE){echo "text-white";}?>">Transfer
				Obat</span></a>
	</li>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true"
			aria-controls="collapseTwo">
			<i
				class="fas fa-fw fa-cog <?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="obat"){echo "text-white";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="kategori_obat"){echo "text-white";}?>"></i>
			<span
				class="<?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="obat"){echo "text-white";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="kategori_obat"){echo "text-white";}?>">Data
				Master Apotek</span>
		</a>
		<div id="collapseTwo"
			class="collapse <?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="obat"){echo "show";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="kategori_obat"){echo "show";}?>"
			aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item " href="<?= base_url('apotek/obat'); ?>">Obat</a>
				<a class="collapse-item" href="<?= base_url('apotek/kategori_obat'); ?>">Kategori Obat</a>
			</div>
		</div>
	</li>

	<!-- Nav Item - Pages Collapse Menu -->
	<li class="nav-item">
		<a class="nav-link" href="#" data-toggle="collapse" data-target="#collapseTwo2" aria-expanded="true"
			aria-controls="collapseTwo">
			<i
				class="fas fa-history <?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penjualan_obat" && $this->uri->segment(3)=="tampil_daftar_penjualan_obat"){echo "text-white";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penerimaan" && $this->uri->segment(3)=="tampil_daftar_penerimaan_obat"){echo "text-white";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="pengiriman_obat" && $this->uri->segment(3)=="tampil_daftar_pengiriman_obat"){echo "text-white";}?>"></i>
			<span
				class="<?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penjualan_obat" && $this->uri->segment(3)=="tampil_daftar_penjualan_obat"){echo "text-white";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penerimaan" && $this->uri->segment(3)=="tampil_daftar_penerimaan_obat"){echo "text-white";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="pengiriman_obat" && $this->uri->segment(3)=="tampil_daftar_pengiriman_obat"){echo "text-white";}?>">History
				Transaksi</span>
		</a>
		<div id="collapseTwo2"
			class="collapse <?php if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penjualan_obat" && $this->uri->segment(3)=="tampil_daftar_penjualan_obat"){echo "show";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="penerimaan" && $this->uri->segment(3)=="tampil_daftar_penerimaan_obat"){echo "show";} else if($this->uri->segment(1)=="apotek" && $this->uri->segment(2)=="pengiriman_obat" && $this->uri->segment(3)=="tampil_daftar_pengiriman_obat"){echo "show";}?>"
			aria-labelledby="headingTwo" data-parent="#accordionSidebar">
			<div class="bg-white py-2 collapse-inner rounded">
				<a class="collapse-item "
					href="<?= base_url('apotek/penjualan_obat/tampil_daftar_penjualan_obat'); ?>">Penjualan Obat</a>
				<a class="collapse-item"
					href="<?= base_url('apotek/penerimaan/tampil_daftar_penerimaan_obat'); ?>">Penerimaan Obat /
					Alkes</a>
				<a class="collapse-item"
					href="<?= base_url('apotek/pengiriman_obat/tampil_daftar_pengiriman_obat'); ?>">Transfer Obat</a>
			</div>
		</div>
	</li>

	<!-- Divider -->
	<hr class="sidebar-divider d-none d-md-block">

	<!-- Sidebar Toggler (Sidebar) -->
	<div class="text-center d-none d-md-inline">
		<button class="rounded-circle border-0" id="sidebarToggle"></button>
	</div>

</ul>
