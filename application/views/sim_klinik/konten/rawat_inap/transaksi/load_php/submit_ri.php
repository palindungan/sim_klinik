<script type="text/javascript">
	// jika di click simpan / submit
	$(document).on('submit', '#transaksi_form', function (event) {
		event.preventDefault();

		// mengambil nilai di dalam form
		var form_data = $(this).serialize();

		// tambah ke database
		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/input_transaksi_form'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
				// if (data != "") {
				// 	alert(data);
				// }
				location.reload();
			}
		});
		// tambah ke database

	});

	$(document).on('change', '#transaksi_form', function (event) {
		event.preventDefault();

		// mengambil nilai di dalam form
		var form_data = $(this).serialize();

		// tambah ke database
		$.ajax({
			url: "<?php echo base_url() . 'rawat_inap/transaksi/ambil_detail'; ?>",
			method: "POST",
			data: form_data,
			success: function (data) {
				$("#list_detail").html(data);
			}
		});
		// tambah ke database

	});

</script>
