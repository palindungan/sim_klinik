<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">List Kunjungan <?= $pasien ?></h6>
		</div>
		<div class="card-body">
            <div class="container">
            <a href="<?= base_url('admin/pasien') ?>" class="btn btn-link">Kembali</a>
                <div class="row">
                <?php 
                foreach($list as $list_detail):
                    $tgl = date('Y-m-d',strtotime($list_detail->tgl_pelayanan));
                    ?>
                    <div class="col-sm-3">
                        <div class="card">
                            <div class="card-body">
                                <h6><?= tgl_indo($tgl); ?></h6>
                                <h6><?= $list_detail->layanan_tujuan ?></h6>
                                <a href="<?= base_url('admin/pasien/detail/'.$list_detail->no_ref_pelayanan) ?>" class="btn btn-sm btn-info">Detail</a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </div>
		</div>
	</div>
</div>