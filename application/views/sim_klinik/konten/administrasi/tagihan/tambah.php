<?php if ($this->session->flashdata('success')) : ?>
	<div class="pesan-sukses" data-flashdata="<?= $this->session->flashdata('success'); ?>"></div>
<?php endif; ?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Tagihan</h6>
		</div>
		<div class="card-body">
			<form method="post" id="transaksi_form">
				<div class="form-row">
					<div class="form-group col-sm-5">
						<label>Cari No Ref</label>
						<select class="form-control form-control-sm noRef" name="no_ref_pelayanan" required>
						</select>
					</div>
					<div class="form-group col-sm-1">
                    </div>
                    <div class="form-group col-sm-3">
                        <label>Grand Total</label>
						<input type="text" name="asd" class="form-control form-control-sm" readonly>
                    </div>


				</div>

				<div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h5>* Balai Pengobatan</h5>
                                <a href="#" id="btn_search" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan BP</span>
                                </a>
					        </div>
                            <div class="form-group col-sm-6">
                                <h5>* Poli Kia</h5>
                                    <a href="#" id="btn_search" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                        <span class="text">Cari Tindakan KIA</span>
                                    </a>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan BP</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" readonly name="total_harga" class="form-control form-control-sm rupiah text-right" id="total_harga" placeholder="Total" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan KIA</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" readonly name="total_harga" class="form-control form-control-sm rupiah text-right" id="total_harga" placeholder="Total" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                        </div>
                    </div>
				</div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <h5>* Laboratorium</h5>
                                <a href="#" id="btn_search" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-search-plus"></i>
                                    </span>
                                    <span class="text">Cari Tindakan Lab</span>
                                </a>
					        </div>
                            <div class="form-group col-sm-6">
                                <h5>* UGD</h5>
                                    <a href="#" id="btn_search" class="btn btn-sm btn-primary btn-icon-split" data-toggle="modal" data-target="#exampleModalCenter">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-search-plus"></i>
                                        </span>
                                        <span class="text">Cari Tindakan UGD</span>
                                    </a>
                            </div>
                        </div>
                    </div>
				</div>
                <div class="form-row">
                    <div class="col-sm-12">
                        <div class="row">
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan Lab</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" readonly name="total_harga" class="form-control form-control-sm rupiah text-right" id="total_harga" placeholder="Total" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                            <div class="form-group col-sm-6">
                                <div class="row">
                                    <div class="col-sm-6">Nama Tindakan UGD</div>
                                    <div class="col-sm-6">Biaya</div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- start untuk keranjang tindakan -->
                                        <div id="detail_list">
                                            <!-- disini isi detail -->
                                            <h6 id="label_kosong">Detail Tindakan Masih Kosong!</h6>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-5">
                                    </div>
                                    <div class="col-sm-5">
                                        <input type="text" readonly name="total_harga" class="form-control form-control-sm rupiah text-right" id="total_harga" placeholder="Total" required>
                                    </div>
                                    <div class="col-sm-2">
                                    </div>
                                </div>
					        </div>
                        </div>
                    </div>
				</div>
			</form>
		</div>
	</div>

</div>

<!-- Modal -->
<div class="modal fade  bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Stok Obat Apotek</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<div class="table-responsive">
					<table class="table table-bordered table_1" width="100%" cellspacing="0">
						<thead>
							<tr>
								<th>No</th>
								<th>Nama Obat</th>
								<th>Kategori</th>
								<th>Tanggal Penerimaan</th>
								<th>Stok Saat Ini</th>
								<th>Harga Jual</th>
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody id="daftar_barang">
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
<script type="text/javascript">
$('.noRef').select2({
	ajax:{
		url : "<?= base_url('administrasi/tagihan/tampil_select') ?>",
		dataType : "json",
		delay : 250,
		data : function(params){
			return {
				no_ref : params.term,
				nama : params.term
			};
		},
		processResults : function(data) {
			var results = [];

			$.each(data,function(index,item){
				results.push({
					id : item.no_ref_pelayanan,
					text : item.no_ref_pelayanan + " || " + item.nama					
				});
			});
			return {
				results : results
			}
		}
	}
})
</script>