<script>
    // ketika memilih pasien yang dilayani
    $(document).on('change', '#xx', function(event) {
        var nilai_value = $('#xx').val();

        // kosongkan semua detail
        $('.kelas_row').remove();
        $('.angka_default').val("0");

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

                // ambil data detail daftar_penjualan_obat_apotek_detail
                let data_apotek_penjualan_obat = obj['daftar_penjualan_obat_apotek_detail'];
                if (data_apotek_penjualan_obat != '') {

                    $.each(data_apotek_penjualan_obat, function(i, item) {

                        var kode_obat = data_apotek_penjualan_obat[i].kode_obat;
                        var nama = data_apotek_penjualan_obat[i].nama;
                        var harga_jual = data_apotek_penjualan_obat[i].harga_jual;
                        var qty = data_apotek_penjualan_obat[i].qty;
                        var qty_sekarang = data_apotek_penjualan_obat[i].qty_sekarang;

                        load_detail_apotek_obat(kode_obat, nama, harga_jual, qty, qty_sekarang);
                    });

                    update_sub_total_apotek_obat();
                }

                cek_jumlah_data_detail_transaksi();
            }
        });
    });

    // start of fungsi untuk memanggil data

    function load_detail_apotek_obat(kode_obat, nama, harga_jual, qty, qty_sekarang) {

        $('#detail_list_apotek_obat').append(`

            <tr id="row` + count_transaksi + `" class="kelas_row">
                <td>
                    ` + nama + `
                    <input type="hidden" name="kode_obat[]" class="form-control form-control-sm" id="kode_obat` + count_transaksi + `" value="` + kode_obat + `">
                </td>
                <td>
                    <input type="text" name="qty_apotek_obat[]" class="form-control form-control-sm cek_qty_apotek_obat" id="qty_apotek_obat` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
                    <input readonly type="hidden" name="cek_qty_apotek_obat[]" class="form-control form-control-sm" id="cek_qty_apotek_obat` + count_transaksi + `" value="` + qty_sekarang + `">
                </td>
                <td>
                    <div class="btn-icon-split col-12">
                        <input type="checkbox" name="status_paket_apotek_obat[]" class="col-md-1 icon deteksi_cek_box form-control form-control-sm" id="status_paket_apotek_obat` + count_transaksi + `" value="Ya">
                        <input type="text" name="harga_apotek_obat[]" class="col-md-11 form-control form-control-sm rupiah text-right harga_apotek_obat_update" id="harga_apotek_obat` + count_transaksi + `" placeholder="Harga Obat Apotek" required value="` + harga_jual + `">
                    </div>
                    <input type="hidden" class="form-control form-control-sm rupiah text-right" id="harga_cadangan_apotek_obat` + count_transaksi + `" readonly required value="` + harga_jual + `">
                </td>
                <td>  
                    <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_apotek_obat` + count_transaksi + `" readonly required value="` + harga_jual * qty + `">
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
    }

    // End of fungsi untuk memanggil data
</script>