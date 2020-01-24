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
			<h6 class="m-0 font-weight-bold text-primary">Detail Data Penerimaan Obat/Alkes</h6>
		</div>
		<div class="card-body">
			<div style="margin-bottom: 20px;">
				<button onclick="window.history.back();" type="button" class="btn btn-sm btn-dark mb-3">Kembali</button>
			</div>
			<table class="table table-borderless" width="100">
				<tr>
					<th width="11%">Suplier</th>
					<td width="1%">:</th>
					<td><?= $nama; ?></th>
					<th width="11%">Kode</th>
					<td width="1%">:</th>
					<td><?= $no_penerimaan_o; ?></th>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td>:</th>
					<td><?= $tgl_penerimaan_o; ?></th>
				</tr>
			</table>
			<table class="table table-sm table-bordered" width="100%">
				<thead>
					<tr>
						<th width="7%" scope="col" class="text-center">No.</th>
						<th width="25%" scope="col" class="text-center">Rincian</th>
						<th width="8%" scope="col" class="text-center">Qty</th>
						<th width="15%" scope="col" class="text-center">Harga</th>
						<th width="15%" style="text-align:center" scope="col" class="text-center">Subtotal</th>
					</tr>

				</thead>
				<tbody>
					<?php
                    $no = 1;
                    foreach ($detail_record as $row) {
                    ?>
					<tr>
						<td width="7%" scope="row" ><?php echo $no++.'.'; ?></td>
						<td width="25%"><?= $row->nama_obat; ?></td>
						<td width="8%"><?= $row->qty; ?></td>
						<td width="15%" style="text-align:right"><?= rupiah($row->harga_supplier) ?></td>
						<th width="15%" style="text-align:right"><?= rupiah($row->qty * $row->harga_supplier) ?></th>
					</tr>
					<?php } ?>
					<tr>
					<th style="text-align:center" colspan=4>Grand Total</th>
					<th style="text-align:right"><?= rupiah($total_harga) ?></th>
				</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
