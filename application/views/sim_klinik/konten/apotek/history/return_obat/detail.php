<?php
foreach ($record as $row) {


    $tanggal = tgl_indo(date('Y-m-d',strtotime($row->tanggal)));
    $waktu = date('H:i',strtotime($row->tanggal));
    $no_return_obat = $row->no_return_obat;
} ?>

<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Detail Data Return Obat</h6>
        </div>
        <div class="card-body">
            <div style="margin-bottom: 20px;">
                <button onclick="window.history.back();" type="button" class="btn btn-sm btn-dark mb-3">Kembali</button>
            </div>
            <table class="table table-borderless" width="100">
                <tr>
                    <th>Tanggal</th>
                    <td>:</th>
                    <td><?= $tanggal." ".$waktu; ?></th>
                    <th>Kode</th>
                    <td>:</th>
                    <td><?= $no_return_obat; ?></th>
                </tr>
            </table>
            <table class="table table-sm table-bordered" width="100%">
                <thead>
                    <tr>
                        <th width="7%" scope="col" class="text-center">No.</th>
                        <th width="25%" scope="col" class="text-center">Nama Obat</th>
                        <th width="8%" scope="col" class="text-center">Qty</th>
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
                            <td width="8%"><?= $row->qty_detail; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>