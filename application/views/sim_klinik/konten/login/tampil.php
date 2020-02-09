<?php if($this->session->flashdata('login')) : ?>
<div class="cek-login" data-flashdata="<?= $this->session->flashdata('login'); ?>"></div>
<?php endif; ?>
<div class="row">
	<div class="col-lg-6 d-none d-lg-block">
		<div class="text-center mt-2">
			<h4 class="text-dark">Sistem Informasi Klinik</h4>
			<img width="250px" heigh="250px" src="<?= base_url() ?>assets/sb_admin_2/img/logo.jpg" alt="">
			<h6 class="text-center mt-3 text-dark">EraIT 2020</h6>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="p-5">
			<div class="text-center">
				<h1 class="h4 text-gray-900 mb-4">Login User</h1>
			</div>
			<?php $attribute = array( 'class' => 'user'); echo form_open('login/store',$attribute); ?>
			<div class="form-group">
				<input type="text" name="username" class="form-control" id="exampleInputEmail"
					aria-describedby="emailHelp" placeholder="Masukan Username" required>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control" id="exampleInputPassword"
					placeholder="Masukan password" required>
			</div>
			<button type="submit" class="btn btn-primary btn-user btn-block">
				Login
			</button>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>
