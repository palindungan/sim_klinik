<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tagihan</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">
				<div class="form-row">
					<div class="form-group col-sm-5">
						<label>Cari No Ref</label>
						<select class="form-control form-control-sm noRef" name="no_ref_pelayanan" required>
						</select>
					</div>
					<div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Grand Total</label>
						<input type="text" id="grand_total" name="grand_total" class="form-control form-control-sm rupiah_grand_total text-right" placeholder="0" readonly>
                    </div>


				</div>

				<div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h5>* Balai Pengobatan</h5>
                                <a href="#" id="btn_search_bp" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterBP">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan BP</span>
                                </a>
					        </div>
                            <div class="form-group col-sm-6">
                                <h5>* Poli Kia</h5>
                                    <a href="#" id="btn_search_kia" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterKIA">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                        <span class="text">Cari Tindakan KIA</span>
                                    </a>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan BP</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                    
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_bp">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_bp">Detail Tindakan Masih Kosong!</h6>
                                        </div> 
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_bp" class="form-control form-control-sm rupiah_bp text-right" id="total_harga_bp" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan KIA</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_kia">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_kia">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_kia" class="form-control form-control-sm rupiah_kia text-right" id="total_harga_kia" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                        </div>
                    </div>
				</div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h5>* Laboratorium</h5>
                                <a href="#" id="btn_search_lab" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterLAB">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan Lab</span>
                                </a>
					        </div>
                            <div class="form-group col-sm-6">
                                <h5>* UGD</h5>
                                    <a href="#" id="btn_search_ugd" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterUGD">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                        <span class="text">Cari Tindakan UGD</span>
                                    </a>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan Lab</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_lab">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_lab">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_lab" class="form-control form-control-sm rupiah_lab text-right" id="total_harga_lab" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan UGD</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_ugd">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_ugd">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_ugd" class="form-control form-control-sm rupiah_ugd text-right" id="total_harga_ugd" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                        </div>
                    </div>
				</div>
			</form>
		</div>
	</div>

</div>

<!-- Modal Tindakan BP -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterBP" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan Balai Pengobatan</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_tindakan_bp" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Biaya</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody id="tindakan_bp">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tindakan KIA -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterKIA" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan Poli KIA</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_tindakan_kia" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Biaya</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody id="tindakan_kia">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tindakan LAB -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterLAB" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan Laboratorium</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_tindakan_lab" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Biaya</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody id="tindakan_lab">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- Modal Tindakan UGD -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterUGD" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan UGD</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_tindakan_ugd" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th class="text-center">No</th>
								<th class="text-center">Nama</th>
								<th class="text-center">Biaya</th>
								<th class="text-center">Aksi</th>
							</tr>
						</thead>
						<tbody id="tindakan_ugd">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
$('.noRef').select2({
	ajax:{
		url : "<?= base_url('administrasi/tagihan/tampil_select') ?>",
		dataType : "json",
		delay : 250,
		data : function(params){
			return {
				no_ref : params.term,
				nama : params.term
			};
		},
		processResults : function(data) {
			var results = [];

			$.each(data,function(index,item){
				results.push({
					id : item.no_ref_pelayanan,
					text : item.no_ref_pelayanan + " || " + item.nama					
				});
			});
			return {
				results : results
			}
		}
	}
})
</script>
<script>
    var count_bp = 0;
	var jumlah_detail_transaksi_bp = 0;

    var count_kia = 0;
	var jumlah_detail_transaksi_kia = 0;

    var count_lab = 0;
	var jumlah_detail_transaksi_lab = 0;

    var count_ugd = 0;
	var jumlah_detail_transaksi_ugd = 0;

    //Pencarian Tindakan BP 
    // jika kita tekan / click button search-button
    $('#btn_search_bp').on('click', function() {
            search_proses_bp();
    });

    // Start pencarian
    function search_proses_bp() {

    var table;
    table = $('.table_tindakan_bp').DataTable({
        "columnDefs": [{
                "targets": [0, 3],
                "className": "text-center"
            },
            {
                "targets": 2,
                "className": "text-right"
            }
        ],
        "bDestroy": true
    });

    table.clear();

    $.ajax({
        url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_bp'; ?>",
        success: function(hasil) {

            var obj = JSON.parse(hasil);
            let data = obj['tbl_data_bp'];

            if (data != '') {

                var no = 1;

                $.each(data, function(i, item) {

                    var kode = data[i].no_bp_t;
                    var nama = data[i].nama;
                    var harga = data[i].harga;
                    var reverse = harga.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    var button = `<a onclick="pilihTindakanBp('` + kode +
                        `','` + nama + `','` + harga + `')" id="` + kode +
                        `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                    table.row.add([no, nama, ribuan, button]);

                    no = no + 1;
                });
            } else {

                $('.table_tindakan_bp').html('<h3>No data are available</h3>');

            }
            table.draw();

        }
    });
    }

    //Pencarian Tindakan KIA
    // jika kita tekan / click button search-button
    $('#btn_search_kia').on('click', function() {
            search_proses_kia();
    });

    // Start pencarian
    function search_proses_kia() {

    var table;
    table = $('.table_tindakan_kia').DataTable({
        "columnDefs": [{
                "targets": [0, 3],
                "className": "text-center"
            },
            {
                "targets": 2,
                "className": "text-right"
            }
        ],
        "bDestroy": true
    });

    table.clear();

    $.ajax({
        url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_kia'; ?>",
        success: function(hasil) {

            var obj = JSON.parse(hasil);
            let data = obj['tbl_data_kia'];

            if (data != '') {

                var no = 1;

                $.each(data, function(i, item) {

                    var kode = data[i].no_bp_t;
                    var nama = data[i].nama;
                    var harga = data[i].harga;
                    var reverse = harga.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    var button = `<a onclick="pilihTindakanKia('` + kode +
                        `','` + nama + `','` + harga + `')" id="` + kode +
                        `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                    table.row.add([no, nama, ribuan, button]);

                    no = no + 1;
                });
            } else {

                $('.table_tindakan_kia').html('<h3>No data are available</h3>');

            }
            table.draw();

        }
    });
    }

    //Pencarian Tindakan Lab
    // jika kita tekan / click button search-button
    $('#btn_search_lab').on('click', function() {
            search_proses_lab();
    });

    // Start pencarian
    function search_proses_lab() {

    var table;
    table = $('.table_tindakan_lab').DataTable({
        "columnDefs": [{
                "targets": [0, 3],
                "className": "text-center"
            },
            {
                "targets": 2,
                "className": "text-right"
            }
        ],
        "bDestroy": true
    });

    table.clear();

    $.ajax({
        url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_lab'; ?>",
        success: function(hasil) {

            var obj = JSON.parse(hasil);
            let data = obj['tbl_data_lab'];

            if (data != '') {

                var no = 1;

                $.each(data, function(i, item) {

                    var kode = data[i].no_bp_t;
                    var nama = data[i].nama;
                    var harga = data[i].harga;
                    var reverse = harga.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    var button = `<a onclick="pilihTindakanLab('` + kode +
                        `','` + nama + `','` + harga + `')" id="` + kode +
                        `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                    table.row.add([no, nama, ribuan, button]);

                    no = no + 1;
                });
            } else {

                $('.table_tindakan_lab').html('<h3>No data are available</h3>');

            }
            table.draw();

        }
    });
    }

    //Pencarian Tindakan UGD
    // jika kita tekan / click button search-button
    $('#btn_search_ugd').on('click', function() {
            search_proses_ugd();
    });

    // Start pencarian
    function search_proses_ugd() {

    var table;
    table = $('.table_tindakan_ugd').DataTable({
        "columnDefs": [{
                "targets": [0, 3],
                "className": "text-center"
            },
            {
                "targets": 2,
                "className": "text-right"
            }
        ],
        "bDestroy": true
    });

    table.clear();

    $.ajax({
        url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_ugd'; ?>",
        success: function(hasil) {

            var obj = JSON.parse(hasil);
            let data = obj['tbl_data_ugd'];

            if (data != '') {

                var no = 1;

                $.each(data, function(i, item) {

                    var kode = data[i].no_bp_t;
                    var nama = data[i].nama;
                    var harga = data[i].harga;
                    var reverse = harga.toString().split('').reverse().join(''),
                        ribuan = reverse.match(/\d{1,3}/g);
                    ribuan = ribuan.join('.').split('').reverse().join('');
                    var button = `<a onclick="pilihTindakanUgd('` + kode +
                        `','` + nama + `','` + harga + `')" id="` + kode +
                        `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                    table.row.add([no, nama, ribuan, button]);

                    no = no + 1;
                });
            } else {

                $('.table_tindakan_ugd').html('<h3>No data are available</h3>');

            }
            table.draw();

        }
    });
    }

    // Ketika diklik button pilih di BP
    // Start add_row
	function pilihTindakanBp(kode, nama, harga) {

    $('#detail_list_bp').append(`
        <div id="row_bp`+count_bp+`" class="row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_bp[]" class="form-control form-control-sm karakter" id="nama_bp"` + count_bp +
        `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_bp_t[]" class="form-control form-control-sm" id="no_bp_t` + count_bp + `" value="` +
        kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_bp[]" class="form-control form-control-sm rupiah_bp text-right" id="harga_bp` + count_bp +
        `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_bp + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_bp">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_bp = count_bp + 1;
        jumlah_detail_transaksi_bp = jumlah_detail_transaksi_bp + 1;
        $('#exampleModalCenterBP').modal('hide');
		cekJumlahDataTransaksiBp();

    }
    function cekJumlahDataTransaksiBp() {

        var x = document.getElementById("label_kosong_bp");
        if (jumlah_detail_transaksi_bp > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_bp();
        grand_total();
    }

    // jika kita tekan hapus / click button
	$(document).on('click', '.remove_baris_bp', function() {
		var row_no = $(this).attr("id");
		$('#row_bp' + row_no).remove();
		jumlah_detail_transaksi_bp = jumlah_detail_transaksi_bp - 1;
		cekJumlahDataTransaksiBp();
	});

    function update_total_bp() {
		// mengambil nilai di dalam form
		var form_data = $('#transaksi_form').serialize()

		$.ajax({
			url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_bp'; ?>",
			method: "POST",
			data: form_data,
			success: function(data) {
				$('#total_harga_bp').val(data);
				$('.rupiah_bp').trigger('input'); // Will be display 
			}
		});

		validasi();
	}

	function validasi() {
		$('.rupiah_bp').mask('000.000.000', {
			reverse: true
		});
        $('.rupiah_kia').mask('000.000.000', {
			reverse: true
		});
        $('.rupiah_lab').mask('000.000.000', {
			reverse: true
		});
        $('.rupiah_ugd').mask('000.000.000', {
			reverse: true
		});
        $('.rupiah_grand_total').mask('000.000.000', {
			reverse: true
		});
	}

    function grand_total()
    {
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_grand_total'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#grand_total').val(data);
                $('.rupiah_grand_total').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    // Ketika diklik button pilih di KIA
    // Start add_row
	function pilihTindakanKia(kode, nama, harga) {

    $('#detail_list_kia').append(`
        <div id="row_kia`+count_kia+`" class="row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_kia[]" class="form-control form-control-sm karakter" id="nama_kia"` + count_kia +
        `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_kia_t[]" class="form-control form-control-sm" id="no_kia_t` + count_kia + `" value="` +
        kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_kia[]" class="form-control form-control-sm rupiah_kia text-right" id="harga_kia` + count_kia +
        `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_kia + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_kia">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_kia = count_kia + 1;
        jumlah_detail_transaksi_kia = jumlah_detail_transaksi_kia + 1;
        $('#exampleModalCenterKIA').modal('hide');
        cekJumlahDataTransaksiKia();

    }
    function cekJumlahDataTransaksiKia() {

        var x = document.getElementById("label_kosong_kia");
        if (jumlah_detail_transaksi_kia > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_kia();
        grand_total();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_kia', function() {
        var row_no = $(this).attr("id");
        $('#row_kia' + row_no).remove();
        jumlah_detail_transaksi_kia = jumlah_detail_transaksi_kia - 1;
        cekJumlahDataTransaksiKia();
    });

    function update_total_kia() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_kia'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#total_harga_kia').val(data);
                $('.rupiah_kia').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    // Ketika diklik button pilih di LAB
    // Start add_row
	function pilihTindakanLab(kode, nama, harga) {

    $('#detail_list_lab').append(`
        <div id="row_lab`+count_lab+`" class="row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_lab[]" class="form-control form-control-sm karakter" id="nama_lab"` + count_lab +
        `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_lab_c[]" class="form-control form-control-sm" id="no_lab_c` + count_lab + `" value="` +
        kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_lab[]" class="form-control form-control-sm rupiah_lab text-right" id="harga_lab` + count_lab +
        `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_lab + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_lab">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_lab = count_lab + 1;
        jumlah_detail_transaksi_lab = jumlah_detail_transaksi_lab + 1;
        $('#exampleModalCenterLAB').modal('hide');
        cekJumlahDataTransaksiLab();

    }
    function cekJumlahDataTransaksiLab() {

        var x = document.getElementById("label_kosong_lab");
        if (jumlah_detail_transaksi_lab > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_lab();
        grand_total();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_lab', function() {
        var row_no = $(this).attr("id");
        $('#row_lab' + row_no).remove();
        jumlah_detail_transaksi_lab = jumlah_detail_transaksi_lab - 1;
        cekJumlahDataTransaksiLab();
    });

    function update_total_lab() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_lab'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#total_harga_lab').val(data);
                $('.rupiah_lab').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    // Ketika diklik button pilih di UGD
    // Start add_row
	function pilihTindakanUgd(kode, nama, harga) {

    $('#detail_list_ugd').append(`
        <div id="row_ugd`+count_ugd+`" class="row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_ugd[]" class="form-control form-control-sm karakter" id="nama_ugd"` + count_ugd +
        `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_ugd_t[]" class="form-control form-control-sm" id="no_ugd_t` + count_ugd + `" value="` +
        kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_ugd[]" class="form-control form-control-sm rupiah_ugd text-right" id="harga_ugd` + count_ugd +
        `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_ugd + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_ugd">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_ugd = count_ugd + 1;
        jumlah_detail_transaksi_ugd = jumlah_detail_transaksi_ugd + 1;
        $('#exampleModalCenterUGD').modal('hide');
        cekJumlahDataTransaksiUgd();

    }
    function cekJumlahDataTransaksiUgd() {

        var x = document.getElementById("label_kosong_ugd");
        if (jumlah_detail_transaksi_ugd > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_ugd();
        grand_total();

    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_ugd', function() {
        var row_no = $(this).attr("id");
        $('#row_ugd' + row_no).remove();
        jumlah_detail_transaksi_ugd = jumlah_detail_transaksi_ugd - 1;
        cekJumlahDataTransaksiUgd();
    });

    function update_total_ugd() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_ugd'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#total_harga_ugd').val(data);
                $('.rupiah_ugd').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    


</script>