<div class="row">
	<div class="col-lg-6 d-none d-lg-block">
		<div class="text-center mt-2">
			<h2>Sistem Informasi Klinik</h2>
			<img width="250px" heigh="250px" src="<?= base_url() ?>assets/sb_admin_2/img/logo.jpg" alt="">
			<h6 class="text-center mt-3">@copyright 2019</h6>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="p-5">
			<div class="text-center">
				<h1 class="h4 text-gray-900 mb-4">Login User</h1>
			</div>
			<?php $attribute = array( 'class' => 'user'); echo form_open('login/store',$attribute); ?>
			<div class="form-group">
				<input type="text" name="username" class="form-control form-control-user" id="exampleInputEmail"
					aria-describedby="emailHelp" placeholder="Masukan Username" required>
			</div>
			<div class="form-group">
				<input type="password" name="password" class="form-control form-control-user" id="exampleInputPassword"
					placeholder="Masukan password" required>
			</div>
			<button type="submit" class="btn btn-primary btn-user btn-block">
				Login
			</button>
			<?php echo form_close(); ?>
			<!-- <hr>
			<div class="text-center">
				<a class="small" href="forgot-password.html">Forgot Password?</a>
			</div>
			<div class="text-center">
				<a class="small" href="register.html">Create an Account!</a>
			</div> -->
		</div>
	</div>
</div>
