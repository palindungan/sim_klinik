<?php if($this->session->flashdata('success')) : ?>
<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<?php if($this->session->flashdata('update')) : ?>
<div class="pesan-update" data-flashdata="<?= $this->session->flashdata('update'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Data Pasien</h6>
		</div>
		<div class="card-body">

			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>

			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Pasien</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<?php echo form_open('admin/pasien/store'); ?>
						<div class="modal-body">
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">No RM</label>
									<input type="text" name="no_rm" class="form-control form-control-sm"
										id="inputEmail2" placeholder="Masukan NO RM" required>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Nama</label>
									<input type="text" name="nama" class="form-control form-control-sm" id="inputEmail2"
										placeholder="Masukkan Nama" required>
								</div>
							</div>
							<div class="form-row">
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Alamat</label>
									<textarea class="form-control form-control-sm" name="alamat"
										placeholder="Masukan alamat" id="exampleFormControlTextarea1" rows="2"
										required></textarea>
								</div>
								<div class="form-group col-sm-6">
									<label for="inputEmail2">Umur</label>
									<textarea class="form-control form-control-sm karakterAngka" name="umur"
										placeholder="Masukan Umur" id="exampleFormControlTextarea1" required></textarea>
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
				<table class="table table-bordered table_pasien" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">No</th>
							<th class="text-center">No RM</th>
							<th class="text-center">Nama</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>
<script>
$(document).ready(function() {
	//DOM manipulation code
	search_proses();
	
});

function search_proses() {
	var table;
	table = $('.table_pasien').DataTable({
		"processing": true,
		"serverSide": true,
		"ajax": "<?php echo base_url() . 'admin/pasien/showDataPasienFastLoad'; ?>",
		"columnDefs":[{
            "targets": -1,
			"className": "text-center",
            render: function (data, type, row, meta) {
                // return '<a type="button" class="btn btn-danger btn-block" href="http://google.com"  >删除</a>';
				return '<button class="btn btn-sm btn-warning btn-edit">Edit Data</button> <button class="btn btn-sm btn-info btn-detail">Detail Kunjungan</button>'
            }
        } ]
	});

	$('.table_pasien tbody').on( 'click', '.btn-edit', function () {
        var data = table.row( $(this).parents('tr') ).data();
		var url = "<?php echo base_url().'admin/pasien/view_edit/'; ?>"+data[0]+"" ;
		window.location = url;
    } );

	$('.table_pasien tbody').on( 'click', '.btn-detail', function () {
        var data = table.row( $(this).parents('tr') ).data();
        // alert( data[0] +"'s salary is: "+ data[ 3 ] );
		var url = "<?php echo base_url().'admin/pasien/list/'; ?>"+data[0]+"" ;
		window.location = url;
    } );
}
</script>