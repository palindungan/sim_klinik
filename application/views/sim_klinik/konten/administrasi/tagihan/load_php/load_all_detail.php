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

                // ambil data detail daftar_detail_pelayanan_ambulan 
                let data_pelayanan_ambulance = obj['daftar_detail_pelayanan_ambulan'];
                if (data_pelayanan_ambulance != '') {

                    $.each(data_pelayanan_ambulance, function(i, item) {

                        var no_ambulance = data_pelayanan_ambulance[i].no_ambulance;
                        var tujuan = data_pelayanan_ambulance[i].tujuan;
                        var harga = data_pelayanan_ambulance[i].harga;

                        // load_detail_ambulance(no_ambulance, tujuan, harga)
                    });
                }

                // ambil data detail daftar_penjualan_obat_apotek_detail
                let data_apotek_penjualan_obat = obj['daftar_penjualan_obat_apotek_detail'];
                if (data_apotek_penjualan_obat != '') {

                    $.each(data_apotek_penjualan_obat, function(i, item) {

                        var kode_obat = data_apotek_penjualan_obat[i].kode_obat;
                        var nama = data_apotek_penjualan_obat[i].nama;
                        var harga_jual = data_apotek_penjualan_obat[i].harga_jual;
                        var qty = data_apotek_penjualan_obat[i].qty;
                        var qty_sekarang = data_apotek_penjualan_obat[i].qty_sekarang;

                        //  load_detail_apotek_obat(kode_obat, nama, harga_jual, qty , qty_sekarang) 
                    });
                }

                // ambil data detail daftar_penjualan_obat_rawat_inap_detail
                let data_ri_penjualan_obat = obj['daftar_penjualan_obat_rawat_inap_detail'];
                if (data_ri_penjualan_obat != '') {

                    $.each(data_ri_penjualan_obat, function(i, item) {

                        var no_stok_obat_rawat_i = data_ri_penjualan_obat[i].no_stok_obat_rawat_i;
                        var nama_obat = data_ri_penjualan_obat[i].nama_obat;
                        var harga_jual = data_ri_penjualan_obat[i].harga_jual;
                        var qty = data_ri_penjualan_obat[i].qty;
                        var qty_sekarang = data_ri_penjualan_obat[i].qty_sekarang;

                        //  load_detail_ri_obat(no_stok_obat_rawat_i, nama_obat, harga_jual, qty , qty_sekarang)
                    });
                }

                // ambil data detail daftar_detail_tindakan_rawat_inap
                let data_ri_tindakan = obj['daftar_detail_tindakan_rawat_inap'];
                if (data_ri_tindakan != '') {

                    $.each(data_ri_tindakan, function(i, item) {

                        var no_rawat_inap_t = data_ri_tindakan[i].no_rawat_inap_t;
                        var nama = data_ri_tindakan[i].nama;
                        var harga = data_ri_tindakan[i].harga;

                        // load_detail_ri_tindakan(no_rawat_inap_t, nama, harga)
                    });
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

                        // load_detail_ri_kamar(no_kamar_rawat_i , nama , tanggal_cek_in , tanggal_cek_out , status_kamar , jumlah_hari , harga_harian , sub_total_harga , tipe)
                    });
                }

                // ambil data detail daftar_detail_tindakan_lab_transaksi
                let data_lab_tindakan = obj['daftar_detail_tindakan_lab_transaksi'];
                if (data_lab_tindakan != '') {

                    $.each(data_lab_tindakan, function(i, item) {

                        var no_lab_c = data_lab_tindakan[i].no_lab_c;
                        var nama = data_lab_tindakan[i].nama;
                        var harga = data_lab_tindakan[i].harga;

                        // load_detail_lab_tindakan(no_lab_c, nama, harga)
                    });
                }

                // ambil data detail daftar_detail_tindakan_bp_transaksi
                let data_bp_tindakan = obj['daftar_detail_tindakan_bp_transaksi'];
                if (data_bp_tindakan != '') {

                    $.each(data_bp_tindakan, function(i, item) {

                        var no_bp_t = data_bp_tindakan[i].no_bp_t;
                        var nama = data_bp_tindakan[i].nama;
                        var harga_detail = data_bp_tindakan[i].harga_detail;

                        // load_detail_bp_tindakan(no_bp_t, nama, harga_detail)
                    });
                }

                // ambil data detail daftar_detail_tindakan_ugd_transaksi
                let data_ugd_tindakan = obj['daftar_detail_tindakan_ugd_transaksi'];
                if (data_ugd_tindakan != '') {

                    $.each(data_ugd_tindakan, function(i, item) {

                        var no_ugd_t = data_ugd_tindakan[i].no_ugd_t;
                        var nama = data_ugd_tindakan[i].nama;
                        var harga = data_ugd_tindakan[i].harga;

                        // load_detail_ugd_tindakan(no_ugd_t, nama, harga)
                    });
                }

                // ambil data detail daftar_detail_tindakan_kia_transaksi
                let data_kia_tindakan = obj['daftar_detail_tindakan_kia_transaksi'];
                if (data_kia_tindakan != '') {

                    $.each(data_kia_tindakan, function(i, item) {

                        var no_kia_t = data_kia_tindakan[i].no_kia_t;
                        var nama = data_kia_tindakan[i].nama;
                        var harga = data_kia_tindakan[i].harga;

                        // load_detail_kia_tindakan(no_kia_t, nama, harga)
                    });
                }

            }
        });
    });

    // start of fungsi untuk memanggil data
</script>