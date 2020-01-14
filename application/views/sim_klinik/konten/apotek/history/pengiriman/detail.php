<?php
foreach ($record as $row) {

    $no_obat_keluar_i = $row->no_obat_keluar_i;
    $tujuan = $row->tujuan;
    $tgl_obat_keluar_i = $row->tgl_obat_keluar_i;
} ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Transfer Obat</h6>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 20px;">
                <button onclick="window.history.back();" type="button" class="btn btn-sm btn-dark mb-3">Kembali</button>
            </div>
            <table class="table table-borderless" width="100">
                <tr>
                    <th width="11%">Kode</th>
                    <th width="1%">:</th>
                    <th><?= $no_obat_keluar_i; ?></th>
                    <th width="11%">Tujuan</th>
                    <th width="1%">:</th>
                    <th><?= $tujuan; ?></th>
                </tr>
                <tr>
                    <th>Tanggal</th>
                    <th>:</th>
                    <th><?= $tgl_obat_keluar_i; ?></th>
                </tr>
            </table>
            <table class="table table-sm table-borderless" width="100%">
                <thead>
                    <tr>
                        <th width="7%" scope="col">NO</th>
                        <th width="25%" scope="col">NAMA OBAT</th>
                        <th width="8%" scope="col">QTY</th>
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
                            <td width="8%"><?= $row->qty; ?></td>
                        </tr>
                    <?php $no = $no + 1;
                    } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>