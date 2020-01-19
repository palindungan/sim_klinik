<script>
    // ketika memilih pasien yang dilayani
    $(document).on('change', '#xx', function(event) {
        var nilai_value = $('#xx').val();

        // kosongkan semua detail
        $('.kelas_row').remove();

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

                // ambil data detail daftar_penjualan_obat_rawat_inap_detail
                let data_ri_penjualan_obat = obj['daftar_penjualan_obat_rawat_inap_detail'];
                if (data_ri_penjualan_obat != '') {

                    $.each(data_ri_penjualan_obat, function(i, item) {

                        var no_stok_obat_rawat_i = data_ri_penjualan_obat[i].no_stok_obat_rawat_i;
                        var nama_obat = data_ri_penjualan_obat[i].nama_obat;
                        var harga_jual = data_ri_penjualan_obat[i].harga_jual;
                        var qty = data_ri_penjualan_obat[i].qty;
                        var qty_sekarang = data_ri_penjualan_obat[i].qty_sekarang;

                        load_detail_ri_obat(no_stok_obat_rawat_i, nama_obat, harga_jual, qty, qty_sekarang);
                    });

                    update_sub_total_ri_obat();
                }

                // ambil data detail daftar_detail_tindakan_rawat_inap
                let data_ri_tindakan = obj['daftar_detail_tindakan_rawat_inap'];
                if (data_ri_tindakan != '') {

                    $.each(data_ri_tindakan, function(i, item) {

                        var no_rawat_inap_t = data_ri_tindakan[i].no_rawat_inap_t;
                        var nama = data_ri_tindakan[i].nama;
                        var qty = data_ri_tindakan[i].qty;
                        var harga = data_ri_tindakan[i].harga;

                        load_detail_ri_tindakan(no_rawat_inap_t, nama, qty, harga);
                    });

                    update_sub_total_ri_tindakan();
                }

                // ambil data detail daftar_detail_kamar_rawat_inap
                let data_ri_kamar = obj['daftar_detail_kamar_rawat_inap'];
                if (data_ri_kamar != '') {

                    $.each(data_ri_kamar, function(i, item) {

                        var no_kamar_rawat_i = data_ri_kamar[i].no_kamar_rawat_i;
                        var nama = data_ri_kamar[i].nama;
                        var tanggal_cek_in = data_ri_kamar[i].tanggal_cek_in;
                        var tanggal_cek_out = data_ri_kamar[i].tanggal_cek_out;
                        var status_kamar = data_ri_kamar[i].status_kamar;
                        var jumlah_hari = data_ri_kamar[i].jumlah_hari;
                        var harga_harian = data_ri_kamar[i].harga_harian;
                        var sub_total_harga = data_ri_kamar[i].sub_total_harga;
                        var tipe = data_ri_kamar[i].tipe;

                        load_detail_ri_kamar(no_kamar_rawat_i, nama, tanggal_cek_in, tanggal_cek_out, status_kamar, jumlah_hari, harga_harian, sub_total_harga, tipe);
                    });

                    update_sub_total_ri_kamar();
                }

                cek_jumlah_data_detail_transaksi();
            }
        });
    });

    // start of fungsi untuk memanggil data

    function load_detail_ri_obat(no_stok_obat_rawat_i, nama_obat, harga_jual, qty, qty_sekarang) {

        $('#detail_list_ri_obat').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama_obat + `
                <input type="hidden" name="no_stok_obat_rawat_i[]" class="form-control form-control-sm" id="no_stok_obat_rawat_i` + count_transaksi + `" value="` + no_stok_obat_rawat_i + `">
            </td>
            <td>
                <input type="text" name="qty_ri_obat[]" class="form-control form-control-sm cek_qty_ri_obat" id="qty_ri_obat` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
                <input readonly type="hidden" name="cek_qty_ri_obat[]" class="form-control form-control-sm" id="cek_qty_ri_obat` + count_transaksi + `" value="` + qty_sekarang + `">
            </td>
            <td>
                <input type="text" name="harga_ri_obat[]" class="form-control form-control-sm rupiah text-right harga_ri_obat_update" id="harga_ri_obat` + count_transaksi + `" placeholder="Harga Obat Apotek" required value="` + harga_jual + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ri_obat` + count_transaksi + `" readonly required value="` + harga_jual * qty + `"></td>
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
    }

    function load_detail_ri_tindakan(no_rawat_inap_t, nama, qty, harga) {

        $('#detail_list_ri_tindakan').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + `
                <input type="hidden" name="no_rawat_inap_t[]" class="form-control form-control-sm" id="no_rawat_inap_t` + count_transaksi + `" value="` + no_rawat_inap_t + `">
            </td>
            <td>
                <input type="text" name="qty_ri_tindakan[]" class="form-control form-control-sm cek_qty_ri_tindakan" id="qty_ri_tindakan` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
            </td>
            <td>
                <input type="text" name="harga_ri_tindakan[]" class="form-control form-control-sm rupiah text-right harga_ri_tindakan_update" id="harga_ri_tindakan` + count_transaksi + `" placeholder="Harga Tindakan RI" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ri_tindakan` + count_transaksi + `" readonly required value="` + harga * qty + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_ri_tindakan">
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

    function load_detail_ri_kamar(no_kamar_rawat_i, nama, tanggal_cek_in, tanggal_cek_out, status_kamar, jumlah_hari, harga_harian, sub_total_harga, tipe) {

        var hidden_btn = '';
        var hidden_tgl_cek_out = '';

        if (status_kamar == "Sudah Cek Out") {
            hidden_btn = 'display: none';
        } else {
            hidden_tgl_cek_out = 'display: none';
        }

        $('#detail_list_ri_kamar').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + ` (` + tipe + `)
                <input type="hidden" name="no_kamar_rawat_i[]" class="form-control form-control-sm" id="no_kamar_rawat_i` + count_transaksi + `" value="` + no_kamar_rawat_i + `">
            </td>
            <td>  
                <input readonly type="text" name="tanggal_cek_in_ri_kamar[]" class="form-control form-control-sm text-right" id="tanggal_cek_in_ri_kamar` + count_transaksi + `" required value="` + tanggal_cek_in + `">
            </td>
            <td>
                <span style="` + hidden_btn + `" id="label_cek_out` + count_transaksi + `" class="text">(Belum) - </span>
                <a style="` + hidden_btn + `" href="#" id="btn_check_out` + count_transaksi + `" class="btn btn-sm btn-danger btn-icon-split btn_check_out">
                    <span class="text">Check Out</span>
                </a>
                <input style="` + hidden_tgl_cek_out + `" readonly type="text" name="tanggal_cek_out_ri_kamar[]" class="form-control form-control-sm text-right" id="tanggal_cek_out_ri_kamar` + count_transaksi + `" required value="` + tanggal_cek_out + `">
            </td>
            <td>  
                <input readonly maxlength="3" type="text" name="jumlah_hari_ri_kamar[]" class="cek_jumlah_hari_ri_kamar form-control form-control-sm text-right" id="jumlah_hari_ri_kamar` + count_transaksi + `" placeholder="@Hari" required value="` + jumlah_hari + `">
            </td>
            <td>
                <input type="text" name="harga_harian_ri_kamar[]" class="form-control form-control-sm rupiah text-right harga_harian_ri_kamar_update" id="harga_harian_ri_kamar` + count_transaksi + `" placeholder="Harga RI Kamar" required value="` + harga_harian + `">
                <input type="hidden" name="status_kamar_ri_kamar[]" class="form-control form-control-sm text-right" id="status_kamar_ri_kamar` + count_transaksi + `" required value="` + status_kamar + `">
            </td>
            <td>    
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ri_kamar` + count_transaksi + `" readonly required value="` + sub_total_harga + `"></td></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_ri_kamar">
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
        jumlah_detail_transaksi_ri_kamar = jumlah_detail_transaksi_ri_kamar + 1;
    }

    // End of fungsi untuk memanggil data
</script>