<?php
foreach ($record as $row) {

    $nama_pasien = $row->nama_pasien;
    $no_rm = $row->no_rm;

    $tanggal_penjualan = $row->tanggal_penjualan;

    $no_user_pegawai = $row->no_user_pegawai;
    $nama_pegawai = $row->nama_pegawai;

    $no_penjualan_obat_a = $row->no_penjualan_obat_a;
    $no_ref_pelayanan = $row->no_ref_pelayanan;

    $total_harga = $row->total_harga;
} ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Penjualan Apotek</h6>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 20px;">
                <button onclick="window.history.back();" type="button" class="btn btn-sm btn-dark mb-3">Kembali</button>
            </div>
            <table class="table table-borderless" width="100">
                <tr>
                    <th width="11%">Pasien</th>
                    <td width="1%">:</th>
                    <td><?= $nama_pasien; ?></th>
                    <th width="11%">Petugas</th>
                    <td width="1%">:</th>
                    <td><?= $nama_pegawai; ?></th>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <td>:</th>
                    <td><?= $tanggal_penjualan; ?></th>
                    <th>Kode</th>
                    <td>:</th>
                    <td><?= $no_penjualan_obat_a; ?></th>
                </tr>
            </table>
            <table class="table table-sm table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="7%" scope="col" class="text-center">No.</th>
                        <th width="25%" scope="col" class="text-center">Nama Obat</th>
                        <th width="8%" scope="col" class="text-center">Qty</th>
                        <th width="15%" scope="col" class="text-center">Harga</th>
                        <th width="15%" scope="col" class="text-center">Subtotal</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($detail_record as $row) {
                    ?>
                        <tr>
                            <td width="7%" scope="row"><?= $no++; ?></td>
                            <td width="25%"><?= $row->nama; ?></td>
                            <td width="8%"><?= $row->qty; ?></td>
                            <td width="15%" style="text-align:right"><?= rupiah($row->harga_jual) ?></td>
                            <th width="15%" style="text-align:right"><?= rupiah($row->qty * $row->harga_jual) ?></th>
                        </tr>
                    <?php } ?>
                    <th style="text-align:center" colspan="4">Grand Total</th>
                    <th style="text-align:right"><?= rupiah($total_harga) ?></th>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>