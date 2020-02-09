<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_ambulance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Ambulance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table_ambulance" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tujauan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>

                        <tbody id="daftar_ambulance">
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // jika kita tekan / click button search-button
    $('#btn_search_ambulance').on('click', function() {
        search_proses_ambulance();
    });

    // Start pencarian
    function search_proses_ambulance() {

        var table;
        table = $('#table_ambulance').DataTable({
            "columnDefs": [{
                    "targets": 2,
                    "className": "text-right"
                }, {
                    "targets": 3,
                    "className": "text-center"
                }

            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/tampil_ambulance'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var no_ambulance = data[i].no_ambulance;
                        var tujuan_ambulance = data[i].tujuan;
                        var harga_ambulance = data[i].harga;

                        var reverse = harga_ambulance.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a href="#" onclick="tambah_detail_ambulance('` + no_ambulance +
                            `','` + tujuan_ambulance + `','` + harga_ambulance + `')" id="` +
                            no_ambulance +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, tujuan_ambulance, ribuan, button]);

                        no = no + 1;
                    });
                }
                table.draw();

            }
        });
    }

    // Start add_row
    function tambah_detail_ambulance(no_ambulance, tujuan_ambulance, harga_ambulance) {

        $('#detail_list_ambulance').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + tujuan_ambulance + ` (Ambulance)
                <input type="hidden" name="no_ambulance[]" class="form-control form-control-sm" id="no_ambulance` + count_transaksi + `" value="` + no_ambulance + `">
            </td>
            <td>
                <input type="text" name="qty_ambulance[]" class="form-control form-control-sm" id="qty_ambulance` + count_transaksi + `" placeholder="QTY" value="1" readonly required>
            </td>
            <td>
                <input type="text" name="harga_ambulance[]" class="form-control form-control-sm rupiah text-right harga_ambulance_update" id="harga_ambulance` + count_transaksi + `" placeholder="Harga Ambulance" required value="` + harga_ambulance + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ambulance` + count_transaksi + `" readonly required value="` + harga_ambulance + `"></td>
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
        $('#exampleModalCenter_ambulance').modal('hide');

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ambulance();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_ambulance', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ambulance();
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.harga_ambulance_update', function() {

        var row_id = $(this).attr("id"); // harga_ambulance1++
        var row_no = row_id.substring(15); // 1++

        var row_val = $('#' + row_id).val();
        $('#harga_sub_ambulance' + row_no).val(row_val);

        update_sub_total_ambulance();
    });

    function update_sub_total_ambulance() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_ambulance'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_ambulance').val(data);
                update_grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
</script>