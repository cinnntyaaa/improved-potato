<?php require "template/template_verifikator/header.php" ?>
<script>
    function printContent(el) {
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#unit_tampil').text($('#unit option:selected').text());
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script>
<main>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">Sensus RI - Harian</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export.php" id="cari" method="post" class="form-inline">
                    <div class="form-group mx-sm-2">
                        <input id="tanggal" name="tanggal" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" required />
                    </div>
                    <div class="form-group mx-sm-2">
                        <select id="unit" name="unit" class="form-control" required>
                            <?php
                            include "koneksii2.php";
                            $sql = "CALL unitSensusRI('2017-10-01', NOW());";
                            $query = mysqli_query($conn, $sql);
                            ?>
                            <?php if (mysqli_num_rows($query) > 0) { ?>
                                <?php while ($row = mysqli_fetch_array($query)) { ?>
                                    <option value="<?php echo $row['kode']; ?>">
                                        <?php echo $row['nama'] ?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Cari</button>
                    <div class="form-group mx-sm-2">
                        <button id="submit2" type="submit" class="btn btn-primary">Export to Excel</button>
                    </div>
                    <div class="form-group">
                        <button id="print" onclick="printContent('tabel5')" class="btn btn-primary">Print</button>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive" id="tabel5">
                    <p style="color:black; font-weight:bolder; font-size:larger">Tanggal : <span id="tanggal_tampil"></span></p>
                    <p style="color:black; font-weight:bolder; font-size:larger">Unit : <span id="unit_tampil"></span></p>
                    <table class="table table-bordered" id="pasien_awal" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <span style="color:black;">A. Pasien Awal : </span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>No. RM</th>
                                <th>Nama</th>
                                <th>Sex</th>
                                <th>Usia</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Jaminan</th>
                                <th>DPJP</th>
                                <th>Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody id="pasien_awal_body">

                        </tbody>
                    </table>
                    <table class="table table-bordered" id="pasien_masuk" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <span style="color:black">B. Pasien Masuk :</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>No. RM</th>
                                <th>Nama</th>
                                <th>Sex</th>
                                <th>Usia</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Jaminan</th>
                                <th>DPJP</th>
                                <th>Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody id="pasien_masuk_body">

                        </tbody>
                    </table>
                    <table class="table table-bordered" id="pasien_pindahan" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <span style="color:black">C. Pasien Pindahan :</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>No. RM</th>
                                <th>Nama</th>
                                <th>Sex</th>
                                <th>Usia</th>
                                <th>Alamat</th>
                                <th>Kelas</th>
                                <th>Jaminan</th>
                                <th>DPJP</th>
                                <th>Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody id="pasien_pindahan_body">

                        </tbody>
                    </table>
                    <table class="table table-bordered" id="pasien_pindah" cellspacing="0" style=" align-content: center; color:black;">
                        <span style="color:black">D. Pasien Pindah :</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal</th>
                                <th>No. RM</th>
                                <th>Nama</th>
                                <th>Sex</th>
                                <th>Usia</th>
                                <th>Alamat</th>
                                <th>Unit</th>
                                <th>Kelas</th>
                                <th>Jaminan</th>
                                <th>DPJP</th>
                                <th>Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody id="pasien_pindah_body">

                        </tbody>
                    </table>
                    <table class="table table-bordered" id="pasien_pulang" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <span style=color:black>E. Pasien Pulang :</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Tanggal Masuk</th>
                                <th>No. RM</th>
                                <th>Nama</th>
                                <th>Sex</th>
                                <th>Usia</th>
                                <th>Alamat</th>
                                <th>Cara Pulang</th>
                                <th>Keadaan Pulang</th>
                                <th>Kelas</th>
                                <th>Jaminan</th>
                                <th>DPJP</th>
                                <th>Diagnosa</th>
                            </tr>
                        </thead>
                        <tbody id="pasien_pulang_body">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</main>
<?php require "template/template_verifikator/footer.php" ?>
<!-- // tambahan ini -->
<script>
    $(function() {
        $('#tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    })

    $('body').on('click', '#submit', function(e) {
        e.preventDefault();
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#unit_tampil').text($('#unit option:selected').text());
        $('#loader-container').toggleClass('d-block')
        $('#pasien_awal_body').html('');
        var tanggal1 = $('#tanggal').val()
        var unit = $('#unit').val()
        console.log(tanggal1, unit)
        $.ajax({
            url: 'awal_harian_ri.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                unit: unit
            },
            dataType: 'html',
            success: function(data) {
                console.log($("#pasien_awal_body"));
                $('#pasien_awal_body').html(data);
                $('#loader-container').toggleClass('d-block')
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'masuk_harian_ri.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                unit: unit
            },
            dataType: 'html',
            success: function(data) {
                console.log($("#pasien_masuk_body"));
                $('#pasien_masuk_body').html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'pindahan_harian_ri.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                unit: unit
            },
            dataType: 'html',
            success: function(data) {
                console.log($("#pasien_pindahan_body"));
                $('#pasien_pindahan_body').html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'pindah_harian_ri.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                unit: unit
            },
            dataType: 'html',
            success: function(data) {
                console.log($("#pasien_pindah_body"));
                $('#pasien_pindah_body').html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'pulang_harian_ri.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                unit: unit
            },
            dataType: 'html',
            success: function(data) {
                console.log($("#pasien_pulang_body"));
                $('#pasien_pulang_body').html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })
</script>