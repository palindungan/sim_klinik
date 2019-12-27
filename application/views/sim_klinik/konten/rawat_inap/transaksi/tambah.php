<?php if ($this->session->flashdata('success')) : ?>
    <div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Rawat Inap</h6>
        </div>
        <div class="card-body">
            <form method="post" id="transaksi_form">
                <div class="form-row">
                    <div class="form-group col-sm-5">
                        <label>Cari No Ref</label>
                        <select class="form-control form-control-sm itemName" name="no_ref_pelayanan" required>
                        </select>
                    </div>
                </div>


                <!-- <div class="form-row">
                    <div class="form-group col-sm-12">
                        <label>Biodata Pasien</label>
                        <div id="muncul">

                            <table width="100%" class="responsive">
                                <tr>
                                    <td width="6%">
                                        <h5>Nama</h5>
                                    </td>
                                    <td width="2%">
                                        <h5>:</h5>
                                    </td>
                                    <td width="24%">
                                        <h5 id="txt_nama"></h5>
                                    </td>
                                    <td width="6%">
                                        <h5>Umur</h5>
                                    </td>
                                    <td width="2%">
                                        <h5>:</h5>
                                    </td>
                                    <td width="19%">
                                        <h5 id="txt_umur"></h5>
                                    </td>
                                    <td width="8%">
                                        <h5>Alamat</h5>
                                    </td>
                                    <td width="2%">
                                        <h5>:</h5>
                                    </td>
                                    <td width="22%">
                                        <h5 id="txt_alamat"></h5>
                                    </td>
                                </tr>
                            </table>

                        </div>
                    </div>
                </div> -->

                <!-- Start of Kamar /////////// -->
                <div class="form-row">
                    <label>Kamar Rawat Inap</label>
                    <div class="form-group col-sm-12">
                        <a href="#" id="btn_search_kamar" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter_kamar">
                            <span class="icon text-white-50">
                                <i class="fas fa-search-plus"></i>
                            </span>
                            <span class="text">Cari Kamar</span>
                        </a>
                    </div>

                </div>

                <div class="form-row">
                    <label class=" col-sm-5"><b>Nama Kamar</b></label>
                    <label class=" col-sm-4"><b>Harga Harian</b></label>
                    <label class=" col-sm-1"><b>Tipe</b></label>
                </div>

                <!-- start untuk keranjang Kamar -->
                <div id="detail_list_kamar">
                    <!-- disini isi detail -->
                    <h6 id="label_kosong_kamar">Detail Kamar Masih Kosong Lakukan pilih Pencarian Kamar !</h6>

                </div>
                <!-- end of untuk keranjang Kamar -->

                <div class="form-row">
                    <div class="form-group col-sm-5"> </div>
                    <div class="form-group col-sm-5">
                        <input type="text" readonly name="sub_total_harga_kamar" class="form-control form-control-sm rupiah_kamar text-right" id="sub_total_harga_kamar" placeholder="Sub Total" required>
                    </div>

                </div>
                <!-- End of Kamar ////////// -->

                <!-- Start of tindakan /////////// -->
                <div class="form-row">
                    <label>tindakan Rawat Inap</label>
                    <div class="form-group col-sm-12">
                        <a href="#" id="btn_search_tindakan" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter_tindakan">
                            <span class="icon text-white-50">
                                <i class="fas fa-search-plus"></i>
                            </span>
                            <span class="text">Cari tindakan</span>
                        </a>
                    </div>

                </div>

                <div class="form-row">
                    <label class=" col-sm-5"><b>Nama tindakan</b></label>
                    <label class=" col-sm-4"><b>Harga</b></label>
                </div>

                <!-- start untuk keranjang tindakan -->
                <div id="detail_list_tindakan">
                    <!-- disini isi detail -->
                    <h6 id="label_kosong_tindakan">Detail tindakan Masih Kosong Lakukan pilih Pencarian tindakan !</h6>

                </div>
                <!-- end of untuk keranjang tindakan -->

                <div class="form-row">
                    <div class="form-group col-sm-5"> </div>
                    <div class="form-group col-sm-5">
                        <input type="text" readonly name="sub_total_harga_tindakan" class="form-control form-control-sm rupiah_tindakan text-right" id="sub_total_harga_tindakan" placeholder="Sub Total" required>
                    </div>

                </div>
                <!-- End of tindakan ////////// -->

                <!-- Start of obat /////////// -->
                <div class="form-row">
                    <label>obat Rawat Inap</label>
                    <div class="form-group col-sm-12">
                        <a href="#" id="btn_search_obat" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter_obat">
                            <span class="icon text-white-50">
                                <i class="fas fa-search-plus"></i>
                            </span>
                            <span class="text">Cari obat</span>
                        </a>
                    </div>

                </div>

                <div class="form-row">
                    <label class=" col-sm-5"><b>Nama Obat</b></label>
                    <label class=" col-sm-4"><b>Harga Jual</b></label>
                    <label class=" col-sm-1"><b>QTY</b></label>
                </div>

                <!-- start untuk keranjang obat -->
                <div id="detail_list_obat">
                    <!-- disini isi detail -->
                    <h6 id="label_kosong_obat">Detail obat Masih Kosong Lakukan pilih Pencarian obat !</h6>

                </div>
                <!-- end of untuk keranjang obat -->

                <div class="form-row">
                    <div class="form-group col-sm-5"> </div>
                    <div class="form-group col-sm-5">
                        <input type="text" readonly name="sub_total_harga_obat" class="form-control form-control-sm rupiah_obat text-right" id="sub_total_harga_obat" placeholder="Sub Total" required>
                    </div>

                </div>
                <!-- End of obat ////////// -->

                <div class="form-row">
                    <div class="form-group col-sm-5">
                        <input type="text" readonly name="total_harga" class="form-control form-control-sm rupiah_kamar text-right" id="total_harga" placeholder="Total" required>
                    </div>

                    <div class="form-group col-sm-2">
                        <button id="action" type="submit" class="btn btn-sm btn-success btn-icon-split" onclick="return confirm('Lakukan Simpan Data ?')">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan Data</span>
                        </button>
                    </div>

                </div>

            </form>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_kamar" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kamar</th>
                                <th>Harga Harian</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar_kamar">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_tindakan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama tindakan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar_tindakan">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_obat" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Kategori</th>
                                <th>Tanggal Penerimaan</th>
                                <th>Stok Saat Ini</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar_obat">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
    $('.itemName').select2({
        ajax: {
            url: "<?= base_url('apotek/penjualan_obat/tampil_select') ?>",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return {
                    no_ref: params.term,
                    nama: params.term
                };
            },
            processResults: function(data) {
                var results = [];

                $.each(data, function(index, item) {
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
</script>

<script>
    // $(document).on('change', '#xx', function(event) {
    //     var nilai_value = $('#xx').val();

    //     // Fetch data
    //     $.ajax({
    //         url: "<?php echo base_url() . 'rawat_inap/transaksi/get_pasien_by_no_ref_pelayanan'; ?>",
    //         type: 'post',
    //         data: {
    //             nilai: nilai_value
    //         },
    //         success: function(hasil) {

    //             // parse
    //             var obj = JSON.parse(hasil);
    //             let data = obj['tbl_data'];

    //             if (data != '') {

    //                 $.each(data, function(i, item) {

    //                     var nama = data[i].nama;
    //                     var alamat = data[i].alamat;
    //                     var tgl_lahir = data[i].tgl_lahir;

    //                     // parse
    //                     var tahun = tgl_lahir.substring(0, 4);

    //                     var date = new Date();
    //                     var year = date.getFullYear();

    //                     var umur = year - tahun;

    //                     $("#txt_nama").html(nama);
    //                     $("#txt_alamat").html(alamat);
    //                     $("#txt_umur").html(umur);
    //                 });
    //             } else {

    //                 alert("Data Dengan Kode : " + nilai_value + " Tidak Ditemukan !");

    //             }
    //         }
    //     });
    // });

    var count1 = 0;
    var jumlah_detail_transaksi_kamar = 0;

    // Start of kamar////////////////
    // jika kita tekan / click button search-button
    $('#btn_search_kamar').on('click', function() {
        search_proses_kamar();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_kamar', function() {
        var row_no = $(this).attr("id");
        $('#row_kamar' + row_no).remove();

        jumlah_detail_transaksi_kamar = jumlah_detail_transaksi_kamar - 1;

        cekJumlahDataTransaksi_kamar();
    });

    // jika kita mengubah class inputan rupiah_kamar
    $(document).on('keyup', '.rupiah_kamar', function() {
        update_sub_harga_kamar();
    });

    // Start pencarian
    function search_proses_kamar() {

        var table;
        table = $('.table_kamar').DataTable({
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
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_kamar'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_kamar = data[i].no_kamar_rawat_i;
                        var nama_kamar = data[i].nama;
                        var harga_harian_kamar = data[i].harga_harian;
                        var tipe_kamar = data[i].tipe;

                        var reverse = harga_harian_kamar.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="pilihKamar('` + kode_kamar +
                            `','` + nama_kamar + `','` + harga_harian_kamar + `','` + tipe_kamar + `')" id="` + kode_kamar +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_kamar, ribuan, tipe_kamar, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_kamar').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row
    function pilihKamar(kode_kamar, nama_kamar, harga_harian_kamar, tipe_kamar) {

        $('#detail_list_kamar').append(`

			<div id="row_kamar` + count1 + `" class="form-row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama_kamar[]" class="form-control form-control-sm karakter" id="nama_kamar` + count1 +
            `" placeholder="Nama_kamar" required value="` + nama_kamar + `">
					<input type="hidden" name="no_kamar_rawat_i[]" class="form-control form-control-sm" id="no_kamar_rawat_i` + count1 + `" value="` +
            kode_kamar + `">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_harian_kamar[]" class="form-control form-control-sm rupiah_kamar text-right" id="harga_harian_kamar` + count1 +
            `" placeholder="Harga Harian Kamar" required value="` + harga_harian_kamar + `">
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="tipe_kamar[]" readonly class="form-control form-control-sm rupiah" id="tipe_kamar` + count1 + `" placeholder="Tipe Kamar" value="` + tipe_kamar + `" required>
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count1 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_kamar">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						<span class="text">Hapus</span>
					</a>
				</div>
			</div>

		`);

        count1 = count1 + 1;
        jumlah_detail_transaksi_kamar = jumlah_detail_transaksi_kamar + 1;
        $('#exampleModalCenter_kamar').modal('hide');

        cekJumlahDataTransaksi_kamar();
    }

    function cekJumlahDataTransaksi_kamar() {

        var x = document.getElementById("label_kosong_kamar");
        if (jumlah_detail_transaksi_kamar > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }

        update_sub_harga_kamar();
    }

    function update_sub_harga_kamar() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'rawat_inap/transaksi/ambil_sub_total_kamar'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_harga_kamar').val(data);
                $('.rupiah_kamar').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
    // End of Kamar///////////////////

    var count2 = 0;
    var jumlah_detail_transaksi_tindakan = 0;

    // Start of tindakan////////////////
    // jika kita tekan / click button search-button
    $('#btn_search_tindakan').on('click', function() {
        search_proses_tindakan();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_tindakan', function() {
        var row_no = $(this).attr("id");
        $('#row_tindakan' + row_no).remove();

        jumlah_detail_transaksi_tindakan = jumlah_detail_transaksi_tindakan - 1;

        cekJumlahDataTransaksi_tindakan();
    });

    // jika kita mengubah class inputan rupiah_tindakan
    $(document).on('keyup', '.rupiah_tindakan', function() {
        update_sub_harga_tindakan();
    });

    // Start pencarian
    function search_proses_tindakan() {

        var table;
        table = $('.table_tindakan').DataTable({
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
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_tindakan'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_tindakan = data[i].no_rawat_inap_t;
                        var nama_tindakan = data[i].nama;
                        var harga_tindakan = data[i].harga;

                        var reverse = harga_tindakan.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="pilihtindakan('` + kode_tindakan +
                            `','` + nama_tindakan + `','` + harga_tindakan + `')" id="` + kode_tindakan +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_tindakan, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_tindakan').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row
    function pilihtindakan(kode_tindakan, nama_tindakan, harga_tindakan) {

        $('#detail_list_tindakan').append(`

			<div id="row_tindakan` + count2 + `" class="form-row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama_tindakan[]" class="form-control form-control-sm karakter" id="nama_tindakan` + count2 +
            `" placeholder="Nama_tindakan" required value="` + nama_tindakan + `">
					<input type="hidden" name="no_rawat_inap_t[]" class="form-control form-control-sm" id="no_rawat_inap_t` + count2 + `" value="` +
            kode_tindakan + `">
				</div>
				<div class="form-group col-sm-5">
					<input type="text" name="harga_tindakan[]" class="form-control form-control-sm rupiah_tindakan text-right" id="harga_tindakan` + count2 +
            `" placeholder="Harga Harian tindakan" required value="` + harga_tindakan + `">
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count2 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_tindakan">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						<span class="text">Hapus</span>
					</a>
				</div>
			</div>

		`);

        count2 = count2 + 1;
        jumlah_detail_transaksi_tindakan = jumlah_detail_transaksi_tindakan + 1;
        $('#exampleModalCenter_tindakan').modal('hide');

        cekJumlahDataTransaksi_tindakan();
    }

    function cekJumlahDataTransaksi_tindakan() {

        var x = document.getElementById("label_kosong_tindakan");
        if (jumlah_detail_transaksi_tindakan > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }

        update_sub_harga_tindakan();
    }

    function update_sub_harga_tindakan() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'rawat_inap/transaksi/ambil_sub_total_tindakan'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_harga_tindakan').val(data);
                $('.rupiah_tindakan').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
    // End of Tindakan///////////////////


    var count3 = 0;
    var jumlah_detail_transaksi_obat = 0;

    // Start of obat////////////////
    // jika kita tekan / click button search-button
    $('#btn_search_obat').on('click', function() {
        search_proses_obat();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_obat', function() {
        var row_no = $(this).attr("id");
        $('#row_obat' + row_no).remove();

        jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat - 1;

        cekJumlahDataTransaksi_obat();
    });

    // jika kita mengubah class inputan rupiah_obat
    $(document).on('keyup', '.rupiah_obat', function() {
        update_sub_harga_obat();
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.qty_format', function() {

        var row_id = $(this).attr("id"); // qty1++
        var row_no = row_id.substring(3); // 1++

        var val_qty = parseInt($('#' + row_id).val());
        var val_qty_sekarang = parseInt($('#qty_sekarang' + row_no).val());

        if (val_qty <= val_qty_sekarang) {
            cekJumlahDataTransaksi_obat();
        } else {
            alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek");
            $('#' + row_id).val("1");
            cekJumlahDataTransaksi_obat();
        }
    });

    // Start pencarian
    function search_proses_obat() {

        var table;
        table = $('.table_obat').DataTable({
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
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_obat'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_obat = data[i].no_stok_obat_rawat_i;
                        var nama_obat = data[i].nama_obat;
                        var nama_kategori = data[i].nama_kategori;
                        var qty_sekarang = data[i].qty_sekarang;
                        var harga_obat = data[i].harga_jual;
                        var tgl_obat_keluar_i = data[i].tgl_obat_keluar_i;

                        var reverse = harga_obat.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);

                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="pilihobat('` + kode_obat +
                            `','` + nama_obat + `','` + nama_kategori + `','` + qty_sekarang + `','` + harga_obat + `')" id="` + kode_obat +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_obat, nama_kategori, tgl_obat_keluar_i, qty_sekarang, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_obat').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row
    function pilihobat(kode_obat, nama_obat, nama_kategori, qty_sekarang, harga_obat) {

        $('#detail_list_obat').append(`

            <div id="row` + count3 + `" class="form-row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama_obat[]" class="form-control form-control-sm karakter" id="nama_obat` + count3 +
            `" placeholder="Nama_obat" required value="` + nama_obat + `">
					<input type="hidden" name="no_stok_obat_rawat_i[]" class="form-control form-control-sm" id="no_stok_obat_rawat_i` + count3 +
            `" value="` +
            kode_obat + `">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_obat[]" class="form-control form-control-sm rupiah_obat text-right" id="harga_obat` +
            count3 +
            `" placeholder="harga Obar" required value="` + harga_obat + `">
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="qty[]" class="form-control form-control-sm qty_format" id="qty` + count3 + `" placeholder="QTY" value="1" required>
					<input type="hidden" name="qty_sekarang[]" id="qty_sekarang` + count3 + `" class="form-control form-control-sm" value="` + qty_sekarang + `"></input>
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count3 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						<span class="text">Hapus</span>
					</a>
				</div>
			</div>

		`);

        count3 = count3 + 1;
        jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat + 1;
        $('#exampleModalCenter_obat').modal('hide');

        cekJumlahDataTransaksi_obat();
    }

    function cekJumlahDataTransaksi_obat() {

        var x = document.getElementById("label_kosong_obat");
        if (jumlah_detail_transaksi_obat > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }

        update_sub_harga_obat();
    }

    function update_sub_harga_obat() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'rawat_inap/transaksi/ambil_sub_total_obat'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_harga_obat').val(data);
                $('.rupiah_obat').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
    // End of obat///////////////////

    // jika di click simpan / submit
    $(document).on('submit', '#transaksi_form', function(event) {
        event.preventDefault();

        // mengambil nilai di dalam form
        var form_data = $(this).serialize();

        // tambah ke database
        $.ajax({
            url: "<?php echo base_url() . 'rawat_inap/transaksi/input_transaksi_form'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                alert(data);
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
    }
</script>