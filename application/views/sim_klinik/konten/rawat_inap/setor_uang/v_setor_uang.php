<?php if($this->session->flashdata('success')) : ?>
<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Setor Uang</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Setor Uang</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('rawat_inap/setorUang/store'); ?>
						<div class="modal-body">
							<div class="form-row">
                                <div class="form-group col-sm-6">
									<label for="inputEmail2">Jumlah Saldo</label>
									<input type="number" name="jumlah_saldo" class="form-control form-control-sm karakterAngka"
										id="jumlah_saldo" value="<?php echo $jumlah_saldo; ?>" readonly required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Jumlah Setor</label>
									<input type="number" name="jumlah_setor" class="form-control form-control-sm karakterAngka"
										id="jumlah_setor" placeholder="Masukan Jumlah Setor" onkeyup="hitung();" required>
                                </div>
                                <div class="form-group col-sm-6">
									<label for="inputEmail2">Sisa Saldo</label>
									<input type="number" name="sisa_saldo" class="form-control form-control-sm karakterAngka"
										id="sisa_saldo" readonly required>
								</div>
							</div>
						</div>
						<div class="modal-footer">
							<button type="submit" class="btn btn-sm btn-success">Simpan</button>
							<button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
						</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">Tanggal Setor</th>
							<th class="text-center">Jumlah</th>
						</tr>
					</thead>
					<tbody>
						<?php
						$no=1;
						foreach($record as $data):
                        ?>
						<tr>
							<td><?= $no++.'.' ?></td>
							<td><?= $data->tanggal_setor; ?></td>
							<td class="text-right"><?= number_format($data->jumlah_setor,0,',','.'); ?></td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
    function hitung(){
        var new_saldo = $("#jumlah_saldo").val() - $("#jumlah_setor").val();
        $("#sisa_saldo").val(new_saldo);
    }
</script>