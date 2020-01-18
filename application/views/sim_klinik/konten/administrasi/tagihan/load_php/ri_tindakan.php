<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_ri_tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">RI - Tindakan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="table_ri_tindakan" class="table table-bordered" width="100%" cellspacing="0">
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
    $('#btn_search_ri_tindakan').on('click', function() {
        search_proses_ri_tindakan();
    });

    // Start pencarian
    function search_proses_ri_tindakan() {

        var table;
        table = $('#table_ri_tindakan').DataTable({
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
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_tindakan'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_tindakan = data[i].no_rawat_inap_t;
                        var nama_tindakan = data[i].nama;
                        var harga_tindakan = data[i].harga;

                        var reverse = harga_tindakan.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="tambah_detail_ri_tindakan('` + kode_tindakan +
                            `','` + nama_tindakan + `','` + harga_tindakan + `')" id="` +
                            kode_tindakan +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_tindakan, ribuan, button]);

                        no = no + 1;
                    });
                }
                table.draw();

            }
        });
    }

    // Start add_row kode, nama, harga, status
    function tambah_detail_ri_tindakan(kode, nama, harga) {

        $('#detail_list_ri_tindakan').append(`

        <tr id="row` + count_transaksi + `" class="kelas_row">
            <td>
                ` + nama + `
                <input type="hidden" name="no_rawat_inap_t[]" class="form-control form-control-sm" id="no_rawat_inap_t` + count_transaksi + `" value="` + kode + `">
            </td>
            <td>1</td>
            <td>
                <input type="text" name="harga_ri_tindakan[]" class="form-control form-control-sm rupiah text-right harga_ri_tindakan_update" id="harga_ri_tindakan` + count_transaksi + `" placeholder="Harga Tindakan RI" required value="` + harga + `">
            </td>
            <td>  
                <input type="text" class="form-control form-control-sm rupiah text-right" id="harga_sub_ri_tindakan` + count_transaksi + `" readonly required value="` + harga + `"></td>
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
        $('#exampleModalCenter_ri_tindakan').modal('hide');

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ri_tindakan();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_ri_tindakan', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
        update_sub_total_ri_tindakan();
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.harga_ri_tindakan_update', function() {

        var row_id = $(this).attr("id"); // harga_ri_tindakan1++
        var row_no = row_id.substring(17); // 1++

        var row_val = $('#' + row_id).val();
        $('#harga_sub_ri_tindakan' + row_no).val(row_val);

        update_sub_total_ri_tindakan();
    });

    function update_sub_total_ri_tindakan() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_ri_tindakan'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_ri_tindakan').val(data);
                update_grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
</script>