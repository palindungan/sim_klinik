<div class="container-fluid">

    <div class="row">

        <!-- Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Balai Pengobatan : </div>
                            <div id="antrian_bp" class="h5 mb-0 font-weight-bold text-gray-800">Antrian Kosong</div>
                            <input type="text" id="kode_antrian_bp" name="kode_antrian_bp">
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-12">
                            <button class="btn btn-google btn-block lanjut_bp"><i class="fas fa-forward"></i></i> lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Poli KIA : </div>
                            <div id="antrian_kia" class="h5 mb-0 font-weight-bold text-gray-800">Antrian Kosong</div>
                            <input type="text" id="kode_antrian_kia" name="kode_antrian_kia">
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-baby-carriage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-12">
                            <button class="btn btn-google btn-block lanjut_kia"><i class="fas fa-forward"></i></i> lanjut</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Laboratorium : </div>
                            <div id="antrian_lab" class="h5 mb-0 font-weight-bold text-gray-800">Antrian Kosong</div>
                            <input type="text" id="kode_antrian_lab" name="kode_antrian_lab">
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flask fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <a class="col mr-12">
                            <button class="btn btn-google btn-block lanjut_lab"><i class="fas fa-forward"></i></i> lanjut</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <div class="row">

        <div class="col-lg-4">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Antrian Balai Pengobatan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table_bp" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody id="daftar_antrian_bp">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Antrian Poli KIA</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table_kia" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                </tr>
                            </tfoot>
                            <tbody id="daftar_antrian_kia">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Antrian Laboratorium</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table_lab" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>No.</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </tfoot>
                            <tbody id="daftar_antrian_lab">

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>

    </div>

</div>

<script src="<?= base_url(); ?>assets/sb_admin_2/vendor/jquery/jquery-3.4.1.min.js"></script>

<script>
    refresh_antrian_sekarang_bp();
    refresh_antrian_sekarang_kia();
    refresh_antrian_sekarang_lab();

    $(document).ready(function() {

        refresh_tabel_antrian_bp();
        refresh_tabel_antrian_kia();
        refresh_tabel_antrian_lab();

    });

    function refresh_tabel_antrian_bp() {

        var table;
        table = $('.table_bp').DataTable();

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/tampil_daftar_antrian_bp'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    $.each(data, function(i, item) {

                        var btn_aksi = "";
                        if (data[i].kode_antrian_bp.length == 5) {
                            var btn_aksi = `

                                <button onclick="click_prioritas_bp('` + data[i].kode_antrian_bp + `')" id="` + data[i].kode_antrian_bp + `" class="btn btn-block">
                                    <i class="far fa-hand-pointer"></i> Prioritas
                                </button>
                            
                            `;
                        }

                        table.row.add([data[i].kode_antrian_bp, data[i].nama, btn_aksi]);

                    });
                } else {
                    $('.table_bp').html('<h4>Data Antrian Kosong</h4>');
                }
                table.draw();

            }
        });
    }

    function refresh_tabel_antrian_kia() {
        var table;
        table = $('.table_kia').DataTable();

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/tampil_daftar_antrian_kia'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    $.each(data, function(i, item) {

                        table.row.add([data[i].kode_antrian_kia, data[i].nama]);

                    });
                } else {
                    $('.table_kia').html('<h4>Data Antrian Kosong</h4>');
                }
                table.draw();

            }
        });
    }

    function refresh_tabel_antrian_lab() {
        var table;
        table = $('.table_lab').DataTable();

        table.clear();

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/tampil_daftar_antrian_lab'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    $.each(data, function(i, item) {

                        var btn_aksi = "";
                        if (data[i].kode_antrian_lab.length == 5) {
                            var btn_aksi = `

                                <button onclick="click_prioritas_lab('` + data[i].kode_antrian_lab + `')" id="` + data[i].kode_antrian_lab + `" class="btn btn-block">
                                    <i class="far fa-hand-pointer"></i> Prioritas
                                </button>
                            
                            `;
                        }

                        table.row.add([data[i].kode_antrian_lab, data[i].nama, btn_aksi]);

                    });
                } else {
                    $('.table_lab').html('<h4>Data Antrian Kosong</h4>');
                }
                table.draw();

            }
        });
    }

    function click_prioritas_bp(param) {
        var id = param;

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/click_prioritas_balai_pengobatan'; ?>",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                refresh_antrian_sekarang_bp();
                refresh_tabel_antrian_bp();
            }
        });
    }

    function click_prioritas_lab(param) {
        var id = param;

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/click_prioritas_laboratorium'; ?>",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                refresh_antrian_sekarang_lab();
                refresh_tabel_antrian_lab();
            }
        });
    }

    function refresh_antrian_sekarang_bp() {

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/refresh_antrian_sekarang_bp'; ?>",
            success: function(hasil) {
                var obj = JSON.parse(hasil);
                let data = obj['result_data'];

                if (data != '') {

                    var id = data[0].kode_antrian_bp;
                    var nama = data[0].nama;

                    document.getElementById("antrian_bp").innerHTML = id + " (" + nama + ")";

                    $("#kode_antrian_bp").val(data[0].kode_antrian_bp);

                }
            }
        });
    }

    function refresh_antrian_sekarang_kia() {

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/refresh_antrian_sekarang_kia'; ?>",
            success: function(hasil) {
                var obj = JSON.parse(hasil);
                let data = obj['result_data'];

                if (data != '') {

                    var id = data[0].kode_antrian_kia;
                    var nama = data[0].nama;

                    document.getElementById("antrian_kia").innerHTML = id + " (" + nama + ")";

                    $("#kode_antrian_kia").val(data[0].kode_antrian_kia);

                }
            }
        });
    }

    function refresh_antrian_sekarang_lab() {

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/refresh_antrian_sekarang_lab'; ?>",
            success: function(hasil) {
                var obj = JSON.parse(hasil);
                let data = obj['result_data'];

                if (data != '') {

                    var id = data[0].kode_antrian_lab;
                    var nama = data[0].nama;

                    document.getElementById("antrian_lab").innerHTML = id + " (" + nama + ")";

                    $("#kode_antrian_lab").val(data[0].kode_antrian_lab);

                }
            }
        });
    }

    $(document).on('click', '.lanjut_bp', function() {

        if (confirm('Ingin Lanjut Antrian Balai Pengobatan ?')) {
            var kode_antrian_bp = document.getElementById("kode_antrian_bp");
            var value = kode_antrian_bp.value;

            $.ajax({
                url: "<?php echo base_url() . 'loket/antrian/click_lanjut_balai_pengobatan'; ?>",
                method: "POST",
                data: {
                    id: value
                },
                success: function(data) {
                    refresh_antrian_sekarang_bp();
                    refresh_tabel_antrian_bp();
                }
            });
        }

    });

    $(document).on('click', '.lanjut_kia', function() {

        if (confirm('Ingin Lanjut Antrian Kesehatan Ibu dan Anak ?')) {
            var kode_antrian_kia = document.getElementById("kode_antrian_kia");
            var value = kode_antrian_kia.value;

            $.ajax({
                url: "<?php echo base_url() . 'loket/antrian/click_lanjut_kesehatan_ibu_dan_anak'; ?>",
                method: "POST",
                data: {
                    id: value
                },
                success: function(data) {
                    refresh_antrian_sekarang_kia();
                    refresh_tabel_antrian_kia();
                }
            });
        }


    });

    $(document).on('click', '.lanjut_lab', function() {

        if (confirm('Ingin Lanjut Antrian Laboratorium ?')) {
            var kode_antrian_lab = document.getElementById("kode_antrian_lab");
            var value = kode_antrian_lab.value;

            $.ajax({
                url: "<?php echo base_url() . 'loket/antrian/click_lanjut_laboratorium'; ?>",
                method: "POST",
                data: {
                    id: value
                },
                success: function(data) {
                    refresh_antrian_sekarang_lab();
                    refresh_tabel_antrian_lab();
                }
            });
        }

    });
</script>