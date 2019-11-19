<div class="container-fluid">

    <div class="row">

        <!-- Card Example -->
        <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">

                            <div class="text-xs mb-1 font-weight-bold text-primary text-uppercase">
                                Balai Pengobatan :
                            </div>

                            <div id="antrian_bp" class="h5 mb-10 font-weight-bold text-gray-800">
                                Antrian Kosong
                            </div>

                            <input type="hidden" id="kode_antrian_bp" name="kode_antrian_bp">

                        </div>

                        <div class="col-auto">
                            <i class="fas fa-clinic-medical fa-2x text-gray-300"></i>
                        </div>

                    </div>
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-12">
                            <button class="btn btn-google btn-block lanjut_bp">
                                <i class="fas fa-forward"></i></i> lanjut
                            </button>
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

                            <div class="text-xs mb-1 font-weight-bold text-primary text-uppercase">
                                Poli KIA :
                            </div>

                            <div id="antrian_kia" class="h5 mb-10 font-weight-bold text-gray-800">
                                Antrian Kosong
                            </div>

                            <input type="hidden" id="kode_antrian_kia" name="kode_antrian_kia">

                        </div>

                        <div class="col-auto">
                            <i class="fas fa-baby-carriage fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="row no-gutters align-items-center">

                        <div class="col mr-12">
                            <button class="btn btn-google btn-block lanjut_kia">
                                <i class="fas fa-forward"></i></i> lanjut
                            </button>
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
                            <div class="text-xs mb-1 font-weight-bold text-primary text-uppercase">
                                Laboratorium :
                            </div>
                            <div id="antrian_lab" class="h5 mb-10 font-weight-bold text-gray-800">
                                Antrian Kosong
                            </div>
                            <input type="hidden" id="kode_antrian_lab" name="kode_antrian_lab">
                        </div>

                        <div class="col-auto">
                            <i class="fas fa-flask fa-2x text-gray-300"></i>
                        </div>

                    </div>
                    <div class="row no-gutters align-items-center">

                        <a class="col mr-12">
                            <button class="btn btn-google btn-block lanjut_lab">
                                <i class="fas fa-forward"></i></i> lanjut
                            </button>
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
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="daftar_antrian_bp">

                            </tbody>
                        </table>
                    </div>
                    <div id="bp_foot" ></div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <!-- Custom Text Color Utilities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Antrian Poli KIA</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table_bp" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                </tr>
                            </thead>
                            <tbody id="daftar_antrian_kia">

                            </tbody>
                        </table>
                    </div>
                    <div id="kia_foot" ></div>
                </div>
            </div>

        </div>

        <div class="col-lg-4">

            <!-- Custom Text Color Utilities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Antrian Laboratorium</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table_bp" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody id="daftar_antrian_lab">

                            </tbody>
                        </table>
                    </div>
                    <div id="lab_foot" ></div>
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
                }
            });
        }

    });

    function click_prioritas_bp(param) {
        var id = param;

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/click_prioritas_balai_pengobatan'; ?>",
            method: "POST",
            data: {
                id: id
            },
            success: function(data) {
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
                refresh_tabel_antrian_lab();
            }
        });
    }

    function refresh_antrian_sekarang_bp() {

        document.getElementById("antrian_bp").innerHTML = "Antrian Kosong";
        $("#kode_antrian_bp").val('Antrian Kosong');

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/refresh_antrian_sekarang_bp'; ?>",
            success: function(hasil) {

                if (hasil != 'Antrian Kosong') {

                    var obj = JSON.parse(hasil);
                    let data = obj['result_data'];

                    var id = data[0].kode_antrian_bp;
                    var nama = data[0].nama;

                    document.getElementById("antrian_bp").innerHTML = nama + " (" + id + ")";
                    $("#kode_antrian_bp").val(data[0].kode_antrian_bp);

                }

                refresh_tabel_antrian_bp();
            }
        });
    }

    function refresh_antrian_sekarang_kia() {

        document.getElementById("antrian_kia").innerHTML = "Antrian Kosong";
        $("#kode_antrian_kia").val('Antrian Kosong');

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/refresh_antrian_sekarang_kia'; ?>",
            success: function(hasil) {

                if (hasil != 'Antrian Kosong') {

                    var obj = JSON.parse(hasil);
                    let data = obj['result_data'];

                    var id = data[0].kode_antrian_kia;
                    var nama = data[0].nama;

                    document.getElementById("antrian_kia").innerHTML = nama + " (" + id + ")";
                    $("#kode_antrian_kia").val(data[0].kode_antrian_kia);

                }

                refresh_tabel_antrian_kia();
            }
        });
    }

    function refresh_antrian_sekarang_lab() {

        document.getElementById("antrian_lab").innerHTML = "Antrian Kosong";
        $("#kode_antrian_lab").val('Antrian Kosong');

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/refresh_antrian_sekarang_lab'; ?>",
            success: function(hasil) {


                if (hasil != 'Antrian Kosong') {

                    var obj = JSON.parse(hasil);
                    let data = obj['result_data'];

                    var id = data[0].kode_antrian_lab;
                    var nama = data[0].nama;

                    document.getElementById("antrian_lab").innerHTML = nama + " (" + id + ")";
                    $("#kode_antrian_lab").val(data[0].kode_antrian_lab);

                }

                refresh_tabel_antrian_lab();
            }
        });
    }

    function refresh_tabel_antrian_bp() {

        document.getElementById("daftar_antrian_bp").innerHTML = "";

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/tampil_daftar_antrian_bp'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var kode_antrian_sekarang = $("#kode_antrian_bp").val();

                    $.each(data, function(i, item) {

                        var btn_aksi = "";
                        var kode_antrian = data[i].kode_antrian_bp;
                        var nama = data[i].nama;
                        var status = data[i].status;
                        var button_val = "Normal";
                        var bg = "";
                        var no = i + 1;

                        if (status == "Prioritas") {
                            button_val = "Prioritas";
                            bg = "bg-gradient-warning text-white";
                        }

                        if (kode_antrian.length == 5) {
                            btn_aksi = `

                                <div class="row">
                                    <div class="col-md-12">
                                        <button onclick="click_prioritas_bp('` + kode_antrian + `')" id="` + kode_antrian + `" class="btn py-1 btn-light btn col-md-12">
                                        ` + button_val + `
                                        </button>
                                    </div>
                                </div>
                            
                            `;
                        }

                        if (kode_antrian_sekarang != kode_antrian) {
                            $('#daftar_antrian_bp').append(`

                                <tr class="` + bg + `">
                                    <td>` + kode_antrian + `</td>
                                    <td>` + nama + `</td>
                                    <td>` + btn_aksi + `</td>
                                </tr>

                            `);
                        }

                    });
                } else {
                    document.getElementById("bp_foot").innerHTML = "<h5>Data Antrian Kosong</h5>";
                }
            }
        });
    }

    function refresh_tabel_antrian_kia() {

        document.getElementById("daftar_antrian_kia").innerHTML = "";

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/tampil_daftar_antrian_kia'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var kode_antrian_sekarang = $("#kode_antrian_kia").val();

                    $.each(data, function(i, item) {

                        var kode_antrian = data[i].kode_antrian_kia;
                        var nama = data[i].nama;
                        var bg = "";
                        var no = i + 1;

                        if (kode_antrian_sekarang != kode_antrian) {
                            $('#daftar_antrian_kia').append(`

                                <tr class="` + bg + `">
                                    <td>` + kode_antrian + `</td>
                                    <td>` + nama + `</td>
                                </tr>

                            `);
                        }

                    });
                } else {
                    document.getElementById("kia_foot").innerHTML = "<h5>Data Antrian Kosong</h5>";
                }
            }
        });
    }

    function refresh_tabel_antrian_lab() {

        document.getElementById("daftar_antrian_lab").innerHTML = "";

        $.ajax({
            url: "<?php echo base_url() . 'loket/antrian/tampil_daftar_antrian_lab'; ?>",
            success: function(hasil) {

                var obj = JSON.parse(hasil);
                let data = obj['tbl_data'];

                if (data != '') {

                    var kode_antrian_sekarang = $("#kode_antrian_lab").val();

                    $.each(data, function(i, item) {

                        var btn_aksi = "";
                        var kode_antrian = data[i].kode_antrian_lab;
                        var nama = data[i].nama;
                        var status = data[i].status;
                        var button_val = "Normal";
                        var bg = "";
                        var no = i + 1;

                        if (status == "Prioritas") {
                            button_val = "Prioritas";
                            bg = "bg-gradient-warning text-white";
                        }

                        if (kode_antrian.length == 5) {
                            btn_aksi = `

                                <div class="row">
                                    <div class="col-md-12">
                                        <button onclick="click_prioritas_lab('` + kode_antrian + `')" id="` + kode_antrian + `" class="btn py-1 btn-light btn col-md-12">
                                        ` + button_val + `
                                        </button>
                                    </div>
                                </div>
                            
                            `;
                        }

                        if (kode_antrian_sekarang != kode_antrian) {
                            $('#daftar_antrian_lab').append(`

                                <tr class="` + bg + `">
                                    <td>` + kode_antrian + `</td>
                                    <td>` + nama + `</td>
                                    <td>` + btn_aksi + `</td>
                                </tr>

                            `);
                        }

                    });
                } else {
                    document.getElementById("lab_foot").innerHTML = "<h5>Data Antrian Kosong</h5>";
                }
            }
        });
    }
</script>