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

                // ambil data detail transaksi penjualan obat apotek
                let data_penjualan_apotek = obj['daftar_penjualan_obat_apotek_detail'];
                if (data_penjualan_apotek != '') {

                    $.each(data_penjualan_apotek, function(i, item) {

                        var kode = data_penjualan_apotek[i].no_stok_obat_a;
                        var nama = data_penjualan_apotek[i].nama;
                        var harga_jual = data_penjualan_apotek[i].harga_jual;
                        var qty = data_penjualan_apotek[i].qty;
                        var qty_sekarang = data_penjualan_apotek[i].qty_sekarang;

                        pilihObat_apotek_jual(kode, nama, harga_jual, qty, qty_sekarang);
                    });
                }

                // ambil data detail transaksi penjualan obat rawat inap
                let data_penjualan_rawat_inap = obj['daftar_penjualan_obat_rawat_inap_detail'];
                if (data_penjualan_rawat_inap != '') {

                    $.each(data_penjualan_rawat_inap, function(i, item) {

                        var kode_obat = data_penjualan_rawat_inap[i].no_stok_obat_rawat_i;
                        var nama_obat = data_penjualan_rawat_inap[i].nama_obat;
                        var nama_kategori = data_penjualan_rawat_inap[i].nama_kategori;
                        var qty = data_penjualan_rawat_inap[i].qty;
                        var qty_sekarang = data_penjualan_rawat_inap[i].qty_sekarang;
                        var harga_obat = data_penjualan_rawat_inap[i].harga_jual;

                        pilihobat(kode_obat, nama_obat, nama_kategori, qty, qty_sekarang, harga_obat);
                    });
                }

                // ambil data detail transaksi tindakan rawat inap
                let data_detail_tindakan_rawat_inap = obj['daftar_detail_tindakan_rawat_inap'];
                if (data_detail_tindakan_rawat_inap != '') {

                    $.each(data_detail_tindakan_rawat_inap, function(i, item) {

                        var kode_tindakan = data_detail_tindakan_rawat_inap[i].no_rawat_inap_t;
                        var nama_tindakan = data_detail_tindakan_rawat_inap[i].nama;
                        var harga_tindakan = data_detail_tindakan_rawat_inap[i].harga;

                        pilihtindakan(kode_tindakan, nama_tindakan, harga_tindakan);
                    });
                }

                // ambil data detail transaksi kamar rawat inap
                let data_detail_kamar_rawat_inap = obj['daftar_detail_kamar_rawat_inap'];
                if (data_detail_kamar_rawat_inap != '') {

                    $.each(data_detail_kamar_rawat_inap, function(i, item) {

                        var kode_kamar = data_detail_kamar_rawat_inap[i].no_kamar_rawat_i;
                        var nama_kamar = data_detail_kamar_rawat_inap[i].nama;
                        var harga_harian_kamar = data_detail_kamar_rawat_inap[i].harga_harian;
                        var jumlah_hari = data_detail_kamar_rawat_inap[i].jumlah_hari;
                        var tipe_kamar = data_detail_kamar_rawat_inap[i].tipe;

                        pilihKamar(kode_kamar, nama_kamar, harga_harian_kamar, jumlah_hari, tipe_kamar);
                    });
                }

                // ambil data detail transaksi tindakan laboratorium
                let data_detail_tindakan_lab = obj['daftar_detail_tindakan_lab'];
                if (data_detail_tindakan_lab != '') {

                    $.each(data_detail_tindakan_lab, function(i, item) {

                        var kode = data_detail_tindakan_lab[i].no_lab_c;
                        var nama = data_detail_tindakan_lab[i].nama;
                        var harga = data_detail_tindakan_lab[i].harga;

                        pilihTindakanLab(kode, nama, harga);
                    });
                }

                // ambil data detail transaksi tindakan bp
                let data_detail_tindakan_bp = obj['daftar_detail_tindakan_bp'];
                if (data_detail_tindakan_bp != '') {

                    $.each(data_detail_tindakan_bp, function(i, item) {

                        var kode = data_detail_tindakan_bp[i].no_bp_t;
                        var nama = data_detail_tindakan_bp[i].nama;
                        var harga = data_detail_tindakan_bp[i].harga;

                        pilihTindakanBp(kode, nama, harga);
                    });
                }

                // ambil data detail transaksi tindakan ugd
                let data_detail_tindakan_ugd = obj['daftar_detail_tindakan_ugd'];
                if (data_detail_tindakan_ugd != '') {

                    $.each(data_detail_tindakan_ugd, function(i, item) {

                        var kode = data_detail_tindakan_ugd[i].no_ugd_t;
                        var nama = data_detail_tindakan_ugd[i].nama;
                        var harga = data_detail_tindakan_ugd[i].harga;

                        pilihTindakanUgd(kode, nama, harga);
                    });
                }

                // ambil data detail transaksi tindakan kia
                let data_detail_tindakan_kia = obj['daftar_detail_tindakan_kia'];
                if (data_detail_tindakan_kia != '') {

                    $.each(data_detail_tindakan_kia, function(i, item) {

                        var kode = data_detail_tindakan_kia[i].no_kia_t;
                        var nama = data_detail_tindakan_kia[i].nama;
                        var harga = data_detail_tindakan_kia[i].harga;

                        pilihTindakanKia(kode, nama, harga);
                    });
                }

            }
        });
    });
</script>