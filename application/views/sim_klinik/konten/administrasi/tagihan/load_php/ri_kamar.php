<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_ri_kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Tindakan Balai Pengobatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_ri_kamar" width="100%" cellspacing="0">
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
        table = $('.table_ri_kamar').DataTable();

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_kamar'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_kamar = data[i].no_kamar_rawat_i;
                        var nama_kamar = data[i].nama;
                        var harga_harian_kamar = data[i].harga_harian;
                        var tipe_kamar = data[i].tipe;

                        var reverse = harga_harian_kamar.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="tambah_detail_ri_kamar('` + kode_kamar +
                            `','` + nama_kamar + `','` + harga_harian_kamar + `','` + tipe_kamar +
                            `')" id="` + kode_kamar +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_kamar, tipe_kamar, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_ri_kamar').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row kode_kamar, nama_kamar, harga_harian_kamar, tipe_kamar
    function tambah_detail_ri_kamar(kode, nama, harga, tipe) {

        var today = new Date();
        var date = today.getFullYear() + '-' + (today.getMonth() + 1) + '-' + today.getDate();
        var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();
        var dateTime = date + ' ' + time;

        $('#detail_list_ri_kamar').append(`

        <tr id="row` + count_transaksi + `">
            <td>
                ` + nama + ` (` + tipe + `)
                <input type="hidden" name="no_kamar_rawat_i[]" class="form-control form-control-sm" id="no_kamar_rawat_i` + count_transaksi + `" value="` + kode + `">
            </td>
            <td>  
                <input readonly type="text" name="tanggal_cek_in_ri_kamar[]" class="form-control form-control-sm text-right" id="tanggal_cek_in_ri_kamar` + count_transaksi + `" required value="` + dateTime + `">
            </td>
            <td>Belum</td>
            <td>0</td>
            <td>
                <input type="text" name="harga_harian_ri_kamar[]" class="form-control form-control-sm rupiah text-right harga_harian_ri_kamar_update" id="harga_harian_ri_kamar` + count_transaksi + `" placeholder="Harga RI Kamar" required value="` + harga + `">
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
        update_sub_total_ri_kamar();
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