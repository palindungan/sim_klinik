<?php if ($this->session->flashdata('success')) : ?>
    <div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Return Obat</h6>
        </div>
        <div class="card-body">
            <form method="post" id="transaksi_form" action="<?php echo base_url('apotek/return_obat/input_transaksi_form') ?>">
                <div class="row">
                    <div class="col-sm-3">
                        <label for="">Asal</label>
                        <select name="asal" id="asal" class="form-control form-control-sm" required>
                            <option value="">Pilih</option>
                            <option value="Gudang">Gudang</option>
                            <option value="RI">RI</option>
                            <option value="RJ">RJ</option>
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <label for="">Tujuan</label>
                        <select name="tujuan" id="tujuan" class="form-control form-control-sm" required>
                            <option value="">Pilih</option>
                            <option value="Supplier">Supplier</option>
                            <option value="Gudang">Gudang</option>
                            <option value="RI">RI</option>
                            <option value="RJ">RJ</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <a href="#" id="btn_search_apotek_obat" class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#exampleModalCenter_apotek_obat">Cari Obat</a>
                    </div>
                </div>

                <input type="hidden" readonly name="sub_total_apotek_obat" class="angka_default form-control form-control-sm rupiah text-right" id="sub_total_apotek_obat" placeholder="Sub Total Obat Apotek">

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Nama Obat/Alkes</td>
                                    <td>Kategori</td>
                                    <td width="10%">Qty</td>
                                    <td width="5%">Hapus</td>
                                </tr>
                            </thead>

                            <tbody>
                                <tr id="label_kosong">
                                    <td>
                                        Detail Transaksi Masih Kosong !
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>
                            </tbody>

                            <tbody id="detail_list_apotek_obat"></tbody>
                        </table>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-sm-2">
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
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_apotek_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Item</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table_apotek_obat" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Item</th>
                                <th>Kategori</th>
                                <th>Stok Gudang</th>
                                <th>Stok RI</th>
                                <th>Stok RJ</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="daftar_apotek_obat">
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
<script type="text/javascript">
    // Deklarasi Variable 
    var count_transaksi = 0;
    var jumlah_detail_transaksi = 0;
    $('#btn_search_apotek_obat').on('click', function() {
        search_proses_apotek_obat();
    });

    function search_proses_apotek_obat() {

        var table;
        table = $('#table_apotek_obat').DataTable({
            "columnDefs": [{
                    "targets": [0, 4],
                    "className": "text-center"
                }

            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'apotek/return_obat/tampil_daftar_obat'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_obat = data[i].kode_obat;
                        var nama_obat = data[i].nama_obat;
                        var nama_kategori = data[i].nama_kategori;
                        var stok_gudang = data[i].stok_gudang;
                        var stok_ri = data[i].stok_rawat_inap;
                        var stok_rj = data[i].stok_rawat_jalan;

                        var button = `<a onclick="tambah_detail_apotek_obat('` + kode_obat +
                            `','` + nama_obat + `','` + nama_kategori + `')" id="` +
                            kode_obat +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_obat, nama_kategori, stok_gudang, stok_ri, stok_rj, button]);

                        no = no + 1;
                    });
                }
                table.draw();

            }
        });
    }

    function tambah_detail_apotek_obat(kode_obat, nama_obat, nama_kategori, qty) {

        $('#detail_list_apotek_obat').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama_obat + `
                <input type="hidden" name="kode_obat[]" class="form-control form-control-sm" id="kode_obat` + count_transaksi + `" value="` + kode_obat + `">
            </td>
            <td>
                ` + nama_kategori + `
            </td>
            <td>
                <input type="text" name="qty_apotek_obat[]" class="form-control form-control-sm cek_qty_apotek_obat" id="qty_apotek_obat` + count_transaksi + `" placeholder="QTY" value="1" required>
                <input readonly type="hidden" name="cek_qty_apotek_obat[]" class="form-control form-control-sm" id="cek_qty_apotek_obat` + count_transaksi + `" value="` + qty + `">
            </td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_apotek_obat">
                        <span class="icon text-white-50">
                            <i class="fas fa-trash-alt"></i>
                        </span>
                    </a>
                </div>
            </td>
        </tr>

		`);

        count_transaksi = count_transaksi + 1;
        jumlah_detail_transaksi = jumlah_detail_transaksi + 1;
        $('#exampleModalCenter_apotek_obat').modal('hide');

        cek_jumlah_data_detail_transaksi();
    }
    $(document).on('click', '.remove_baris_apotek_obat', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
    });

    $(document).on('keyup', '.cek_qty_apotek_obat', function() {

        var row_id = $(this).attr("id"); // qty_apotek_obat1++
        var row_no = row_id.substring(15); // 1++

        var val_qty = $('#' + row_id).val();
        var val_qty_sekarang = parseInt($('#cek_qty_apotek_obat' + row_no).val());

        if (val_qty <= val_qty_sekarang) {
            // update_sub_total_apotek_obat()
        } else {
            // alert("Maaf Qty Detail Obat Tidak Boleh Melebihi Stok Apotek");
            // $('#' + row_id).val("1");
        }

    });
</script>

<!-- start of pecahan codingan script -->
<!-- end of pecahan codingan script -->

<script>
    function cek_jumlah_data_detail_transaksi() {

        var x = document.getElementById("label_kosong").style;
        if (jumlah_detail_transaksi > 0) {
            x.display = "none"; // hidden
        } else {
            x.display = "table-row"; // show
        }
    }
</script>