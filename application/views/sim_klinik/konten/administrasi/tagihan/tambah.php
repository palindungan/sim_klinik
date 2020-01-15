<?php if ($this->session->flashdata('success')) : ?>
    <div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Tagihan</h6>
        </div>
        <div class="card-body">
            <form method="post" id="transaksi_form" action="<?= base_url('administrasi/tagihan/input_transaksi_form') ?>">

                <div class="form-row">
                    <div class="form-group col-sm-5">
                        <label>Cari No Ref</label>
                        <select id="xx" class="form-control form-control-sm noRef" name="no_ref_pelayanan" required>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2">
                        <a href="#" id="btn_search_ambulance" class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#exampleModalCenter_ambulance">Ambulance</a>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12">Obat Apotek</button>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12">RI-Kamar</button>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12">RI-Obat</button>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12">RI-Tindakan</button>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#modalTindakanBP">Tindakan BP</button>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#modalTindakanKIA">Tindakan KIA</button>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#modalCheckupLab">Tindakan Lab</button>
                    </div>
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#modalTindakanUGD">Tindakan UGD</button>
                    </div>
                </div>

                <input type="text" readonly name="sub_total_ambulance" class="form-control form-control-sm rupiah text-right" id="sub_total_ambulance" placeholder="Sub Total Ambulance">

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>Rincian</td>
                                    <td width="10%">Qty</td>
                                    <td>Biaya</td>
                                    <td>Sub Total</td>
                                    <td width="10%">Hapus</td>
                                </tr>
                            </thead>
                            <tbody id="detail_list_ambulance">

                                <tr id="label_kosong">
                                    <td>
                                        Detail Transaksi Masih Kosong !
                                    </td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                </tr>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td align="right">Grand Total :</td>
                                    <td> 
                                        <input readonly type="text" name="grand_total" class="form-control form-control-sm rupiah text-right" id="grand_total" placeholder="Grand Total" required value="">
                                    </td>
                                    <td></td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-sm-2">
                        <button id="action" type="submit" class="btn btn-sm btn-success btn-icon-split" onclick="return confirm('Lakukan Simpan Data ?')">
                            <span class="icon text-white-50">
                                <i class="fas fa-save"></i>
                            </span>
                            <span class="text">Simpan Data</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
    $('.noRef').select2({
        ajax: {
            url: "<?= base_url('administrasi/tagihan/tampil_select') ?>",
            dataType: "json",
            delay: 250,
            data: function(params) {
                return {
                    no_ref: params.term,
                    nama: params.term
                };
            },
            processResults: function(data) {
                var results = [];

                $.each(data, function(index, item) {
                    results.push({
                        id: item.no_ref_pelayanan,
                        text: item.no_ref_pelayanan + " || " + item.nama
                    });
                });
                return {
                    results: results
                }
            }
        }
    })

    // Deklarasi Variable 
    var count_transaksi = 0;
    var jumlah_detail_transaksi = 0;
</script>

<?php $this->view('sim_klinik/konten/administrasi/tagihan/load_php/ambulance.php') ?>

<script>
    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris', function() {
        var row_no = $(this).attr("id");
        $('#row' + row_no).remove();

        jumlah_detail_transaksi = jumlah_detail_transaksi - 1;

        cek_jumlah_data_detail_transaksi();
    });

    function cek_jumlah_data_detail_transaksi() {

        var x = document.getElementById("label_kosong").style;
        if (jumlah_detail_transaksi > 0) {
            x.display = "none"; // hidden
        } else {
            x.display = "table-row"; // show
        }

        update_grand_total();
    }

    function validasi() {
        $('.rupiah').mask('000.000.000', {
            reverse: true
        });
    }

    function update_grand_total() {

        var sub_total_ambulance = $('#sub_total_ambulance').val();
		var sub_total_ambulance_v = 0;
		if (sub_total_ambulance != "") {
			sub_total_ambulance_v = parseInt(sub_total_ambulance.split('.').join(''));
		}

		// var sub_total_bp_tindakan = $('#sub_total_bp_tindakan').val();
		// var sub_total_bp_tindakan_v = 0;
		// if (sub_total_bp_tindakan != "") {
		// 	sub_total_bp_tindakan_v = parseInt(sub_total_bp_tindakan.split('.').join(''));
		// }

		// var sub_total_ri_kamar = $('#sub_total_ri_kamar').val();
		// var sub_total_ri_kamar_v = 0;
		// if (sub_total_ri_kamar != "") {
		// 	sub_total_ri_kamar_v = parseInt(sub_total_ri_kamar.split('.').join(''));
		// }

		// var sub_total_apotek_obat = $('#sub_total_apotek_obat').val();
		// var sub_total_apotek_obat_v = 0;
		// if (sub_total_apotek_obat != "") {
		// 	sub_total_apotek_obat_v = parseInt(sub_total_apotek_obat.split('.').join(''));
		// }

		$('#grand_total').val(sub_total_ambulance_v);
		$('#grand_total').trigger('input'); // Will be display 
	}
</script>