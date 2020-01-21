<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_apotek_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Apotek</h5>
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
                                <th>Nama Obat</th>
                                <th>Kategori</th>
                                <th>Stok</th>
                                <th>Harga Jual</th>
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

<script>
    // jika kita tekan / click button search-button
    $('#btn_search_apotek_obat').on('click', function() {
        search_proses_apotek_obat();
    });

    // Start pencarian
    function search_proses_apotek_obat() {

        var table;
        table = $('#table_apotek_obat').DataTable({
            "columnDefs": [{
                    "targets": 4,
                    "className": "text-right"
                }, {
                    "targets": 5,
                    "className": "text-center"
                }

            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'apotek/penjualan_obat/tampil_daftar_obat'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_obat = data[i].kode_obat;
                        var nama_obat = data[i].nama_obat;
                        var nama_kategori = data[i].nama_kategori;
                        var qty = data[i].qty;
                        var harga_jual = data[i].harga_jual;

                        var reverse = harga_jual.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="tambah_detail_apotek_obat('` + kode_obat +
                            `','` + nama_obat + `','` + harga_jual + `','` + qty + `')" id="` +
                            kode_obat +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_obat, nama_kategori, qty,
                            ribuan, button
                        ]);

                        no = no + 1;
                    });
                }
                table.draw();

            }
        });
    }

    // Start add_row kode_obat, nama_obat, harga_jual, qty
    function tambah_detail_apotek_obat(kode_obat, nama_obat, harga_apotek_obat, qty) {

        $('#detail_list_apotek_obat').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama_obat + `
                <input type="hidden" name="kode_obat[]" class="form-control form-control-sm" id="kode_obat` + count_transaksi + `" value="` + kode_obat + `">
            </td>
            <td>
                <input type="text" name="qty_apotek_obat[]" class="form-control form-control-sm cek_qty_apotek_obat" id="qty_apotek_obat` + count_transaksi + `" placeholder="QTY" value="1" required>
                <input readonly type="hidden" name="cek_qty_apotek_obat[]" class="form-control form-control-sm" id="cek_qty_apotek_obat` + count_transaksi + `" value="` + qty + `">
            </td>
            <td>
                <div class="btn-icon-split col-12">
                    <input type="checkbox" name="status_paket_apotek_obat_cb[]" class="col-md-1 icon deteksi_cek_box form-control form-control-sm" id="status_paket_apotek_obat_cb` + count_transaksi + `" >
                    <input type="hidden" name="status_paket_apotek_obat[]" class="col-md-1 icon form-control form-control-sm" id="status_paket_apotek_obat` + count_transaksi + `" value="Tidak">
                    <input type="text" name="harga_apotek_obat[]" class="col-md-11 form-control form-control-sm rupiah text-right harga_apotek_obat_update" id="harga_apotek_obat` + count_transaksi + `" placeholder="Harga Obat Apotek" required value="` + harga_apotek_obat + `">
                    <input type="hidden" name="harga_obat_lama[]" class="col-md-1 icon form-control form-control-sm" id="harga_obat_lama` + count_transaksi + `" value="` + harga_apotek_obat + `">
                </div>
                <input type="hidden" class="form-control form-control-sm rupiah text-right" id="harga_cadangan_apotek_obat` + count_transaksi + `" readonly required value="` + harga_apotek_obat + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_apotek_obat` + count_transaksi + `" readonly required value="` + harga_apotek_obat + `">
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
        update_sub_total_apotek_obat();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_apotek_obat', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
        update_sub_total_apotek_obat();
    });

    $(document).on('keyup', '.harga_apotek_obat_update', function() {

        var row_id = $(this).attr("id"); // harga_apotek_obat1++
        var row_no = row_id.substring(17); // 1++

        var row_val = $('#' + row_id).val();
        var val_qty = $('#qty_apotek_obat' + row_no).val();

        // sub total
        var val_harga_apotek_obat = parseInt(row_val.split('.').join(''));
        $('#harga_sub_apotek_obat' + row_no).val(val_harga_apotek_obat * val_qty);

        update_sub_total_apotek_obat();
    });

    $(document).on('keyup', '.cek_qty_apotek_obat', function() {

        var row_id = $(this).attr("id"); // qty_apotek_obat1++
        var row_no = row_id.substring(15); // 1++

        var val_qty = $('#' + row_id).val();
        var val_qty_sekarang = parseInt($('#cek_qty_apotek_obat' + row_no).val());

        if (val_qty <= val_qty_sekarang) {
            update_sub_total_apotek_obat()
        } else {
            alert("Maaf Qty Detail Obat Tidak Boleh Melebihi Stok Apotek");
            $('#' + row_id).val("1");
            update_sub_total_apotek_obat();
        }

        // sub total
        var harga_apotek_obat = $('#harga_apotek_obat' + row_no).val()
        var val_harga_apotek_obat = parseInt(harga_apotek_obat.split('.').join(''));
        $('#harga_sub_apotek_obat' + row_no).val(val_harga_apotek_obat * val_qty);
    });

    function update_sub_total_apotek_obat() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_apotek_obat'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_apotek_obat').val(data);
                update_grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
</script>