<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Penerimaan Obat</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th width="5%" class="text-center">No</th>
                            <th width="15%" class="text-center">Kode</th>
                            <th width="10%">Tanggal</th>
                            <th width="20%">Nama Pasien</th>
                            <th width="15%" class="text-center">Total Harga</th>
                            <th width="15%" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $no = 1;
                        foreach ($record as $data) :
                        ?>
                            <tr>
                                <td class="text-center"><?= $no++ ?></td>
                                <td class="text-center"><?= $data->no_penerimaan_o ?></td>
                                <td><?= $data->tgl_penerimaan_o ?></td>
                                <td><?= $data->nama ?></td>
                                <td class="text-right"><?= rupiah($data->total_harga) ?></td>
                                <td class="text-center">
                                    <a href="<?= base_url('apotek/penerimaan/tampil_detail_daftar_penerimaan_obat?no_penerimaan_o=' . $data->no_penerimaan_o) ?>" class="btn btn-sm btn-danger">Lihat</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>