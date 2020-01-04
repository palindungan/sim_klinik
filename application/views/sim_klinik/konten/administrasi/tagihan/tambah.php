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

                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h5>* Balai Pengobatan</h5>
                                <a href="#" id="btn_search_bp" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterBP">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan BP</span>
                                </a>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5>* Poli Kia</h5>
                                <a href="#" id="btn_search_kia" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterKIA">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan KIA</span>
                                </a>
                            </div>
                        </div>
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
                                <h5>* Laboratorium</h5>
                                <a href="#" id="btn_search_lab" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterLAB">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan Lab</span>
                                </a>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5>* UGD</h5>
                                <a href="#" id="btn_search_ugd" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenterUGD">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan UGD</span>
                                </a>
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
                                <h5>* Obat Apotek</h5>
                                <a href="#" id="btn_search_apotek_jual" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Obat Apotek</span>
                                </a>
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
                                <h5>* Rawat Inap Kamar</h5>
                                <a href="#" id="btn_search_kamar" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter_kamar">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Kamar Rawat Inap</span>
                                </a>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5>* Rawat Inap Tindakan</h5>
                                <a href="#" id="btn_search_tindakan" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter_tindakan">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari tindakan Rawat Inap</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
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
                                <h5>* Rawat Inap Obat</h5>
                                <a href="#" id="btn_search_obat" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter_obat">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari obat rawat inap</span>
                                </a>
                            </div>
                            <div class="form-group col-sm-6">
                                <h5>* Biaya Ambulance</h5>
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
                                            <select class="form-control form-control-sm status_pakai" required>
                                                <option value="">--Pilih Status--</option>
                                                <option value="Pakai">Pakai</option>
                                                <option value="Tidak">Tidak</option>
                                            </select>
                                        </div>
                                        <div class="col-sm-4" id="tujuan_ambulan">
                                            <label>Tujuan</label>
                                            <select class="form-control form-control-sm tujuan_ambulan" name="tujuan_ambulan">
                                                <option value="Dalam Kota">Dalam Kota</option>
                                                <option value="Luar Kota">Luar Kota</option>
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

<!-- Modal Tindakan BP -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterBP" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan Balai Pengobatan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_tindakan_bp" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tindakan_bp">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tindakan KIA -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterKIA" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan Poli KIA</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_tindakan_kia" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tindakan_kia">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tindakan LAB -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterLAB" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan Laboratorium</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_tindakan_lab" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tindakan_lab">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Tindakan UGD -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenterUGD" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Tindakan UGD</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_tindakan_ugd" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Nama</th>
                                <th class="text-center">Biaya</th>
                                <th class="text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="tindakan_ugd">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Start of modal apotek -->
<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Stok Obat Apotek</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_1_apotek_jual" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Kategori</th>
                                <th>Tanggal Penerimaan</th>
                                <th>Stok Saat Ini</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar_barang">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of modal apotek -->

<!-- start of modal rawat inap -->
<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_kamar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_kamar" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Kamar</th>
                                <th>Harga Harian</th>
                                <th>Tipe</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar_kamar">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_tindakan" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_tindakan" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama tindakan</th>
                                <th>Harga</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar_tindakan">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter_obat" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Daftar Obat Rawat Inap</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table class="table table-bordered table_obat" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Obat</th>
                                <th>Kategori</th>
                                <th>Tanggal Penerimaan</th>
                                <th>Stok Saat Ini</th>
                                <th>Harga Jual</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody id="daftar_obat">
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end of modal rawat inap -->

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
<script>
    var count_bp = 0;
    var jumlah_detail_transaksi_bp = 0;

    var count_kia = 0;
    var jumlah_detail_transaksi_kia = 0;

    var count_lab = 0;
    var jumlah_detail_transaksi_lab = 0;

    var count_ugd = 0;
    var jumlah_detail_transaksi_ugd = 0;

    // ketika memilih pasien yang dilayani
    $(document).on('change', '#xx', function(event) {
        var nilai_value = $('#xx').val();

        // kosongkan semua detail
        $('.kelas_row').remove();

        jumlah_detail_transaksi_bp = 0;
        jumlah_detail_transaksi_kia = 0;
        jumlah_detail_transaksi_lab = 0;
        jumlah_detail_transaksi_ugd = 0;
        jumlah_detail_transaksi_kamar = 0;
        jumlah_detail_transaksi_tindakan = 0;
        jumlah_detail_transaksi_obat = 0;
        jumlah_detail_transaksi_apotek_jual = 0;

        count1_apotek_jual = 0;
        count3 = 0;
        count2 = 0;
        count1 = 0;
        count_lab = 0;
        count_bp = 0;
        count_ugd = 0;
        count_kia = 0;

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

                // ambil data detail transaksi penjualan obat apotek
                let data_penjualan_apotek = obj['daftar_penjualan_obat_apotek_detail'];
                if (data_penjualan_apotek != '') {

                    $.each(data_penjualan_apotek, function(i, item) {

                        var kode = data_penjualan_apotek[i].no_stok_obat_a;
                        var nama = data_penjualan_apotek[i].nama;
                        var harga_jual = data_penjualan_apotek[i].harga_jual;
                        var qty = data_penjualan_apotek[i].qty;
                        var qty_sekarang = data_penjualan_apotek[i].qty_sekarang;

                        pilihObat_apotek_jual(kode, nama, harga_jual, qty, qty_sekarang);
                    });
                }

                // ambil data detail transaksi penjualan obat rawat inap
                let data_penjualan_rawat_inap = obj['daftar_penjualan_obat_rawat_inap_detail'];
                if (data_penjualan_rawat_inap != '') {

                    $.each(data_penjualan_rawat_inap, function(i, item) {

                        var kode_obat = data_penjualan_rawat_inap[i].no_stok_obat_rawat_i;
                        var nama_obat = data_penjualan_rawat_inap[i].nama_obat;
                        var nama_kategori = data_penjualan_rawat_inap[i].nama_kategori;
                        var qty = data_penjualan_rawat_inap[i].qty;
                        var qty_sekarang = data_penjualan_rawat_inap[i].qty_sekarang;
                        var harga_obat = data_penjualan_rawat_inap[i].harga_jual;

                        pilihobat(kode_obat, nama_obat, nama_kategori, qty, qty_sekarang, harga_obat);
                    });
                }

                // ambil data detail transaksi tindakan rawat inap
                let data_detail_tindakan_rawat_inap = obj['daftar_detail_tindakan_rawat_inap'];
                if (data_detail_tindakan_rawat_inap != '') {

                    $.each(data_detail_tindakan_rawat_inap, function(i, item) {

                        var kode_tindakan = data_detail_tindakan_rawat_inap[i].no_rawat_inap_t;
                        var nama_tindakan = data_detail_tindakan_rawat_inap[i].nama;
                        var harga_tindakan = data_detail_tindakan_rawat_inap[i].harga;

                        pilihtindakan(kode_tindakan, nama_tindakan, harga_tindakan);
                    });
                }

                // ambil data detail transaksi kamar rawat inap
                let data_detail_kamar_rawat_inap = obj['daftar_detail_kamar_rawat_inap'];
                if (data_detail_kamar_rawat_inap != '') {

                    $.each(data_detail_kamar_rawat_inap, function(i, item) {

                        var kode_kamar = data_detail_kamar_rawat_inap[i].no_kamar_rawat_i;
                        var nama_kamar = data_detail_kamar_rawat_inap[i].nama;
                        var harga_harian_kamar = data_detail_kamar_rawat_inap[i].harga_harian;
                        var jumlah_hari = data_detail_kamar_rawat_inap[i].jumlah_hari;
                        var tipe_kamar = data_detail_kamar_rawat_inap[i].tipe;

                        pilihKamar(kode_kamar, nama_kamar, harga_harian_kamar, jumlah_hari, tipe_kamar);
                    });
                }

                // ambil data detail transaksi tindakan laboratorium
                let data_detail_tindakan_lab = obj['daftar_detail_tindakan_lab'];
                if (data_detail_tindakan_lab != '') {

                    $.each(data_detail_tindakan_lab, function(i, item) {

                        var kode = data_detail_tindakan_lab[i].no_lab_c;
                        var nama = data_detail_tindakan_lab[i].nama;
                        var harga = data_detail_tindakan_lab[i].harga;

                        pilihTindakanLab(kode, nama, harga);
                    });
                }

                // ambil data detail transaksi tindakan bp
                let data_detail_tindakan_bp = obj['daftar_detail_tindakan_bp'];
                if (data_detail_tindakan_bp != '') {

                    $.each(data_detail_tindakan_bp, function(i, item) {

                        var kode = data_detail_tindakan_bp[i].no_bp_t;
                        var nama = data_detail_tindakan_bp[i].nama;
                        var harga = data_detail_tindakan_bp[i].harga;

                        pilihTindakanBp(kode, nama, harga);
                    });
                }

                // ambil data detail transaksi tindakan ugd
                let data_detail_tindakan_ugd = obj['daftar_detail_tindakan_ugd'];
                if (data_detail_tindakan_ugd != '') {

                    $.each(data_detail_tindakan_ugd, function(i, item) {

                        var kode = data_detail_tindakan_ugd[i].no_ugd_t;
                        var nama = data_detail_tindakan_ugd[i].nama;
                        var harga = data_detail_tindakan_ugd[i].harga;

                        pilihTindakanUgd(kode, nama, harga);
                    });
                }

                // ambil data detail transaksi tindakan kia
                let data_detail_tindakan_kia = obj['daftar_detail_tindakan_kia'];
                if (data_detail_tindakan_kia != '') {

                    $.each(data_detail_tindakan_kia, function(i, item) {

                        var kode = data_detail_tindakan_kia[i].no_kia_t;
                        var nama = data_detail_tindakan_kia[i].nama;
                        var harga = data_detail_tindakan_kia[i].harga;

                        pilihTindakanKia(kode, nama, harga);
                    });
                }

            }
        });

        cekJumlahDataTransaksiBp();
        cekJumlahDataTransaksiKia();
        cekJumlahDataTransaksiLab();
        cekJumlahDataTransaksiUgd();
        cekJumlahDataTransaksi_kamar();
        cekJumlahDataTransaksi_tindakan();
        cekJumlahDataTransaksi_obat();
        cekJumlahDataDetailTransaksi_apotek_jual();
    });

    //Pencarian Tindakan BP 
    // jika kita tekan / click button search-button
    $('#btn_search_bp').on('click', function() {
        search_proses_bp();
    });

    // Start pencarian
    function search_proses_bp() {

        var table;
        table = $('.table_tindakan_bp').DataTable({
            "columnDefs": [{
                    "targets": [0, 3],
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "className": "text-right"
                }
            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_bp'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data_bp'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode = data[i].no_bp_t;
                        var nama = data[i].nama;
                        var harga = data[i].harga;
                        var reverse = harga.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
                        var button = `<a onclick="pilihTindakanBp('` + kode +
                            `','` + nama + `','` + harga + `')" id="` + kode +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_tindakan_bp').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    //Pencarian Tindakan KIA
    // jika kita tekan / click button search-button
    $('#btn_search_kia').on('click', function() {
        search_proses_kia();
    });

    // Start pencarian
    function search_proses_kia() {

        var table;
        table = $('.table_tindakan_kia').DataTable({
            "columnDefs": [{
                    "targets": [0, 3],
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "className": "text-right"
                }
            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_kia'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data_kia'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode = data[i].no_kia_t;
                        var nama = data[i].nama;
                        var harga = data[i].harga;
                        var reverse = harga.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
                        var button = `<a onclick="pilihTindakanKia('` + kode +
                            `','` + nama + `','` + harga + `')" id="` + kode +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_tindakan_kia').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    //Pencarian Tindakan Lab
    // jika kita tekan / click button search-button
    $('#btn_search_lab').on('click', function() {
        search_proses_lab();
    });

    // Start pencarian
    function search_proses_lab() {

        var table;
        table = $('.table_tindakan_lab').DataTable({
            "columnDefs": [{
                    "targets": [0, 3],
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "className": "text-right"
                }
            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_lab'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data_lab'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode = data[i].no_lab_c;
                        var nama = data[i].nama;
                        var harga = data[i].harga;
                        var reverse = harga.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
                        var button = `<a onclick="pilihTindakanLab('` + kode +
                            `','` + nama + `','` + harga + `')" id="` + kode +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_tindakan_lab').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    //Pencarian Tindakan UGD
    // jika kita tekan / click button search-button
    $('#btn_search_ugd').on('click', function() {
        search_proses_ugd();
    });

    // Start pencarian
    function search_proses_ugd() {

        var table;
        table = $('.table_tindakan_ugd').DataTable({
            "columnDefs": [{
                    "targets": [0, 3],
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "className": "text-right"
                }
            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/tampil_tindakan_ugd'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data_ugd'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode = data[i].no_ugd_t;
                        var nama = data[i].nama;
                        var harga = data[i].harga;
                        var reverse = harga.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');
                        var button = `<a onclick="pilihTindakanUgd('` + kode +
                            `','` + nama + `','` + harga + `')" id="` + kode +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_tindakan_ugd').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Ketika diklik button pilih di BP
    // Start add_row
    function pilihTindakanBp(kode, nama, harga) {

        $('#detail_list_bp').append(`
        <div id="row_bp` + count_bp + `" class="row kelas_row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_bp[]" class="form-control form-control-sm karakter" id="nama_bp` + count_bp +
            `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_bp_t[]" class="form-control form-control-sm" id="no_bp_t` + count_bp + `" value="` + kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_bp[]" class="form-control form-control-sm rupiah_bp text-right" id="harga_bp` + count_bp +
            `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_bp + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_bp">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_bp = count_bp + 1;
        jumlah_detail_transaksi_bp = jumlah_detail_transaksi_bp + 1;
        $('#exampleModalCenterBP').modal('hide');
        cekJumlahDataTransaksiBp();

    }

    function cekJumlahDataTransaksiBp() {

        var x = document.getElementById("label_kosong_bp");
        if (jumlah_detail_transaksi_bp > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_bp();
        grand_total();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_bp', function() {
        var row_no = $(this).attr("id");
        $('#row_bp' + row_no).remove();
        jumlah_detail_transaksi_bp = jumlah_detail_transaksi_bp - 1;
        cekJumlahDataTransaksiBp();
    });

    function update_total_bp() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_bp'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#total_harga_bp').val(data);
                $('.rupiah_bp').trigger('input'); // Will be display 
            }
        });

        validasi();
    }

    function validasi() {
        $('.rupiah_bp').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_kia').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_lab').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_ugd').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_grand_total').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_kamar').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_tindakan').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_obat').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah').mask('000.000.000', {
            reverse: true
        });
        $('.rupiah_ambulan').mask('000.000.000', {
            reverse: true
        });
    }

    function grand_total() {

        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_grand_total'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {

                grandTotal();

                var total_rawat_inap = $('.rupiah_grant_total').val();

                var total_apotek_jual = $('.sub_total_harga_apotek_jual').val();
                var total_apotek_jual_v = 0;
                if (total_apotek_jual != "") {
                    total_apotek_jual_v = parseInt(total_apotek_jual.split('.').join(''));
                }

                var total_temp = parseInt(total_rawat_inap) + parseInt(total_apotek_jual_v) + parseInt(data);

                $('#grand_total').val(total_temp);
                $('.rupiah_grand_total').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    // Ketika diklik button pilih di KIA
    // Start add_row
    function pilihTindakanKia(kode, nama, harga) {

        $('#detail_list_kia').append(`
        <div id="row_kia` + count_kia + `" class="row kelas_row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_kia[]" class="form-control form-control-sm karakter" id="nama_kia` + count_kia +
            `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_kia_t[]" class="form-control form-control-sm" id="no_kia_t` + count_kia + `" value="` + kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_kia[]" class="form-control form-control-sm rupiah_kia text-right" id="harga_kia` + count_kia +
            `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_kia + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_kia">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_kia = count_kia + 1;
        jumlah_detail_transaksi_kia = jumlah_detail_transaksi_kia + 1;
        $('#exampleModalCenterKIA').modal('hide');
        cekJumlahDataTransaksiKia();

    }

    function cekJumlahDataTransaksiKia() {

        var x = document.getElementById("label_kosong_kia");
        if (jumlah_detail_transaksi_kia > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_kia();
        grand_total();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_kia', function() {
        var row_no = $(this).attr("id");
        $('#row_kia' + row_no).remove();
        jumlah_detail_transaksi_kia = jumlah_detail_transaksi_kia - 1;
        cekJumlahDataTransaksiKia();
    });

    function update_total_kia() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_kia'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#total_harga_kia').val(data);
                $('.rupiah_kia').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    // Ketika diklik button pilih di LAB
    // Start add_row
    function pilihTindakanLab(kode, nama, harga) {

        $('#detail_list_lab').append(`
        <div id="row_lab` + count_lab + `" class="row kelas_row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_lab[]" class="form-control form-control-sm karakter" id="nama_lab` + count_lab +
            `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_lab_c[]" class="form-control form-control-sm" id="no_lab_c` + count_lab + `" value="` + kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_lab[]" class="form-control form-control-sm rupiah_lab text-right" id="harga_lab` + count_lab +
            `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_lab + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_lab">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_lab = count_lab + 1;
        jumlah_detail_transaksi_lab = jumlah_detail_transaksi_lab + 1;
        $('#exampleModalCenterLAB').modal('hide');
        cekJumlahDataTransaksiLab();

    }

    function cekJumlahDataTransaksiLab() {

        var x = document.getElementById("label_kosong_lab");
        if (jumlah_detail_transaksi_lab > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_lab();
        grand_total();
    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_lab', function() {
        var row_no = $(this).attr("id");
        $('#row_lab' + row_no).remove();
        jumlah_detail_transaksi_lab = jumlah_detail_transaksi_lab - 1;
        cekJumlahDataTransaksiLab();
    });

    function update_total_lab() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_lab'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#total_harga_lab').val(data);
                $('.rupiah_lab').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    // Ketika diklik button pilih di UGD
    // Start add_row
    function pilihTindakanUgd(kode, nama, harga) {

        $('#detail_list_ugd').append(`
        <div id="row_ugd` + count_ugd + `" class="row kelas_row">
            <div class="form-group col-sm-6">
            <input type="text" readonly name="nama_ugd[]" class="form-control form-control-sm karakter" id="nama_ugd` + count_ugd +
            `" placeholder="Nama" required value="` + nama + `">
                <input type="hidden" name="no_ugd_t[]" class="form-control form-control-sm" id="no_ugd_t` + count_ugd + `" value="` + kode + `">
            </div>
            <div class="form-group col-sm-4">
            <input type="text" name="harga_ugd[]" class="form-control form-control-sm rupiah_ugd text-right" id="harga_ugd` + count_ugd +
            `" placeholder="Harga" required value="` + harga + `">
            </div>
            <div class="form-group col-sm-2">
            <a id="` + count_ugd + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_ugd">
                    <span class="icon text-white-50">
                        <i class="fas fa-trash-alt"></i>
                    </span>
                </a>
            </div>
        </div>


    `);
        count_ugd = count_ugd + 1;
        jumlah_detail_transaksi_ugd = jumlah_detail_transaksi_ugd + 1;
        $('#exampleModalCenterUGD').modal('hide');
        cekJumlahDataTransaksiUgd();

    }

    function cekJumlahDataTransaksiUgd() {

        var x = document.getElementById("label_kosong_ugd");
        if (jumlah_detail_transaksi_ugd > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }
        update_total_ugd();
        grand_total();

    }

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_ugd', function() {
        var row_no = $(this).attr("id");
        $('#row_ugd' + row_no).remove();
        jumlah_detail_transaksi_ugd = jumlah_detail_transaksi_ugd - 1;
        cekJumlahDataTransaksiUgd();
    });

    function update_total_ugd() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_ugd'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#total_harga_ugd').val(data);
                $('.rupiah_ugd').trigger('input'); // Will be display 
            }
        });
        validasi();
    }

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.rupiah_bp', function() {
        update_total_bp();
        grand_total();
    });

    $(document).on('keyup', '.rupiah_kia', function() {
        update_total_kia();
        grand_total();
    });

    $(document).on('keyup', '.rupiah_lab', function() {
        update_total_lab();
        grand_total();
    });

    $(document).on('keyup', '.rupiah_ugd', function() {
        update_total_ugd();
        grand_total();
    });


    // // jika di click simpan / submit
    // $(document).on('submit', '#transaksi_form', function(event) {
    // 	event.preventDefault();

    // 	// mengambil nilai di dalam form
    // 	var form_data = $(this).serialize();

    // 	// tambah ke database
    // 	$.ajax({
    // 		url: "<?php echo base_url() . 'administrasi/tagihan/input_transaksi_form'; ?>",
    // 		method: "POST",
    // 		data: form_data,
    // 		success: function(data) {
    // 			alert(data);
    // 			location.reload();
    // 		}
    // 	});
    // 	// tambah ke database

    // });
</script>

<script>
    var count1 = 0;
    var jumlah_detail_transaksi_kamar = 0;

    // Start of kamar////////////////
    // jika kita tekan / click button search-button
    $('#btn_search_kamar').on('click', function() {
        search_proses_kamar();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_kamar', function() {
        var row_no = $(this).attr("id");
        $('#row_kamar' + row_no).remove();

        jumlah_detail_transaksi_kamar = jumlah_detail_transaksi_kamar - 1;

        cekJumlahDataTransaksi_kamar();
    });

    // jika kita mengubah class inputan rupiah_kamar
    $(document).on('keyup', '.rupiah_kamar', function() {
        update_sub_harga_kamar();
    });

    // Start pencarian
    function search_proses_kamar() {

        var table;
        table = $('.table_kamar').DataTable({
            "columnDefs": [{
                    "targets": [0, 3],
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "className": "text-right"
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

                        var kode_kamar = data[i].no_kamar_rawat_i;
                        var nama_kamar = data[i].nama;
                        var harga_harian_kamar = data[i].harga_harian;
                        var tipe_kamar = data[i].tipe;

                        var reverse = harga_harian_kamar.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="pilihKamar('` + kode_kamar +
                            `','` + nama_kamar + `','` + harga_harian_kamar + `','1','` + tipe_kamar + `')" id="` + kode_kamar +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_kamar, ribuan, tipe_kamar, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_kamar').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row
    function pilihKamar(kode_kamar, nama_kamar, harga_harian_kamar, jumlah_hari, tipe_kamar) {

        $('#detail_list_kamar').append(`

			<div id="row_kamar` + count1 + `" class="form-row kelas_row">
				<div class="form-group col-sm-3">
					<input type="text" readonly name="nama_kamar[]" class="form-control form-control-sm karakter" id="nama_kamar` + count1 +
            `" placeholder="Nama_kamar" required value="` + nama_kamar + `">
					<input type="hidden" name="no_kamar_rawat_i[]" class="form-control form-control-sm" id="no_kamar_rawat_i` + count1 + `" value="` + kode_kamar + `">
				</div>
				<div class="form-group col-sm-3">
					<input type="text" name="harga_harian_kamar[]" class="form-control form-control-sm rupiah_kamar text-right" id="harga_harian_kamar` + count1 +
            `" placeholder="Harga Harian Kamar" required value="` + harga_harian_kamar + `">
				</div>
                <div class="form-group col-sm-2">
					<input type="text" name="tipe_kamar[]" readonly class="form-control form-control-sm rupiah" id="tipe_kamar` + count1 + `" placeholder="Tipe Kamar" value="` + tipe_kamar + `" required>
				</div>
                <div class="form-group col-sm-2">
					<input type="text" name="jumlah_hari[]" class="form-control form-control-sm rupiah_kamar" id="jumlah_hari` + count1 + `" placeholder="Jumlah Hari" value="` + jumlah_hari + `" required>
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count1 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_kamar">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						
					</a>
				</div>
			</div>

		`);

        count1 = count1 + 1;
        jumlah_detail_transaksi_kamar = jumlah_detail_transaksi_kamar + 1;
        $('#exampleModalCenter_kamar').modal('hide');

        cekJumlahDataTransaksi_kamar();
    }

    function cekJumlahDataTransaksi_kamar() {

        var x = document.getElementById("label_kosong_kamar");
        if (jumlah_detail_transaksi_kamar > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }

        update_sub_harga_kamar();
    }

    function update_sub_harga_kamar() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_sub_total_kamar_ri'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_harga_kamar').val(data);
                grand_total();
                $('.rupiah_kamar').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
    // End of Kamar///////////////////

    var count2 = 0;
    var jumlah_detail_transaksi_tindakan = 0;

    // Start of tindakan////////////////
    // jika kita tekan / click button search-button
    $('#btn_search_tindakan').on('click', function() {
        search_proses_tindakan();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_tindakan', function() {
        var row_no = $(this).attr("id");
        $('#row_tindakan' + row_no).remove();

        jumlah_detail_transaksi_tindakan = jumlah_detail_transaksi_tindakan - 1;

        cekJumlahDataTransaksi_tindakan();
    });

    // jika kita mengubah class inputan rupiah_tindakan
    $(document).on('keyup', '.rupiah_tindakan', function() {
        update_sub_harga_tindakan();
    });

    // Start pencarian
    function search_proses_tindakan() {

        var table;
        table = $('.table_tindakan').DataTable({
            "columnDefs": [{
                    "targets": [0, 3],
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "className": "text-right"
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

                        var button = `<a onclick="pilihtindakan('` + kode_tindakan +
                            `','` + nama_tindakan + `','` + harga_tindakan + `')" id="` + kode_tindakan +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        table.row.add([no, nama_tindakan, ribuan, button]);

                        no = no + 1;
                    });
                } else {

                    $('.table_tindakan').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row
    function pilihtindakan(kode_tindakan, nama_tindakan, harga_tindakan) {

        $('#detail_list_tindakan').append(`

			<div id="row_tindakan` + count2 + `" class="form-row kelas_row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama_tindakan[]" class="form-control form-control-sm karakter" id="nama_tindakan` + count2 +
            `" placeholder="Nama_tindakan" required value="` + nama_tindakan + `">
					<input type="hidden" name="no_rawat_inap_t[]" class="form-control form-control-sm" id="no_rawat_inap_t` + count2 + `" value="` + kode_tindakan + `">
				</div>
				<div class="form-group col-sm-5">
					<input type="text" name="harga_tindakan[]" class="form-control form-control-sm rupiah_tindakan text-right" id="harga_tindakan` + count2 +
            `" placeholder="Harga Harian tindakan" required value="` + harga_tindakan + `">
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count2 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_tindakan">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						
					</a>
				</div>
			</div>

		`);

        count2 = count2 + 1;
        jumlah_detail_transaksi_tindakan = jumlah_detail_transaksi_tindakan + 1;
        $('#exampleModalCenter_tindakan').modal('hide');

        cekJumlahDataTransaksi_tindakan();
    }

    function cekJumlahDataTransaksi_tindakan() {

        var x = document.getElementById("label_kosong_tindakan");
        if (jumlah_detail_transaksi_tindakan > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }

        update_sub_harga_tindakan();
    }

    function update_sub_harga_tindakan() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_sub_total_tindakan_ri'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_harga_tindakan').val(data);
                grand_total();
                $('.rupiah_tindakan').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
    // End of Tindakan///////////////////


    var count3 = 0;
    var jumlah_detail_transaksi_obat = 0;

    // Start of obat////////////////
    // jika kita tekan / click button search-button
    $('#btn_search_obat').on('click', function() {
        search_proses_obat();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris_obat', function() {
        var row_no = $(this).attr("id");
        $('#row_obat' + row_no).remove();

        jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat - 1;

        cekJumlahDataTransaksi_obat();
    });

    // jika kita mengubah class inputan rupiah_obat
    $(document).on('keyup', '.rupiah_obat', function() {
        update_sub_harga_obat();
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.qty_format_rawat_i', function() {

        var row_id = $(this).attr("id"); // qty1++
        var row_no = row_id.substring(3); // 1++

        var val_qty = parseInt($('#' + row_id).val());
        var val_qty_sekarang = parseInt($('#qty_sekarang' + row_no).val());

        if (val_qty <= val_qty_sekarang) {
            cekJumlahDataTransaksi_obat();
        } else {
            alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek");
            $('#' + row_id).val("1");
            cekJumlahDataTransaksi_obat();
        }
    });

    // Start pencarian
    function search_proses_obat() {

        var table;
        table = $('.table_obat').DataTable({
            "columnDefs": [{
                    "targets": [0, 3],
                    "className": "text-center"
                },
                {
                    "targets": 2,
                    "className": "text-right"
                }
            ],
            "bDestroy": true
        });

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'rawat_inap/transaksi/tampil_daftar_obat'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode_obat = data[i].no_stok_obat_rawat_i;
                        var nama_obat = data[i].nama_obat;
                        var nama_kategori = data[i].nama_kategori;
                        var tgl_obat_keluar_i = data[i].tgl_obat_keluar_i;
                        var qty_sekarang = data[i].qty_sekarang;
                        var harga_obat = data[i].harga_jual;

                        var reverse = harga_obat.toString().split('').reverse().join(''),
                            ribuan = reverse.match(/\d{1,3}/g);
                        ribuan = ribuan.join('.').split('').reverse().join('');

                        var button = `<a onclick="pilihobat('` + kode_obat +
                            `','` + nama_obat + `','` + nama_kategori + `','1','` + qty_sekarang + `','` + harga_obat + `')" id="` + kode_obat +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        if (parseInt(qty_sekarang) > 0) {
                            table.row.add([no, nama_obat, nama_kategori, tgl_obat_keluar_i, qty_sekarang, ribuan, button]);

                            no = no + 1;
                        }
                    });
                } else {

                    $('.table_obat').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row
    function pilihobat(kode_obat, nama_obat, nama_kategori, qty, qty_sekarang, harga_obat) {

        $('#detail_list_obat').append(`

            <div id="row_obat` + count3 + `" class="form-row kelas_row">
				<div class="form-group col-sm-4">
					<input type="text" readonly name="nama_obat[]" class="form-control form-control-sm karakter" id="nama_obat` + count3 + `" placeholder="Nama_obat" required value="` + nama_obat + `">
					<input type="hidden" name="no_stok_obat_rawat_i[]" class="form-control form-control-sm" id="no_stok_obat_rawat_i` + count3 + `" value="` + kode_obat + `">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_obat[]" class="form-control form-control-sm rupiah_obat text-right" id="harga_obat` + count3 + `" placeholder="harga Obar" required value="` + harga_obat + `">
				</div>
                <div class="form-group col-sm-2">
					<input type="text" name="qty[]" class="form-control form-control-sm qty_format_rawat_i" id="qty` + count3 + `" placeholder="QTY" value="` + qty + `" required>
					<input type="hidden" name="qty_sekarang[]" id="qty_sekarang` + count3 + `" class="form-control form-control-sm" value="` + qty_sekarang + `"></input>
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count3 + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris_obat">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>
						
					</a>
				</div>
			</div>

		`);

        count3 = count3 + 1;
        jumlah_detail_transaksi_obat = jumlah_detail_transaksi_obat + 1;
        $('#exampleModalCenter_obat').modal('hide');

        cekJumlahDataTransaksi_obat();
    }

    function cekJumlahDataTransaksi_obat() {

        var x = document.getElementById("label_kosong_obat");
        if (jumlah_detail_transaksi_obat > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }

        update_sub_harga_obat();
    }

    function update_sub_harga_obat() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_sub_total_obat_ri'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_harga_obat').val(data);
                grand_total();
                $('.rupiah_obat').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
    // End of obat///////////////////

    function grandTotal() {
        var sub_total_harga_tindakan = $('#sub_total_harga_tindakan').val();
        var sub_total_harga_tindakan_v = 0;
        if (sub_total_harga_tindakan != "") {
            sub_total_harga_tindakan_v = parseInt(sub_total_harga_tindakan.split('.').join(''));
        }

        var sub_total_harga_kamar = $('#sub_total_harga_kamar').val();
        var sub_total_harga_kamar_v = 0;
        if (sub_total_harga_kamar != "") {
            sub_total_harga_kamar_v = parseInt(sub_total_harga_kamar.split('.').join(''));
        }

        var sub_total_harga_obat = $('#sub_total_harga_obat').val();
        var sub_total_harga_obat_v = 0;
        if (sub_total_harga_obat != "") {
            sub_total_harga_obat_v = parseInt(sub_total_harga_obat.split('.').join(''));
        }

        $('.rupiah_grant_total').val(sub_total_harga_tindakan_v + sub_total_harga_kamar_v + sub_total_harga_obat_v);
        $('.rupiah_grant_total').trigger('input'); // Will be display 
    }
</script>

<!-- js penjualan obat -->
<script>
    var count1_apotek_jual = 0;
    var jumlah_detail_transaksi_apotek_jual = 0;

    // jika kita tekan / click button search-button
    $('#btn_search_apotek_jual').on('click', function() {
        search_proses_apotek_jual();
    });

    // jika kita tekan hapus / click button
    $(document).on('click', '.remove_baris', function() {
        var row_no = $(this).attr("id");
        $('#row_apotek_jual' + row_no).remove();

        jumlah_detail_transaksi_apotek_jual = jumlah_detail_transaksi_apotek_jual - 1;

        cekJumlahDataDetailTransaksi_apotek_jual();
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.qty_format', function() {

        var row_id = $(this).attr("id"); // qty_apotek_jual1++
        var row_no = row_id.substring(15); // 1++

        var val_qty = parseInt($('#' + row_id).val());
        var val_qty_sekarang = parseInt($('#qty_sekarang_apotek_jual' + row_no).val());

        if (val_qty <= val_qty_sekarang) {
            update_total_apotek_jual();
        } else {
            alert("Maaf Qty Tidak Boleh Detail Obat Melebihi Stok Apotek");
            $('#' + row_id).val("1");
            update_total_apotek_jual();
        }
    });

    // jika kita mengubah class inputan rupiah
    $(document).on('keyup', '.rupiah', function() {
        update_total_apotek_jual();
    });

    // Start pencarian
    function search_proses_apotek_jual() {

        var table;
        table = $('.table_1_apotek_jual').DataTable();

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'apotek/penjualan_obat/tampil_daftar_obat'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var no = 1;

                    $.each(data, function(i, item) {

                        var kode = data[i].no_stok_obat_a;
                        var nama = data[i].nama_obat;
                        var nama_kategori = data[i].nama_kategori;
                        var tgl_penerimaan_o = data[i].tgl_penerimaan_o;
                        var qty_sekarang = data[i].qty_sekarang;
                        var harga_jual = data[i].harga_jual;

                        var button = `<a onclick="pilihObat_apotek_jual('` + kode +
                            `','` + nama + `','` + harga_jual + `','1','` + qty_sekarang + `')" id="` + kode +
                            `" class="btn btn-sm btn-dark text-white">Pilih</a>`;

                        if (parseInt(qty_sekarang) > 0) {
                            table.row.add([no, nama, nama_kategori, tgl_penerimaan_o, qty_sekarang,
                                harga_jual, button
                            ]);
                            no = no + 1;
                        }
                    });
                } else {

                    $('.table_1_apotek_jual').html('<h3>No data are available</h3>');

                }
                table.draw();

            }
        });
    }

    // Start add_row
    function pilihObat_apotek_jual(kode, nama, harga_jual, qty, qty_sekarang) {

        $('#detail_list_apotek_jual').append(`

			<div id="row_apotek_jual` + count1_apotek_jual + `" class="form-row kelas_row">
				<div class="form-group col-sm-5">
					<input type="text" readonly name="nama[]" class="form-control form-control-sm karakter" id="nama` + count1_apotek_jual + `" placeholder="Nama" required value="` + nama + `">
					<input type="hidden" name="no_stok_obat_a[]" class="form-control form-control-sm" id="no_stok_obat_a` + count1_apotek_jual + `" value="` + kode + `">
				</div>
				<div class="form-group col-sm-4">
					<input type="text" name="harga_jual_apotek_jual[]" class="form-control form-control-sm rupiah text-right" id="harga_jual_apotek_jual` + count1_apotek_jual + `" placeholder="harga supplier" required value="` + harga_jual + `">
				</div>
                <div class="form-group col-sm-1">
					<input type="text" name="qty_apotek_jual[]" class="form-control form-control-sm qty_format" id="qty_apotek_jual` + count1_apotek_jual + `" placeholder="QTY" value="` + qty + `" required>
					<input type="hidden" name="qty_sekarang_apotek_jual[]" id="qty_sekarang_apotek_jual` + count1_apotek_jual + `" class="form-control form-control-sm" value="` + qty_sekarang + `"></input>
				</div>
				<div class="form-group col-sm-2">
					<a id="` + count1_apotek_jual + `" href="#" class="btn btn-sm btn-danger btn-icon-split remove_baris">
						<span class="icon text-white-50">
							<i class="fas fa-trash-alt"></i>
						</span>

					</a>
				</div>
			</div>

		`);

        count1_apotek_jual = count1_apotek_jual + 1;
        jumlah_detail_transaksi_apotek_jual = jumlah_detail_transaksi_apotek_jual + 1;
        $('#exampleModalCenter').modal('hide');

        cekJumlahDataDetailTransaksi_apotek_jual();
    }

    function cekJumlahDataDetailTransaksi_apotek_jual() {

        var x = document.getElementById("label_kosong_apotek_jual");
        if (jumlah_detail_transaksi_apotek_jual > 0) {
            x.style.display = "none"; // hidden
        } else {
            x.style.display = "block"; // show
        }

        update_total_apotek_jual();
    }

    function update_total_apotek_jual() {
        // mengambil nilai di dalam form
        var form_data = $('#transaksi_form').serialize()

        $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_total_apotek_jual'; ?>",
            method: "POST",
            data: form_data,
            success: function(data) {
                $('#sub_total_harga_apotek_jual').val(data);
                grand_total();
                $('.rupiah').trigger('input'); // Will be display 
            }
        });

        validasi();
    }
</script>
<script>
    $("#tujuan_ambulan").hide();
    $("#harga_ambulan").hide();
    $('.status_pakai').on('change', function() {
        if(this.value == "")
        {
            $("#tujuan_ambulan").hide();
            $("#harga_ambulan").hide();
        }
        else if(this.value == "Pakai")
        {
            $("#tujuan_ambulan").show();
            $("#harga_ambulan").show();
            var id = $('.tujuan_ambulan').find(":selected").text();
            $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_harga_ambulan'; ?>",
            method: "POST",
            data: {id: id},
            success: function(data) {
                $('#harga_ambulans').val(data);
                $('.rupiah_ambulan').trigger('input'); // Will be display 
            }
            });
            validasi();
        }
        else if(this.value == "Tidak")
        {
            $("#tujuan_ambulan").hide();
            $("#harga_ambulan").hide();
        }
    });
    $('.tujuan_ambulan').change(function(){
            var id = this.value;
            $.ajax({
            url: "<?php echo base_url() . 'administrasi/tagihan/ambil_harga_ambulan'; ?>",
            method: "POST",
            data: {id: id},
            success: function(data) {
                $('#harga_ambulans').val(data);
                $('.rupiah_ambulan').trigger('input'); // Will be display 
            }
            });
            validasi();
        });
</script>