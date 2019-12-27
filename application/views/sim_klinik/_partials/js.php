<!-- Bootstrap core JavaScript-->
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url(); ?>assets/sb_admin_2/js/sb-admin-2.min.js"></script>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/datatables/jquery.dataTables.min.js"> </script>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/datatables/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url(); ?>assets/sb_admin_2/js/demo/datatables-demo.js"></script>
<!-- Agar input tidak ada history -->
<script>
	$("form :input").attr("autocomplete", "off");

</script>
<!-- Format Rupiah -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/auto_complete/jquery-ui.js"></script>

<!-- validasi inputan rupiah -->
<script type="text/javascript">
	$(document).ready(function () {
		$('.rupiah').mask('000.000.000', {
			reverse: true
		});
		$('.hp').mask('0000-0000-0000-000');
		$('.nik').mask('0000000000000000');
		$('.min_stok').mask('000');
	})

</script>
<!-- Validasi hanya karakter -->
<script>
	$('.karakter').keypress(function (e) {
		var regex = new RegExp(/^[a-zA-Z\s]+$/);
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) {
			return true;
		} else {
			e.preventDefault();
			return false;
		}
	});

</script>
<script>
	$('.karakterAngka').keypress(function (e) {
		var regex = new RegExp(/^[a-z0-9\s]+$/i);
		var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
		if (regex.test(str)) {
			return true;
		} else {
			e.preventDefault();
			return false;
		}
	});

</script>
<script type="text/javascript">
	// crud sukses 
	var pesan_sukses = $('.pesan-sukses').data(pesan_sukses);
	var pesan_update = $('.pesan-update').data(pesan_update);
	var pesan_hapus = $('.pesan-hapus').data(pesan_hapus);

	// pendaftaran alert succes
	var pesan_pendaftaran = $('.pesan-pendaftaran').data(pesan_pendaftaran);

	// Validasi konfirmasi password dan Cek username yang ada
	var cek_password = $('.cek-password').data(cek_password);
	var cek_username = $('.cek-username').data(cek_username);
	if (cek_username) {
		Swal.fire({
			icon: 'error',
			title: 'Gagal',
			text: 'Username tersebut sudah ada'
		})
	} else if (cek_password) {
		Swal.fire({
			icon: 'error',
			title: 'Gagal',
			text: 'Password Dan Konfirmasi Tidak Cocok'
		})
	} else if (pesan_sukses) {
		Swal.fire(
			'Success',
			'Data Berhasil Ditambahkan',
			'success'
		)
	} else if (pesan_update) {
		Swal.fire(
			'Success',
			'Data Berhasil Diubah',
			'success'
		)
	} else if (pesan_hapus) {
		Swal.fire(
			'Success',
			'Data Berhasil Dihapus',
			'success'
		)
	} else if (pesan_pendaftaran) {
		Swal.fire(
			'Success',
			'Pendaftaran Pasien Berhasil',
			'success'
		)
	}

</script>
<script>
	$('#dataTable').DataTable({
		ordering: false
	});
</script>