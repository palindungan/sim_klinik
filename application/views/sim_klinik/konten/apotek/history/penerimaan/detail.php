<?php
foreach ($record as $row) {

    $nama = $row->nama;

    $tgl_penerimaan_o = $row->tgl_penerimaan_o;

    $no_penerimaan_o = $row->no_penerimaan_o;

    $total_harga = $row->total_harga;
} ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Penjualan Obat</h6>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 20px;">
                <button onclick="window.history.back();" type="button" class="btn btn-sm btn-primary mb-3">Kembali</button>
            </div>
            <table class="table table-borderless" width="100">
                <tr>
                    <th width="11%">Suplier</th>
                    <th width="1%">:</th>
                    <th><?= $nama; ?></th>
                    <th width="11%">Kode</th>
                    <th width="1%">:</th>
                    <th><?= $no_penerimaan_o; ?></th>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <th>:</th>
                    <th><?= $tgl_penerimaan_o; ?></th>
                </tr>
            </table>
            <table class="table table-sm table-borderless" width="100%">
                <thead>
                    <tr>
                        <th width="7%" scope="col">NO</th>
                        <th width="25%" scope="col">NAMA OBAT</th>
                        <th width="8%" scope="col">QTY</th>
                        <th width="15%" scope="col">HARGA</th>
                        <th width="15%" style="text-align:center" scope="col">TOTAL HARGA</th>
                    </tr>

                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    foreach ($detail_record as $row) {
                    ?>
                        <tr>
                            <td width="7%" scope="row"><?= $no; ?></td>
                            <td width="25%"><?= $row->nama_obat; ?></td>
                            <td width="8%"><?= $row->qty_awal; ?></td>
                            <td width="15%" style="text-align:right"><?= rupiah($row->harga_supplier) ?></td>
                            <th width="15%" style="text-align:right"><?= rupiah($row->qty_awal * $row->harga_supplier) ?></th>
                        </tr>
                    <?php $no = $no + 1;
                    } ?>
                </tbody>
            </table>
            <table class="table table-sm table-borderless">
                <tr>
                    <th width="7%"></th>
                    <th width="59%"></th>
                    <th style="text-align:right" width="22%">Grand Total</th>
                    <th style="text-align:right"><?= rupiah($total_harga) ?></th>
                </tr>
            </table>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>