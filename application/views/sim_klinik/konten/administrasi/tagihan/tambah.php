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
                    <div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Grand Total</label>
                        <input type="text" id="grand_total" name="grand_total" class="form-control form-control-sm rupiah_grand_total text-right" placeholder="0" readonly>
                    </div>
                </div>

                <div class="row">
                    <div class="form-group col-md-2">
                        <button class="btn btn-sm btn-primary col-md-12" data-toggle="modal" data-target="#modalAmbulance">Ambulance</button>
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

                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-sm table-bordered table-striped">
                            <thead>
                                <tr>
                                    <td>No.</td>
                                    <td>Rincian</td>
                                    <td>Qty</td>
                                    <td>Biaya</td>
                                </tr>
                            </thead>
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

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
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
</script>