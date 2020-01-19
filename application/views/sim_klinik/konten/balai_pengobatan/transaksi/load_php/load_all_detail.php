<script>
    // ketika memilih pasien yang dilayani
    $(document).on('change', '#xx', function(event) {
        var nilai_value = $('#xx').val();

        // kosongkan semua detail
        $('.kelas_row').remove();
        $('.angka_default').val("0");

        count_transaksi = 0;
        jumlah_detail_transaksi = 0;
        jumlah_detail_transaksi_ri_kamar = 0;

        // Fetch data
        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/get_transaksi_pasien'; ?>",
            type: 'post',
            data: {
                nilai: nilai_value
            },
            success: function(hasil) {

                // parse
                var obj = JSON.parse(hasil);

                // ambil data detail daftar_detail_tindakan_bp_transaksi
                let data_bp_tindakan = obj['daftar_detail_tindakan_bp_transaksi'];
                if (data_bp_tindakan != '') {

                    $.each(data_bp_tindakan, function(i, item) {

                        var no_bp_t = data_bp_tindakan[i].no_bp_t;
                        var nama = data_bp_tindakan[i].nama;
                        var qty = data_bp_tindakan[i].qty;
                        var harga_detail = data_bp_tindakan[i].harga_detail;

                        load_detail_bp_tindakan(no_bp_t, nama, qty, harga_detail);
                    });

                    update_sub_total_bp_tindakan();
                }

                cek_jumlah_data_detail_transaksi();
            }
        });
    });

    // start of fungsi untuk memanggil data

    function load_detail_bp_tindakan(no_bp_t, nama, qty, harga_detail) {

        $('#detail_list_bp_tindakan').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + `
                <input type="hidden" name="no_bp_t[]" class="form-control form-control-sm" id="no_bp_t` + count_transaksi + `" value="` + no_bp_t + `">
            </td>
            <td>
                <input type="text" name="qty_bp_tindakan[]" class="form-control form-control-sm cek_qty_bp_tindakan" id="qty_bp_tindakan` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
            </td>
            <td>
                <input type="text" name="harga_bp_tindakan[]" class="form-control form-control-sm rupiah text-right harga_bp_tindakan_update" id="harga_bp_tindakan` + count_transaksi + `" placeholder="Harga Tindakan BP" required value="` + harga_detail + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_bp_tindakan` + count_transaksi + `" readonly required value="` + harga_detail * qty + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_bp_tindakan">
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
    }

    // End of fungsi untuk memanggil data
</script>