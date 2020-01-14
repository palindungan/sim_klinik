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
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan BP</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_bp">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_bp">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_bp" class="form-control form-control-sm rupiah_bp text-right" id="total_harga_bp" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan KIA</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_kia">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_kia">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_kia" class="form-control form-control-sm rupiah_kia text-right" id="total_harga_kia" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan Lab</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_lab">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_lab">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_lab" class="form-control form-control-sm rupiah_lab text-right" id="total_harga_lab" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan UGD</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_ugd">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_ugd">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="total_harga_ugd" class="form-control form-control-sm rupiah_ugd text-right" id="total_harga_ugd" placeholder="0" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- start of apotek obat view fix -->
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <label class=" col-sm-4"><b>Nama Obat</b></label>
                                    <label class=" col-sm-4"><b>Harga Jual</b></label>
                                    <label class=" col-sm-2"><b>QTY</b></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <!-- start untuk keranjang Obat -->
                                        <div id="detail_list_apotek_jual">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_apotek_jual">Detail Obat Masih Kosong Lakukan pilih Pencarian Data Obat !</h6>

                                        </div>
                                        <!-- end of untuk keranjang Obat -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="sub_total_harga_apotek_jual" class="form-control form-control-sm rupiah text-right sub_total_harga_apotek_jual" value="0" id="sub_total_harga_apotek_jual" placeholder="Total" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end of apotek obat view fix -->

                <!-- Start of rawat inap view fix -->
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <label class=" col-sm-3"><b>Nama Kamar</b></label>
                                    <label class=" col-sm-3"><b>Harga Harian</b></label>
                                    <label class=" col-sm-2"><b>Tipe</b></label>
                                    <label class=" col-sm-2"><b>@Hari</b></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">

                                        <!-- start untuk keranjang Kamar -->
                                        <div id="detail_list_kamar">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_kamar">Detail Kamar Masih Kosong Lakukan pilih Pencarian Kamar !</h6>

                                        </div>
                                        <!-- end of untuk keranjang Kamar -->

                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="sub_total_harga_kamar" class="form-control form-control-sm rupiah_kamar text-right" id="sub_total_harga_kamar" value="0" placeholder="Sub Total">
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <label class=" col-sm-5"><b>Nama tindakan</b></label>
                                    <label class=" col-sm-4"><b>Harga</b></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list_tindakan">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_tindakan">Detail tindakan Masih Kosong Lakukan pilih Pencarian tindakan !</h6>

                                        </div>
                                        <!-- end of untuk keranjang tindakan -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="sub_total_harga_tindakan" class="form-control form-control-sm rupiah_tindakan text-right" id="sub_total_harga_tindakan" value="0" placeholder="Sub Total">
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">


                            </div>
                            <div class="form-group col-sm-6">
                                <h5>* Fasilitas Ambulance</h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <label class=" col-sm-4"><b>Nama Obat</b></label>
                                    <label class=" col-sm-4"><b>Harga Jual</b></label>
                                    <label class=" col-sm-2"><b>QTY</b></label>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- start untuk keranjang obat -->
                                        <div id="detail_list_obat">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong_obat">Detail obat Masih Kosong Lakukan pilih Pencarian obat !</h6>

                                        </div>
                                        <!-- end of untuk keranjang obat -->
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                    </div>
                                    <div class="col-sm-4">
                                        <input type="text" readonly name="sub_total_harga_obat" class="form-control form-control-sm rupiah_obat text-right" id="sub_total_harga_obat" value="0" placeholder="Sub Total">
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-4">
                                        <label>Status Pakai</label>
                                        <select class="form-control form-control-sm status_pakai" name="status_pakai_ambulan" required>
                                            <option value="">--Pilih Status--</option>
                                            <option value="Pakai">Pakai</option>
                                            <option value="Tidak">Tidak</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4" id="tujuan_ambulan">
                                        <label>Tujuan</label>
                                        <select class="form-control form-control-sm tujuan_ambulan" name="tujuan_ambulan">
                                            <option value="RS Ambulu">RS Ambulu</option>
                                            <option value="Kota Jember">Kota Jember</option>
                                        </select>
                                    </div>
                                    <div class="col-sm-4" id="harga_ambulan">
                                        <label>Harga</label>
                                        <input type="text" readonly name="harga_ambulan" id="harga_ambulans" class="form-control form-control-sm rupiah_ambulan text-right harga_ambulan" placeholder="Sub Total">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of rawat inap view fix -->

                <!-- start of total_harga rawat inap //// -->
                <div class="form-group col-sm-5">
                    <input type="hidden" readonly name="total_harga" class="rupiah_grant_total form-control form-control-sm text-right" id="total_harga" placeholder="Total" required>
                </div>
                <!-- end of total_harga rawat inap //// -->

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

<!-- Modal Ambulance -->
<div class="modal fade" id="modalAmbulance" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ambulance</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">No.</td>
                            <td class="text-center">Rincian</td>
                            <td class="text-center">Biaya</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($ambulance as $i) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $i->tujuan; ?></td>
                                <td class="text-right"><?php echo number_format($i->harga, 0, ',', '.'); ?></td>
                                <td><a href="" class=""></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tindakan BP -->
<div class="modal fade" id="modalTindakanBP" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tindakan BP</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">No.</td>
                            <td class="text-center">Rincian</td>
                            <td class="text-center">Biaya</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($bp_tindakan as $i) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $i->nama; ?></td>
                                <td class="text-right"><?php echo number_format($i->harga, 0, ',', '.'); ?></td>
                                <td><a href="" class=""></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tindakan KIA -->
<div class="modal fade" id="modalTindakanKIA" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tindakan KIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">No.</td>
                            <td class="text-center">Rincian</td>
                            <td class="text-center">Biaya</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($kia_tindakan as $i) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $i->nama; ?></td>
                                <td class="text-right"><?php echo number_format($i->harga, 0, ',', '.'); ?></td>
                                <td><a href="" class=""></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Checkup Lab -->
<div class="modal fade" id="modalCheckupLab" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tindakan KIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">No.</td>
                            <td class="text-center">Rincian</td>
                            <td class="text-center">Biaya</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($lab_checkup as $i) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $i->nama; ?></td>
                                <td class="text-right"><?php echo number_format($i->harga, 0, ',', '.'); ?></td>
                                <td><a href="" class=""></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- Modal Tindakan UGD -->
<div class="modal fade" id="modalTindakanUGD" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Tindakan KIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <td class="text-center">No.</td>
                            <td class="text-center">Rincian</td>
                            <td class="text-center">Biaya</td>
                            <td class="text-center">Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($ugd_tindakan as $i) {
                        ?>
                            <tr>
                                <td><?php echo $no++; ?></td>
                                <td><?php echo $i->nama; ?></td>
                                <td class="text-right"><?php echo number_format($i->harga, 0, ',', '.'); ?></td>
                                <td><a href="" class=""></a></td>
                            </tr>
                        <?php } ?>

                    </tbody>
                </table>
            </div>
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