<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_ri_kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Rawat Inap - Kamar</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table_ri_kamar" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kamar</th>
                                <th>Tipe</th>
                                <th>Harga Harian</th>
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
    $('#btn_search_ri_kamar').on('click', function() {
        search_proses_ri_kamar();
    });

    // Start pencarian
    function search_proses_ri_kamar() {

        var table;
        table = $('#table_ri_kamar').DataTable({
            "columnDefs": [{
                    "targets": 3,
                    "className": "text-right"
                }, {
                    "targets": 4,
                    "className": "text-center"
                }

            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_kamar'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var no_kamar_rawat_i = data[i].no_kamar_rawat_i;
                        var nama = data[i].nama;
                        var harga_harian = data[i].harga_harian;
                        var tipe = data[i].tipe;

                        var reverse = harga_harian.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="tambah_detail_ri_kamar('` + no_kamar_rawat_i +
                            `','` + nama + `','` + harga_harian + `','` + tipe +
                            `')" id="` + no_kamar_rawat_i +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama, tipe, ribuan, button]);

                        no = no + 1;
                    });
                }
                table.draw();

            }
        });
    }

    // Start add_row no_kamar_rawat_i, nama, harga_harian, tipe
    function tambah_detail_ri_kamar(no_kamar_rawat_i, nama, harga_harian, tipe) {

        $('#detail_list_ri_kamar').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + `
                <input type="hidden" name="no_kamar_rawat_i[]" class="form-control form-control-sm" id="no_kamar_rawat_i` + count_transaksi + `" value="` + no_kamar_rawat_i + `">
            </td>
            <td>  
                <input readonly type="text" name="tanggal_cek_in_ri_kamar[]" class="form-control form-control-sm text-right" id="tanggal_cek_in_ri_kamar` + count_transaksi + `" required value="` + moment().format('YYYY-MM-DD HH:mm:ss') + `">
            </td>
            <td>
                <span id="label_cek_out` + count_transaksi + `" class="text">(Belum) - </span>
                <a href="#" id="btn_check_out` + count_transaksi + `" class="btn btn-sm btn-danger btn-icon-split btn_check_out">
                    <span class="text">Check Out</span>
                </a>
                <input style="display: none" readonly type="text" name="tanggal_cek_out_ri_kamar[]" class="form-control form-control-sm text-right" id="tanggal_cek_out_ri_kamar` + count_transaksi + `" required value="">
            </td>
            <td>  
                <input readonly maxlength="3" type="text" name="jumlah_hari_ri_kamar[]" class="cek_jumlah_hari_ri_kamar form-control form-control-sm text-right" id="jumlah_hari_ri_kamar` + count_transaksi + `" placeholder="@Hari" required value="0">
            </td>
            <td>
                <input type="text" name="harga_harian_ri_kamar[]" class="form-control form-control-sm rupiah text-right harga_harian_ri_kamar_update" id="harga_harian_ri_kamar` + count_transaksi + `" placeholder="Harga RI Kamar" required value="` + harga_harian + `">
                <input type="hidden" name="status_kamar_ri_kamar[]" class="form-control form-control-sm text-right" id="status_kamar_ri_kamar` + count_transaksi + `" required value="Belum Cek Out">
            </td>
            <td>    
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ri_kamar` + count_transaksi + `" readonly required value="0"></td></td>
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
        $('#exampleModalCenter_ri_kamar').modal('hide');

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ri_kamar();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_ri_kamar', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;
        jumlah_detail_transaksi_ri_kamar = jumlah_detail_transaksi_ri_kamar - 1;

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ri_kamar();
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.harga_harian_ri_kamar_update', function() {

        var row_id = $(this).attr("id"); // harga_harian_ri_kamar1++
        var row_no = row_id.substring(21); // 1++

        var val_jumlah_hari = $('#jumlah_hari_ri_kamar' + row_no).val();
        var val_harga_harian = parseInt($('#harga_harian_ri_kamar' + row_no).val().split('.').join(''));
        $('#harga_sub_ri_kamar' + row_no).val(val_harga_harian * val_jumlah_hari);

        update_sub_total_ri_kamar();
    });

    $(document).on('keyup', '.cek_jumlah_hari_ri_kamar', function() {

        var row_id = $(this).attr("id"); // jumlah_hari_ri_kamar1++
        var row_no = row_id.substring(20); // 1++

        var val_jumlah_hari = $('#jumlah_hari_ri_kamar' + row_no).val();
        var val_harga_harian = parseInt($('#harga_harian_ri_kamar' + row_no).val().split('.').join(''));
        $('#harga_sub_ri_kamar' + row_no).val(val_harga_harian * val_jumlah_hari);

        update_sub_total_ri_kamar();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.btn_check_out', function() {

        var row_id = $(this).attr("id"); // btn_check_out1++
        var row_no = row_id.substring(13); // 1++

        var c = confirm("Lakukan Check Out Kamar ?");
        if (c == true) {

            document.getElementById("jumlah_hari_ri_kamar" + row_no).readOnly = false;

            $('#tanggal_cek_out_ri_kamar' + row_no).val(moment().format('YYYY-MM-DD HH:mm:ss'));

            var btn = document.getElementById("btn_check_out" + row_no).style;
            btn.display = "none"; // hidden

            var label = document.getElementById("label_cek_out" + row_no).style;
            label.display = "none"; // hidden

            var cek_out = document.getElementById("tanggal_cek_out_ri_kamar" + row_no).style;
            cek_out.display = 'block'; // show 

            var cek_in = $('#tanggal_cek_in_ri_kamar' + row_no).val();
            var cek_out = $('#tanggal_cek_out_ri_kamar' + row_no).val();

            // selisih hari
            var date1 = moment(cek_in);
            var date2 = moment(cek_out);
            var days = date2.diff(date1, 'days');
            var val_jumlah_hari = parseInt(days);
            $('#jumlah_hari_ri_kamar' + row_no).val(val_jumlah_hari);

            // untuk sub harga
            var val_harga_harian = parseInt($('#harga_harian_ri_kamar' + row_no).val().split('.').join(''));
            $('#harga_sub_ri_kamar' + row_no).val(val_harga_harian * val_jumlah_hari);

            $('#status_kamar_ri_kamar' + row_no).val("Sudah Cek Out");
            update_sub_total_ri_kamar();
        }
    });

    function update_sub_total_ri_kamar() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_ri_kamar'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_ri_kamar').val(data);
                update_grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
</script>