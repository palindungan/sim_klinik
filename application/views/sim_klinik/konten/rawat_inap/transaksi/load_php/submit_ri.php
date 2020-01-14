<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
	$('.itemName').select2({
		ajax: {
			url: "<?= base_url('apotek/penjualan_obat/tampil_select') ?>",
			dataType: "json",
			delay: 250,
			data: function (params) {
				return {
					no_ref: params.term,
					nama: params.term
				};
			},
			processResults: function (data) {
				var results = [];

				$.each(data, function (index, item) {
					results.push({
						id: item.no_ref_pelayanan,
						text: item.no_ref_pelayanan + " || " + item.nama
					});
				});
				return {
					results: results
				}
			}
		}
	})
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
				if (data != "") {
					alert(data);
				}
				location.reload();
			}
		});
		// tambah ke database

	});

	function validasi() {
		$('.rupiah_kamar').mask('000.000.000', {
			reverse: true
		});
		$('.rupiah_tindakan').mask('000.000.000', {
			reverse: true
		});
		$('.rupiah_obat').mask('000.000.000', {
			reverse: true
		});
		$('.rupiah_grant_total').mask('000.000.000', {
			reverse: true
		});
	}

	function grandTotal() {
		var sub_total_harga_tindakan = $('#sub_total_harga_tindakan').val();
		var sub_total_harga_tindakan_v = 0;
		if (sub_total_harga_tindakan != "") {
			sub_total_harga_tindakan_v = parseInt(sub_total_harga_tindakan.split('.').join(''));
		}

		var sub_total_harga_kamar = $('#sub_total_harga_kamar').val();
		var sub_total_harga_kamar_v = 0;
		if (sub_total_harga_kamar != "") {
			sub_total_harga_kamar_v = parseInt(sub_total_harga_kamar.split('.').join(''));
		}

		var sub_total_harga_obat = $('#sub_total_harga_obat').val();
		var sub_total_harga_obat_v = 0;
		if (sub_total_harga_obat != "") {
			sub_total_harga_obat_v = parseInt(sub_total_harga_obat.split('.').join(''));
		}

		$('.rupiah_grant_total').val(sub_total_harga_tindakan_v + sub_total_harga_kamar_v + sub_total_harga_obat_v);
		$('.rupiah_grant_total').trigger('input'); // Will be display 
	}

</script>
