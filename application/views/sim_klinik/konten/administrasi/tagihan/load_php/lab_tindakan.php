<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_lab_tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tindakan LAB</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_lab_tindakan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Biaya</th>
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
    $('#btn_search_lab_tindakan').on('click', function() {
        search_proses_lab_tindakan();
    });

    // Start pencarian
    function search_proses_lab_tindakan() {

        var table;
        table = $('.table_lab_tindakan').DataTable();

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'laboratorium/transaksi/tampil_daftar_checkup'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode = data[i].no_lab_c;
                        var nama = data[i].nama;
                        var harga = data[i].harga;
                        var reverse = harga.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
                        var button = `<a onclick="tambah_detail_lab_tindakan('` + kode +
                            `','` + nama + `','` + harga + `')" id="` + kode +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_lab_tindakan').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row kode, nama, harga
    function tambah_detail_lab_tindakan(kode, nama, harga) {

        $('#detail_list_lab_tindakan').append(`

        <tr id="row` + count_transaksi + `">
            <td>
                ` + nama + `
                <input type="hidden" name="no_lab_c[]" class="form-control form-control-sm" id="no_lab_c` + count_transaksi + `" value="` + kode + `">
            </td>
            <td>1</td>
            <td>
                <input type="text" name="harga_lab_tindakan[]" class="form-control form-control-sm rupiah text-right harga_lab_tindakan_update" id="harga_lab_tindakan` + count_transaksi + `" placeholder="Harga Tindakan LAB" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_lab_tindakan` + count_transaksi + `" readonly required value="` + harga + `"></td>
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
        $('#exampleModalCenter_lab_tindakan').modal('hide');

        cek_jumlah_data_detail_transaksi();
        update_sub_total_lab_tindakan();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_lab_tindakan', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
        update_sub_total_lab_tindakan();
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.harga_lab_tindakan_update', function() {

        var row_id = $(this).attr("id"); // harga_lab_tindakan1++
        var row_no = row_id.substring(18); // 1++

        var row_val = $('#' + row_id).val();
        $('#harga_sub_lab_tindakan' + row_no).val(row_val);

        update_sub_total_lab_tindakan();
    });

    function update_sub_total_lab_tindakan() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_lab_tindakan'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_lab_tindakan').val(data);
                update_grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
</script>