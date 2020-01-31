<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_lain" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Transaksi Lain</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table_lain" class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Harga</th>
                                <th class="text-center">Aksi</th>
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
    $('#btn_search_lain').on('click', function() {
        search_proses_lain();
    });

    // Start pencarian
    function search_proses_lain() {

        var table;
        table = $('#table_lain').DataTable({
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
            url: "<?php echo base_url() . 'administrasi/tagihan/tampil_lain'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode = data[i].no_lain;
                        var nama = data[i].nama;
                        var harga = data[i].harga;
                        var tipe = data[i].tipe;
                        var reverse = harga.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
                        var button = `<a onclick="tambah_detail_lain('` + kode +
                            `','` + nama + `','` + harga + `','` + tipe + `')" id="` + kode +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama + ' (' + tipe + ')', ribuan, button]);

                        no = no + 1;
                    });
                }
                table.draw();

            }
        });
    }

    // Start add_row kode, nama, harga, tipe
    function tambah_detail_lain(kode, nama, harga, tipe) {

        $('#detail_list_lain').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                <input type="text" name="nama_lain[]" class="form-control form-control-sm" id="nama_lain` + count_transaksi + `" placeholder="nama lain" required value="` + nama + ` (` + tipe + `)">
                <input type="hidden" name="no_lain[]" class="form-control form-control-sm" id="no_lain` + count_transaksi + `" value="` + kode + `">
            </td>
            <td>
                <input type="text" name="qty_lain[]" class="form-control form-control-sm cek_qty_lain" id="qty_lain` + count_transaksi + `" placeholder="QTY" value="1" required>
            </td>
            <td>
                <input type="text" name="harga_lain[]" class="form-control form-control-sm rupiah text-right harga_lain_update" id="harga_lain` + count_transaksi + `" placeholder="Harga lain" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_lain` + count_transaksi + `" readonly required value="` + harga + `"></td>
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
        $('#exampleModalCenter_lain').modal('hide');

        cek_jumlah_data_detail_transaksi();
        update_sub_total_lain();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_lain', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
        update_sub_total_lain();
    });

    $(document).on('keyup', '.harga_lain_update', function() {

        var row_id = $(this).attr("id"); // harga_lain1++
        var row_no = row_id.substring(10); // 1++

        var row_val = $('#' + row_id).val();
        var val_qty = $('#qty_lain' + row_no).val();

        // sub total
        var val_harga_lain = parseInt(row_val.split('.').join(''));
        $('#harga_sub_lain' + row_no).val(val_harga_lain * val_qty);

        update_sub_total_lain();
    });

    $(document).on('keyup', '.cek_qty_lain', function() {

        var row_id = $(this).attr("id"); // qty_lain1++
        var row_no = row_id.substring(8); // 1++

        var val_qty = $('#' + row_id).val();

        update_sub_total_lain()

        // sub total
        var harga_lain = $('#harga_lain' + row_no).val()
        var val_harga_lain = parseInt(harga_lain.split('.').join(''));
        $('#harga_sub_lain' + row_no).val(val_harga_lain * val_qty);
    });

    function update_sub_total_lain() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_lain'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_lain').val(data);
                update_grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
</script>