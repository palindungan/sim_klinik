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

                // ambil data detail daftar_penjualan_obat_apotek_detail
                let data_apotek_penjualan_obat = obj['daftar_penjualan_obat_apotek_detail'];
                if (data_apotek_penjualan_obat != '') {

                    $.each(data_apotek_penjualan_obat, function(i, item) {

                        var kode_obat = data_apotek_penjualan_obat[i].kode_obat;
                        var nama = data_apotek_penjualan_obat[i].nama;
                        var harga_jual = data_apotek_penjualan_obat[i].harga_jual;
                        var qty = data_apotek_penjualan_obat[i].qty;
                        var qty_sekarang = data_apotek_penjualan_obat[i].qty_sekarang;
                        var status_paket = data_apotek_penjualan_obat[i].status_paket;
                        var harga_lama = data_apotek_penjualan_obat[i].harga_lama;

                        load_detail_apotek_obat(kode_obat, nama, harga_jual, qty, qty_sekarang, status_paket, harga_lama);
                    });

                    update_sub_total_apotek_obat();
                }

                // ambil data detail daftar_detail_pelayanan_ambulan 
                var grand_total_ambulance = 0;

                let data_pelayanan_ambulance = obj['daftar_detail_pelayanan_ambulan'];
                if (data_pelayanan_ambulance != '') {

                    $.each(data_pelayanan_ambulance, function(i, item) {

                        var harga = data_pelayanan_ambulance[i].harga;

                        grand_total_ambulance = grand_total_ambulance + harga;

                    });
                }

                // ambil data detail daftar_detail_kamar_rawat_inap
                var grand_total_rawat_inap_kamar = 0;

                let data_ri_kamar = obj['daftar_detail_kamar_rawat_inap'];
                if (data_ri_kamar != '') {

                    $.each(data_ri_kamar, function(i, item) {

                        var sub_total_harga = data_ri_kamar[i].sub_total_harga;

                        grand_total_rawat_inap_kamar = grand_total_rawat_inap_kamar + sub_total_harga;

                    });
                }

                // ambil data detail daftar_penjualan_obat_rawat_inap_detail
                var grand_total_rawat_inap_obat = 0;

                let data_ri_penjualan_obat = obj['daftar_penjualan_obat_rawat_inap_detail'];
                if (data_ri_penjualan_obat != '') {

                    $.each(data_ri_penjualan_obat, function(i, item) {

                        var harga_jual = data_ri_penjualan_obat[i].harga_jual;
                        var qty = data_ri_penjualan_obat[i].qty;

                        var sub_total_rawat_inap_obat = harga_jual * qty;

                        grand_total_rawat_inap_obat = grand_total_rawat_inap_obat + sub_total_rawat_inap_obat;

                    });
                }

                // ambil data detail daftar_detail_tindakan_rawat_inap
                var grand_total_rawat_inap_tindakan = 0;

                let data_ri_tindakan = obj['daftar_detail_tindakan_rawat_inap'];
                if (data_ri_tindakan != '') {

                    $.each(data_ri_tindakan, function(i, item) {

                        var qty = data_ri_tindakan[i].qty;
                        var harga = data_ri_tindakan[i].harga;

                        var sub_total_rawat_inap_tindakan = harga * qty;

                        grand_total_rawat_inap_tindakan = grand_total_rawat_inap_tindakan + sub_total_rawat_inap_tindakan;

                    });

                }

                // ambil data detail daftar_detail_tindakan_bp_transaksi
                var grand_total_tindakan_bp = 0;

                let data_bp_tindakan = obj['daftar_detail_tindakan_bp_transaksi'];
                if (data_bp_tindakan != '') {

                    $.each(data_bp_tindakan, function(i, item) {

                        var qty = data_bp_tindakan[i].qty;
                        var harga_detail = data_bp_tindakan[i].harga_detail;

                        var sub_total_tindakan_bp = harga_detail * qty;

                        grand_total_tindakan_bp = grand_total_tindakan_bp + sub_total_tindakan_bp;


                    });
                }

                // ambil data detail daftar_detail_tindakan_kia_transaksi
                var grand_total_tindakan_kia = 0;

                let data_kia_tindakan = obj['daftar_detail_tindakan_kia_transaksi'];
                if (data_kia_tindakan != '') {

                    $.each(data_kia_tindakan, function(i, item) {

                        var qty = data_kia_tindakan[i].qty;
                        var harga = data_kia_tindakan[i].harga;

                        var sub_total_tindakan_kia = harga * qty;

                        grand_total_tindakan_kia = grand_total_tindakan_kia + sub_total_tindakan_kia;

                    });
                }

                // ambil data detail daftar_detail_tindakan_lab_transaksi
                var grand_total_tindakan_lab = 0;

                let data_lab_tindakan = obj['daftar_detail_tindakan_lab_transaksi'];
                if (data_lab_tindakan != '') {

                    $.each(data_lab_tindakan, function(i, item) {

                        var qty = data_lab_tindakan[i].qty;
                        var harga = data_lab_tindakan[i].harga;

                        var sub_total_tindakan_lab = harga * qty;

                        grand_total_tindakan_lab = grand_total_tindakan_lab + sub_total_tindakan_lab;
                    });
                }

                // ambil data detail daftar_detail_tindakan_ugd_transaksi
                var grand_total_tindakan_ugd = 0;

                let data_ugd_tindakan = obj['daftar_detail_tindakan_ugd_transaksi'];
                if (data_ugd_tindakan != '') {

                    $.each(data_ugd_tindakan, function(i, item) {

                        var qty = data_ugd_tindakan[i].qty;
                        var harga = data_ugd_tindakan[i].harga;

                        var sub_total_tindakan_ugd = harga * qty;

                        grand_total_tindakan_ugd = grand_total_tindakan_ugd + sub_total_tindakan_ugd;
                    });
                }

                // ambil data detail daftar_detail_transaksi_lain 
                var grand_total_lain = 0;

                let data_lain = obj['daftar_detail_transaksi_lain'];
                if (data_lain != '') {

                    $.each(data_lain, function(i, item) {

                        var qty = data_lain[i].qty;
                        var harga = data_lain[i].harga;

                        var sub_total_lain = harga * qty;

                        grand_total_lain = grand_total_lain + sub_total_lain;
                    });
                }

                var total_akhir = parseInt(grand_total_ambulance) + parseInt(grand_total_rawat_inap_kamar) + parseInt(grand_total_rawat_inap_obat) + parseInt(grand_total_rawat_inap_tindakan) + parseInt(grand_total_tindakan_bp) + parseInt(grand_total_tindakan_kia) + parseInt(grand_total_tindakan_lab) + parseInt(grand_total_tindakan_ugd) + parseInt(grand_total_lain); // grand_total_lainnya

                $('#grand_total_lainnya').val(total_akhir);
                $('#grand_total_lainnya').trigger('input'); // Will be display 

                cek_jumlah_data_detail_transaksi();
            }
        });
    });

    // start of fungsi untuk memanggil data

    function load_detail_apotek_obat(kode_obat, nama, harga_jual, qty, qty_sekarang, status_paket, harga_lama) {

        var status = "";
        if (status_paket == "Ya") {
            status = "checked";
        }

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
                        <input type="checkbox" name="status_paket_apotek_obat_cb[]" class="col-md-1 icon deteksi_cek_box form-control form-control-sm" id="status_paket_apotek_obat_cb` + count_transaksi + `" ` + status + `>
                        <input type="hidden" name="status_paket_apotek_obat[]" class="col-md-1 icon form-control form-control-sm" id="status_paket_apotek_obat` + count_transaksi + `" value="` + status_paket + `">
                        <input type="text" name="harga_apotek_obat[]" class="col-md-11 form-control form-control-sm rupiah text-right harga_apotek_obat_update" id="harga_apotek_obat` + count_transaksi + `" placeholder="Harga Obat Apotek" required value="` + harga_jual + `">
                        <input type="hidden" name="harga_obat_lama[]" class="col-md-1 icon form-control form-control-sm" id="harga_obat_lama` + count_transaksi + `" value="` + harga_lama + `">
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