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
                            <input type="hidden" id="kode_antrian_bp" name="kode_antrian_bp">
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-12">
                            <button class="btn btn-google btn-block"><i class="fas fa-forward"></i></i> lanjut</button>
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
                            <input type="hidden" id="kode_antrian_kia" name="kode_antrian_kia">
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-baby-carriage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-12">
                            <button class="btn btn-google btn-block"><i class="fas fa-forward"></i></i> lanjut</button>
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
                            <div id="antrian_lap" class="h5 mb-0 font-weight-bold text-gray-800">Antrian Kosong</div>
                            <input type="hidden" id="kode_antrian_lab" name="kode_antrian_lab">
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-flask fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">
                        <a class="col mr-12">
                            <button class="btn btn-google btn-block"><i class="fas fa-forward"></i></i> lanjut</button>
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <tbody>
                                <?php
                                foreach ($antrian_bp as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $row->kode_antrian_bp; ?></td>
                                        <td><?= $row->nama; ?></td>
                                        <td>

                                            <?php
                                                if (substr($row->kode_antrian_bp, 0, 2) == "AG") {
                                                    echo '
    
                                                        <button class="btn btn-block prioritas_balai_pengobatan" id="' . $row->kode_antrian_bp . '">
                                                            <i class="far fa-hand-pointer"></i> Prioritas
                                                        </button>
                                                    ';
                                                }
                                                ?>

                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <tbody>
                                <?php
                                foreach ($antrian_kia as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $row->kode_antrian_kia; ?></td>
                                        <td><?= $row->nama; ?></td>
                                    </tr>
                                <?php
                                }
                                ?>
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
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
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
                            <tbody>

                                <?php
                                foreach ($antrian_lab as $row) {
                                    ?>
                                    <tr>
                                        <td><?= $row->kode_antrian_lab; ?></td>
                                        <td><?= $row->nama; ?></td>
                                        <td>

                                            <?php
                                                if (substr($row->kode_antrian_lab, 0, 2) == "CG") {
                                                    echo '
    
                                                        <button class="btn btn-block prioritas_laboratorium" id="' . $row->kode_antrian_lab . '">
                                                            <i class="far fa-hand-pointer"></i> Prioritas
                                                        </button>
                                                    ';
                                                }
                                                ?>

                                        </td>

                                    </tr>
                                <?php
                                }
                                ?>
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

    $(document).on('click', '.prioritas_balai_pengobatan', function() {
        var id = $(this).attr("id");

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/click_prioritas_balai_pengobatan'; ?>",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                refresh_antrian_sekarang_bp();
            }
        });

    });

    $(document).on('click', '.prioritas_laboratorium', function() {
        var id = $(this).attr("id");

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/click_prioritas_laboratorium'; ?>",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
                refresh_antrian_sekarang_lab();
            }
        });

    });

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

                    document.getElementById("antrian_lap").innerHTML = id + " (" + nama + ")";

                    $("#kode_antrian_lab").val(data[0].kode_antrian_lab);

                }
            }
        });
    }
</script>