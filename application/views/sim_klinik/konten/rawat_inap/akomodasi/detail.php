<?php
foreach ($record as $row) {


    $tanggal = tgl_indo(date('Y-m-d',strtotime($row->tgl_transaksi)));
    $waktu = date('H:i',strtotime($row->tgl_transaksi));

    $no_akomodasi_rawat_i = $row->no_akomodasi_rawat_i;

    $total_harga = $row->total_harga;
} ?>

<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Detail Data Akomodasi</h6>
		</div>
		<div class="card-body">
			<div style="margin-bottom: 20px;">
				<button onclick="window.history.back();" type="button" class="btn btn-sm btn-dark mb-3">Kembali</button>
			</div>
			<table class="table table-borderless" width="100">
				<tr>
					<th width="11%">Kode</th>
					<td width="1%">:</th>
					<td><?php echo $no_akomodasi_rawat_i ?></th>
					<th width="11%">Total Harga</th>
					<td width="1%">:</th>
					<td><?php echo rupiah($total_harga); ?></th>
				</tr>
				<tr>
					<th>Tanggal</th>
					<td>:</th>
					<td><?= $tanggal." ".$waktu; ?></th>
				</tr>
			</table>
			<table class="table table-sm table-bordered" width="100%">
				<thead>
					<tr>
						<th width="25%" scope="col" class="text-center">Rincian</th>
						<th width="8%" scope="col" class="text-center">Qty</th>
						<th width="15%" scope="col" class="text-center">Harga</th>
						<th width="15%" style="text-align:center" scope="col" class="text-center">Subtotal</th>
					</tr>

				</thead>
				<tbody>
                    <?php
                    foreach ($detail_record_logistik as $row_logistik) {
                    ?>
					<tr>
						<td width="25%"><?= $row_logistik->nama; ?></td>
						<td width="8%"><?= $row_logistik->qty; ?></td>
						<td width="15%" style="text-align:right"><?= rupiah($row_logistik->harga) ?></td>
						<th width="15%" style="text-align:right"><?= rupiah($row_logistik->qty * $row_logistik->harga) ?></th>
					</tr>
					<?php } ?>

					<?php
                    foreach ($detail_record_lain as $row_lain) {
                    ?>
					<tr>
						<td width="25%"><?= $row_lain->nama; ?></td>
						<td width="8%"><?= $row_lain->qty; ?></td>
						<td width="15%" style="text-align:right"><?= rupiah($row_lain->harga) ?></td>
						<th width="15%" style="text-align:right"><?= rupiah($row_lain->qty * $row->harga) ?></th>
					</tr>
					<?php } ?>
                    
					<tr>
                        <th style="text-align:center" colspan=3>Grand Total</th>
                        <th style="text-align:right"><?= rupiah($total_harga) ?></th>
				    </tr>
				</tbody>
			</table>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
