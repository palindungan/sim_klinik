<div class="container-fluid">
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
                        <table class="table table-bordered table-sm" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama</th>
                                    <th>Aksi</th>
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
        <!-- <div class="col-lg-4">
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

        </div> -->

        <div class="col-lg-4">

            <!-- Custom Text Color Utilities -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Daftar Antrian Laboratorium</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-sm" width="100%" cellspacing="0">
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
    // refresh_antrian_sekarang_bp();
    // refresh_antrian_sekarang_kia();
    // refresh_antrian_sekarang_lab();

    refresh_tabel_antrian_bp();
    refresh_tabel_antrian_kia();
    refresh_tabel_antrian_lab();

    $(document).on('click', '.lanjut_bp', function() {

        if (confirm('Ingin Lanjut Antrian Balai Pengobatan ?')) {
            var kode_antrian_bp = document.getElementById("kode_antrian_bp");
            var value = kode_antrian_bp.value;

            $.ajax({
                url: "<?php echo base_url() . 'loket/antrian/tampil_daftar_antrian_bp'; ?>",
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

                        var id_antri = data[i].id_antri_bp;
                        var kode_antrian = data[i].kode_antrian_bp;
                        var nama = data[i].nama;
                        var bg = "";
                        var no = i + 1;

                        if(kode_antrian.length == 6){
                            bg = "bg-gradient-primary text-white";
                        }

                        btn_aksi = `<button onclick="jsPilihAntrianBP('`+id_antri+`')" class="btn btn-sm py-1 btn-warning">Pilih</button>`;

                        $('#daftar_antrian_bp').append(`
                                <tr class="` + bg + `">
                                    <td>` + kode_antrian + `</td>
                                    <td>` + nama + `</td>
                                    <td>` + btn_aksi + `</td>
                                </tr>
                            `);
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

                    $.each(data, function(i, item) {

                        var id_antri = data[i].id_antri_kia;
                        var kode_antrian = data[i].kode_antrian_kia;
                        var nama = data[i].nama;
                        var bg = "";
                        var no = i + 1;

                        if(kode_antrian.length == 5){
                            bg = "bg-gradient-primary text-white";
                        }

                        btn_aksi = `<button onclick="jsPilihAntrianKIA('`+id_antri+`')" class="btn btn-sm py-1 btn-warning">Pilih</button>`;

                        $('#daftar_antrian_kia').append(`
                            <tr class="` + bg + `">
                                <td>` + kode_antrian + `</td>
                                <td>` + nama + `</td>
                                <td class="text-center">` + btn_aksi + `</td>
                            </tr>
                        `);

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

                    $.each(data, function(i, item) {

                        var id_antri = data[i].id_antri_lab;
                        var kode_antrian = data[i].kode_antrian_lab;
                        var nama = data[i].nama;
                        var bg = "";
                        var no = i + 1;

                        if(kode_antrian.length == 5){
                            bg = "bg-gradient-primary text-white";
                        }
                        btn_aksi = `<button onclick="jsPilihAntrianLab('`+id_antri+`')" class="btn btn-sm py-1 btn-light">Pilih</button>`;

                        $('#daftar_antrian_lab').append(`
                            <tr class="` + bg + `">
                                <td>` + kode_antrian + `</td>
                                <td>` + nama + `</td>
                                <td class="text-center">` + btn_aksi + `</td>
                            </tr>
                        `);

                    });
                } else {
                    document.getElementById("lab_foot").innerHTML = "<h5>Data Antrian Kosong</h5>";
                }
            }
        });
    }

    function jsPilihAntrianBP(id){
        if (confirm('Lanjut ?')) {
            $.ajax({
                url: "<?php echo base_url() . 'loket/antrian/aksiPilihAntrianBP'; ?>",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    refresh_tabel_antrian_bp();
                }
            });
        }
    }

    function jsPilihAntrianKIA(id){
        if (confirm('Lanjut ?')) {
            $.ajax({
                url: "<?php echo base_url() . 'loket/antrian/aksiPilihAntrianKIA'; ?>",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    refresh_tabel_antrian_kia();
                }
            });
        }
    }

    function jsPilihAntrianLab(id){
        if (confirm('Lanjut ?')) {
            $.ajax({
                url: "<?php echo base_url() . 'loket/antrian/aksiPilihAntrianLab'; ?>",
                method: "POST",
                data: {
                    id: id
                },
                success: function(data) {
                    refresh_tabel_antrian_lab();
                }
            });
        }
    }
</script>