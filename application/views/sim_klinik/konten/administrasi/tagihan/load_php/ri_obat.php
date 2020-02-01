<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_ri_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                    <table id="table_ri_obat" class="table table-bordered" width="100%" cellspacing="0">
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
                        <tbody>
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // jika kita tekan / click button search-button
    $('#btn_search_ri_obat').on('click', function() {
        search_proses_ri_obat();
    });

    // Start pencarian
    function search_proses_ri_obat() {

        var table;
        table = $('#table_ri_obat').DataTable({
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
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_obat'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var no_stok_obat_rawat_i = data[i].no_stok_obat_rawat_i;
                        var nama_obat = data[i].nama_obat;
                        var nama_kategori = data[i].nama_kategori;
                        var qty_sekarang = data[i].qty;
                        var harga_obat = data[i].harga_jual;

                        var reverse = harga_obat.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="tambah_detail_ri_obat('` + no_stok_obat_rawat_i + `','` + nama_obat + `','` + harga_obat + `','` + qty_sekarang + `')" id="` + no_stok_obat_rawat_i + `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_obat, nama_kategori, qty_sekarang,
                            ribuan, button
                        ]);

                        no = no + 1;
                    });
                }
                table.draw();

            }
        });
    }

    // Start add_row no_stok_obat_rawat_i, nama_obat, harga_jual, qty
    function tambah_detail_ri_obat(no_stok_obat_rawat_i, nama_obat, harga_jual, qty) {

        $('#detail_list_ri_obat').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama_obat + `
                <input type="hidden" name="no_stok_obat_rawat_i[]" class="form-control form-control-sm" id="no_stok_obat_rawat_i` + count_transaksi + `" value="` + no_stok_obat_rawat_i + `">
            </td>
            <td>
                <input type="text" name="qty_ri_obat[]" class="form-control form-control-sm cek_qty_ri_obat" id="qty_ri_obat` + count_transaksi + `" placeholder="QTY" value="1" required>
                <input readonly type="hidden" name="cek_qty_ri_obat[]" class="form-control form-control-sm" id="cek_qty_ri_obat` + count_transaksi + `" value="` + qty + `">
            </td>
            <td>
                <input type="checkbox" name="status_paket_ri_obat_cb[]" class="col-md-1 icon deteksi_cek_box_ri form-control form-control-sm" id="status_paket_ri_obat_cb` + count_transaksi + `" >
                <input type="hidden" name="status_paket_ri_obat[]" class="col-md-1 icon form-control form-control-sm" id="status_paket_ri_obat` + count_transaksi + `" value="Tidak">
                <input type="text" name="harga_ri_obat[]" class="col-md-11 form-control form-control-sm rupiah text-right harga_ri_obat_update" id="harga_ri_obat` + count_transaksi + `" placeholder="Harga Obat Rawat Inap" required value="` + harga_jual + `">
                <input type="hidden" name="harga_ri_obat_lama[]" class="col-md-1 icon form-control form-control-sm" id="harga_ri_obat_lama` + count_transaksi + `" value="` + harga_jual + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ri_obat` + count_transaksi + `" readonly required value="` + harga_jual + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_ri_obat">
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
        $('#exampleModalCenter_ri_obat').modal('hide');

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ri_obat();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_ri_obat', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ri_obat();
    });

    $(document).on('keyup', '.harga_ri_obat_update', function() {

        var row_id = $(this).attr("id"); // harga_ri_obat1++
        var row_no = row_id.substring(13); // 1++

        var row_val = $('#' + row_id).val();
        var val_qty = $('#qty_ri_obat' + row_no).val();

        // sub total
        var val_harga_ri_obat = parseInt(row_val.split('.').join(''));
        $('#harga_sub_ri_obat' + row_no).val(val_harga_ri_obat * val_qty);

        update_sub_total_ri_obat();
    });

    $(document).on('keyup', '.cek_qty_ri_obat', function() {

        var row_id = $(this).attr("id"); // qty_ri_obat1++
        var row_no = row_id.substring(11); // 1++

        var val_qty = $('#' + row_id).val();
        var val_qty_sekarang = parseInt($('#cek_qty_ri_obat' + row_no).val());

        if (val_qty <= val_qty_sekarang) {
            update_sub_total_ri_obat()
        } else {
            // alert("Maaf Qty Detail Obat Tidak Boleh Melebihi Stok Rawat Inap");
            // $('#' + row_id).val("1");
            update_sub_total_ri_obat();
        }

        // sub total
        var harga_ri_obat = $('#harga_ri_obat' + row_no).val()
        var val_harga_ri_obat = parseInt(harga_ri_obat.split('.').join(''));
        $('#harga_sub_ri_obat' + row_no).val(val_harga_ri_obat * val_qty);
    });

    function update_sub_total_ri_obat() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_ri_obat'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_ri_obat').val(data);
                update_grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }

    // deteksi paket obat
    $(document).on('click', '.deteksi_cek_box_ri', function() {

        var row_id = $(this).attr("id"); // status_paket_ri_obat_cb1++ status_paket_ri_obat_cb1
        var row_no = row_id.substring(23); // 1++

        // Get the checkbox
        var checkBox = document.getElementById(row_id);

        // If the checkbox is checked, harga_ri_obat harga_sub_ri_obat harga_cadangan_ri_obat
        if (checkBox.checked == true) {
            $('#harga_ri_obat' + row_no).val("0");
            $('#harga_sub_ri_obat' + row_no).val("0");
            $('#status_paket_ri_obat' + row_no).val("Ya");
        } else {

            $('#status_paket_ri_obat' + row_no).val("Tidak");

            var harga_ri_obat_lama = $('#harga_ri_obat_lama' + row_no).val();
            $('#harga_ri_obat' + row_no).val(harga_ri_obat_lama);

            var harga_ri_obat = parseInt($('#harga_ri_obat' + row_no).val().split('.').join(''));
            var qty_ri_obat = parseInt($('#qty_ri_obat' + row_no).val().split('.').join(''));

            $('#harga_sub_ri_obat' + row_no).val(harga_ri_obat * qty_ri_obat);
        }

        update_sub_total_ri_obat();
    });
</script>