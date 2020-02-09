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

                // ambil data detail daftar_detail_pelayanan_ambulan 
                let data_pelayanan_ambulance = obj['daftar_detail_pelayanan_ambulan'];
                if (data_pelayanan_ambulance != '') {

                    $.each(data_pelayanan_ambulance, function(i, item) {

                        var no_ambulance = data_pelayanan_ambulance[i].no_ambulance;
                        var tujuan = data_pelayanan_ambulance[i].tujuan;
                        var harga = data_pelayanan_ambulance[i].harga;

                        load_detail_ambulance(no_ambulance, tujuan, harga);
                    });

                    update_sub_total_ambulance();
                }

                // ambil data detail daftar_penjualan_obat_apotek_detail
                let data_apotek_penjualan_obat = obj['daftar_penjualan_obat_apotek_detail'];
                if (data_apotek_penjualan_obat != '') {

                    $.each(data_apotek_penjualan_obat, function(i, item) {

                        var no_stok_obat_a = data_apotek_penjualan_obat[i].no_stok_obat_a;
                        var nama = data_apotek_penjualan_obat[i].nama;
                        var harga_jual = data_apotek_penjualan_obat[i].harga_jual;
                        var qty = data_apotek_penjualan_obat[i].qty;
                        var qty_sekarang = data_apotek_penjualan_obat[i].qty_sekarang;
                        var status_paket = data_apotek_penjualan_obat[i].status_paket;
                        var harga_lama = data_apotek_penjualan_obat[i].harga_lama;

                        load_detail_apotek_obat(no_stok_obat_a, nama, harga_jual, qty, qty_sekarang, status_paket, harga_lama);
                    });

                    update_sub_total_apotek_obat();
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
                        var harga_lama = data_ri_penjualan_obat[i].harga_lama;

                        load_detail_ri_obat(no_stok_obat_rawat_i, nama_obat, harga_jual, qty, qty_sekarang, harga_lama);
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

                // ambil data detail daftar_detail_tindakan_lab_transaksi
                let data_lab_tindakan = obj['daftar_detail_tindakan_lab_transaksi'];
                if (data_lab_tindakan != '') {

                    $.each(data_lab_tindakan, function(i, item) {

                        var no_lab_c = data_lab_tindakan[i].no_lab_c;
                        var nama = data_lab_tindakan[i].nama;
                        var qty = data_lab_tindakan[i].qty;
                        var harga = data_lab_tindakan[i].harga;

                        load_detail_lab_tindakan(no_lab_c, nama, qty, harga);
                    });

                    update_sub_total_lab_tindakan();
                }

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

                // ambil data detail daftar_detail_tindakan_ugd_transaksi
                let data_ugd_tindakan = obj['daftar_detail_tindakan_ugd_transaksi'];
                if (data_ugd_tindakan != '') {

                    $.each(data_ugd_tindakan, function(i, item) {

                        var no_ugd_t = data_ugd_tindakan[i].no_ugd_t;
                        var nama = data_ugd_tindakan[i].nama;
                        var qty = data_ugd_tindakan[i].qty;
                        var harga = data_ugd_tindakan[i].harga;

                        load_detail_ugd_tindakan(no_ugd_t, nama, qty, harga);
                    });

                    update_sub_total_ugd_tindakan();
                }

                // ambil data detail daftar_detail_tindakan_kia_transaksi
                let data_kia_tindakan = obj['daftar_detail_tindakan_kia_transaksi'];
                if (data_kia_tindakan != '') {

                    $.each(data_kia_tindakan, function(i, item) {

                        var no_kia_t = data_kia_tindakan[i].no_kia_t;
                        var nama = data_kia_tindakan[i].nama;
                        var qty = data_kia_tindakan[i].qty;
                        var harga = data_kia_tindakan[i].harga;

                        load_detail_kia_tindakan(no_kia_t, nama, qty, harga);
                    });

                    update_sub_total_kia_tindakan();
                }

                // ambil data detail daftar_detail_transaksi_lain 
                let data_lain = obj['daftar_detail_transaksi_lain'];
                if (data_lain != '') {

                    $.each(data_lain, function(i, item) {

                        var no_lain = data_lain[i].no_lain;
                        var nama = data_lain[i].nama;
                        var qty = data_lain[i].qty;
                        var harga = data_lain[i].harga;

                        load_detail_lain(no_lain, nama, qty, harga);
                    });

                    update_sub_total_lain();
                }

                cek_jumlah_data_detail_transaksi();
            }
        });
    });

    // start of fungsi untuk memanggil data

    function load_detail_ambulance(no_ambulance, tujuan, harga) {

        $('#detail_list_ambulance').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + tujuan + ` (Ambulance)
                <input type="hidden" name="no_ambulance[]" class="form-control form-control-sm" id="no_ambulance` + count_transaksi + `" value="` + no_ambulance + `">
            </td>
            <td>
                <input type="text" name="qty_ambulance[]" class="form-control form-control-sm" id="qty_ambulance` + count_transaksi + `" placeholder="QTY" value="1" readonly required>
            </td>
            <td>
                <input type="text" name="harga_ambulance[]" class="form-control form-control-sm rupiah text-right harga_ambulance_update" id="harga_ambulance` + count_transaksi + `" placeholder="Harga Ambulance" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ambulance` + count_transaksi + `" readonly required value="` + harga + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_ambulance">
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

    function load_detail_apotek_obat(no_stok_obat_a, nama, harga_jual, qty, qty_sekarang, status_paket, harga_lama) {

        var status = "";
        if (status_paket == "Ya") {
            status = "checked";
        }

        $('#detail_list_apotek_obat').append(`

            <tr id="row` + count_transaksi + `" class="kelas_row">
                <td>
                    ` + nama + `
                    <input type="hidden" name="no_stok_obat_a[]" class="form-control form-control-sm" id="no_stok_obat_a` + count_transaksi + `" value="` + no_stok_obat_a + `">
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

    function load_detail_ri_obat(no_stok_obat_rawat_i, nama_obat, harga_jual, qty, qty_sekarang, harga_lama) {

        var status = "";
        if (harga_jual == "0") {
            status = "checked";
        }

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
                <div class="btn-icon-split col-12">
                    <input ` + status + ` type="checkbox" name="status_paket_ri_obat_cb[]" class="col-md-1 icon deteksi_cek_box_ri form-control form-control-sm" id="status_paket_ri_obat_cb` + count_transaksi + `" >
                    <input type="hidden" name="status_paket_ri_obat[]" class="col-md-1 icon form-control form-control-sm" id="status_paket_ri_obat` + count_transaksi + `" value="Tidak">
                    <input type="text" name="harga_ri_obat[]" class="col-md-11 form-control form-control-sm rupiah text-right harga_ri_obat_update" id="harga_ri_obat` + count_transaksi + `" placeholder="Harga Obat Rawat Inap" required value="` + harga_jual + `">
                    <input type="hidden" name="harga_ri_obat_lama[]" class="col-md-1 icon form-control form-control-sm" id="harga_ri_obat_lama` + count_transaksi + `" value="` + harga_lama + `">
                </div>
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

    function load_detail_lab_tindakan(kode, nama, qty, harga) {

        $('#detail_list_lab_tindakan').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + `
                <input type="hidden" name="no_lab_c[]" class="form-control form-control-sm" id="no_lab_c` + count_transaksi + `" value="` + kode + `">
            </td>
            <td>
                <input type="text" name="qty_lab_tindakan[]" class="form-control form-control-sm cek_qty_lab_tindakan" id="qty_lab_tindakan` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
            </td>
            <td>
                <input type="text" name="harga_lab_tindakan[]" class="form-control form-control-sm rupiah text-right harga_lab_tindakan_update" id="harga_lab_tindakan` + count_transaksi + `" placeholder="Harga Tindakan LAB" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_lab_tindakan` + count_transaksi + `" readonly required value="` + harga * qty + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_lab_tindakan">
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

    function load_detail_ugd_tindakan(no_ugd_t, nama, qty, harga) {

        $('#detail_list_ugd_tindakan').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + `
                <input type="hidden" name="no_ugd_t[]" class="form-control form-control-sm" id="no_ugd_t` + count_transaksi + `" value="` + no_ugd_t + `">
            </td>
            <td>
                <input type="text" name="qty_ugd_tindakan[]" class="form-control form-control-sm cek_qty_ugd_tindakan" id="qty_ugd_tindakan` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
            </td>
            <td>
                <input type="text" name="harga_ugd_tindakan[]" class="form-control form-control-sm rupiah text-right harga_ugd_tindakan_update" id="harga_ugd_tindakan` + count_transaksi + `" placeholder="Harga Tindakan UGD" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ugd_tindakan` + count_transaksi + `" readonly required value="` + harga * qty + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_ugd_tindakan">
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

    function load_detail_kia_tindakan(no_kia_t, nama, qty, harga) {

        $('#detail_list_kia_tindakan').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + `
                <input type="hidden" name="no_kia_t[]" class="form-control form-control-sm" id="no_kia_t` + count_transaksi + `" value="` + no_kia_t + `">
            </td>
            <td>
                <input type="text" name="qty_kia_tindakan[]" class="form-control form-control-sm cek_qty_kia_tindakan" id="qty_kia_tindakan` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
            </td>
            <td>
                <input type="text" name="harga_kia_tindakan[]" class="form-control form-control-sm rupiah text-right harga_kia_tindakan_update" id="harga_kia_tindakan` + count_transaksi + `" placeholder="Harga Tindakan KIA" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_kia_tindakan` + count_transaksi + `" readonly required value="` + harga * qty + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_kia_tindakan">
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

    function load_detail_lain(kode, nama, qty, harga) {

        $('#detail_list_lain').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                <input type="text" name="nama_lain[]" class="form-control form-control-sm" id="nama_lain` + count_transaksi + `" placeholder="nama lain" required value="` + nama + `">
                <input type="hidden" name="no_lain[]" class="form-control form-control-sm" id="no_lain` + count_transaksi + `" value="` + kode + `">
            </td>
            <td>
                <input type="text" name="qty_lain[]" class="form-control form-control-sm cek_qty_lain" id="qty_lain` + count_transaksi + `" placeholder="QTY" value="` + qty + `" required>
            </td>
            <td>
                <input type="text" name="harga_lain[]" class="form-control form-control-sm rupiah text-right harga_lain_update" id="harga_lain` + count_transaksi + `" placeholder="Harga lain" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_lain` + count_transaksi + `" readonly required value="` + harga * qty + `"></td>
            <td>
                <div class="form-group col-sm-2">
                    <a id="` + count_transaksi + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_lain">
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