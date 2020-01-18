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

                        var kode = data_pelayanan_ambulance[i].no_stok_obat_a;
                        var nama = data_pelayanan_ambulance[i].nama;
                        var harga_jual = data_pelayanan_ambulance[i].harga_jual;
                        var qty = data_pelayanan_ambulance[i].qty;
                        var qty_sekarang = data_pelayanan_ambulance[i].qty_sekarang;

                        pilihObat_apotek_jual(kode, nama, harga_jual, qty, qty_sekarang);
                    });
                }

                // ambil data detail daftar_penjualan_obat_apotek_detail
                let data_apotek_penjualan_obat = obj['daftar_penjualan_obat_apotek_detail'];
                if (data_apotek_penjualan_obat != '') {

                    $.each(data_apotek_penjualan_obat, function(i, item) {

                        var kode = data_apotek_penjualan_obat[i].no_stok_obat_a;
                        var nama = data_apotek_penjualan_obat[i].nama;
                        var harga_jual = data_apotek_penjualan_obat[i].harga_jual;
                        var qty = data_apotek_penjualan_obat[i].qty;
                        var qty_sekarang = data_apotek_penjualan_obat[i].qty_sekarang;

                        pilihObat_apotek_jual(kode, nama, harga_jual, qty, qty_sekarang);
                    });
                }

                // ambil data detail daftar_penjualan_obat_rawat_inap_detail
                let data_ri_penjualan_obat = obj['daftar_penjualan_obat_rawat_inap_detail'];
                if (data_ri_penjualan_obat != '') {

                    $.each(data_ri_penjualan_obat, function(i, item) {

                        var kode_obat = data_ri_penjualan_obat[i].no_stok_obat_rawat_i;
                        var nama_obat = data_ri_penjualan_obat[i].nama_obat;
                        var nama_kategori = data_ri_penjualan_obat[i].nama_kategori;
                        var qty = data_ri_penjualan_obat[i].qty;
                        var qty_sekarang = data_ri_penjualan_obat[i].qty_sekarang;
                        var harga_obat = data_ri_penjualan_obat[i].harga_jual;

                        pilihobat(kode_obat, nama_obat, nama_kategori, qty, qty_sekarang, harga_obat);
                    });
                }

                // ambil data detail daftar_detail_tindakan_rawat_inap
                let data_ri_tindakan = obj['daftar_detail_tindakan_rawat_inap'];
                if (data_ri_tindakan != '') {

                    $.each(data_ri_tindakan, function(i, item) {

                        var kode_tindakan = data_ri_tindakan[i].no_rawat_inap_t;
                        var nama_tindakan = data_ri_tindakan[i].nama;
                        var harga_tindakan = data_ri_tindakan[i].harga;

                        pilihtindakan(kode_tindakan, nama_tindakan, harga_tindakan);
                    });
                }

                // ambil data detail daftar_detail_kamar_rawat_inap
                let data_ri_kamar = obj['daftar_detail_kamar_rawat_inap'];
                if (data_ri_kamar != '') {

                    $.each(data_ri_kamar, function(i, item) {

                        var kode_kamar = data_ri_kamar[i].no_kamar_rawat_i;
                        var nama_kamar = data_ri_kamar[i].nama;
                        var harga_harian_kamar = data_ri_kamar[i].harga_harian;
                        var jumlah_hari = data_ri_kamar[i].jumlah_hari;
                        var tipe_kamar = data_ri_kamar[i].tipe;

                        pilihKamar(kode_kamar, nama_kamar, harga_harian_kamar, jumlah_hari, tipe_kamar);
                    });
                }

                // ambil data detail daftar_detail_tindakan_lab_transaksi
                let data_lab_tindakan = obj['daftar_detail_tindakan_lab_transaksi'];
                if (data_lab_tindakan != '') {

                    $.each(data_lab_tindakan, function(i, item) {

                        var kode = data_lab_tindakan[i].no_lab_c;
                        var nama = data_lab_tindakan[i].nama;
                        var harga = data_lab_tindakan[i].harga;

                        pilihTindakanLab(kode, nama, harga);
                    });
                }

                // ambil data detail daftar_detail_tindakan_bp_transaksi
                let data_bp_tindakan = obj['daftar_detail_tindakan_bp_transaksi'];
                if (data_bp_tindakan != '') {

                    $.each(data_bp_tindakan, function(i, item) {

                        var kode = data_bp_tindakan[i].no_bp_t;
                        var nama = data_bp_tindakan[i].nama;
                        var harga = data_bp_tindakan[i].harga;

                        pilihTindakanBp(kode, nama, harga);
                    });
                }

                // ambil data detail daftar_detail_tindakan_ugd_transaksi
                let data_ugd_tindakan = obj['daftar_detail_tindakan_ugd_transaksi'];
                if (data_ugd_tindakan != '') {

                    $.each(data_ugd_tindakan, function(i, item) {

                        var kode = data_ugd_tindakan[i].no_ugd_t;
                        var nama = data_ugd_tindakan[i].nama;
                        var harga = data_ugd_tindakan[i].harga;

                        pilihTindakanUgd(kode, nama, harga);
                    });
                }

                // ambil data detail daftar_detail_tindakan_kia_transaksi
                let data_kia_tindakan = obj['daftar_detail_tindakan_kia_transaksi'];
                if (data_kia_tindakan != '') {

                    $.each(data_kia_tindakan, function(i, item) {

                        var kode = data_kia_tindakan[i].no_kia_t;
                        var nama = data_kia_tindakan[i].nama;
                        var harga = data_kia_tindakan[i].harga;

                        pilihTindakanKia(kode, nama, harga);
                    });
                }

            }
        });
    });
</script>