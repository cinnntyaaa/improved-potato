<?php require "template/template_verifikator/header.php" ?>
<script>
    function printContent(el) {
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#tanggal2_tampil').text($('#tanggal2').val());
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
        <h1 class="h3 mb-4 text-gray-800">RL 5.3 dan 5.4 Daftar 10 Besar Penyakit</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export2.php" id="cari" method="post" class="form-inline">
                    <h5 class="m-0 font-weight-bold text-primary">Pilih Tanggal :</h5>
                    <div class="form-group mx-sm-3">
                        <input id="tanggal" name="tanggal" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" required />
                    </div>
                    <h5 class="m-0 font-weight-bold text-primary">s/d</h5>
                    <div class="form-group mx-sm-3">
                        <input id="tanggal2" name="tanggal2" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" required />
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Cari</button>
                    <div class="form-group mx-sm-2">
                        <button id="submit2" type="submit" class="btn btn-primary">Export to Excel</button>
                    </div>
                    <div class="form-group">
                        <button id="print" onclick="printContent('tabel')" class="btn btn-primary">Print</button>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive" id="tabel">
                    <p style="color:black; font-weight:bolder; font-size:larger">Tanggal : <span id="tanggal_tampil"></span> s/d <span id="tanggal2_tampil"></span></p>
                    <table class="table table-bordered" id="topten1" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <span style="color:black; font-weight:bolder; font-size:larger">Daftar 10 Besar Penyakit RJ</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No. Urut</th>
                                <th rowspan="2">Kode ICD 10</th>
                                <th rowspan="2">Deskripsi</th>
                                <th colspan="2">Kasus Baru Menurut Jenis Kelamin</th>
                                <th rowspan="2">Jumlah Kasus Baru(4+5)</th>
                                <th rowspan="2">Jumlah Kunjungan</th>
                            </tr>
                            <tr>
                                <th>LK</th>
                                <th>PR</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th uncollapse="">7</th>
                            </tr>
                        </thead>
                        <tbody id="topten_rj">

                        </tbody>
                    </table>
                    <table class="table table-bordered" id="topten2" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <span style="color:black; font-weight:bolder; font-size:larger">Daftar 10 Besar Penyakit RI</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No. Urut</th>
                                <th rowspan="2">Kode ICD 10</th>
                                <th rowspan="2">Deskripsi</th>
                                <th colspan="2">Pasien Keluar Hidup Menurut Jenis Kelamin</th>
                                <th colspan="2">Pasien Keluar Mati Menurut Jenis Kelamin</th>
                                <th rowspan="2">Total (Hidup & Mati)</th>
                            </tr>
                            <tr>
                                <th>LK</th>
                                <th>PR</th>
                                <th>LK</th>
                                <th>PR</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th uncollapse="">8</th>
                            </tr>
                        </thead>
                        <tbody id="topten_ri">

                        </tbody>
                    </table>
                    <table class="table table-bordered" id="topten3" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <span style="color:black; font-weight:bolder; font-size:larger">Daftar 10 Besar Penyakit IGD</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>ICD</th>
                                <th>Deskripsi</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="topten_igd">

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
<script>
    $(function() {
        $('#tanggal').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    })

    $(function() {
        $('#tanggal2').datepicker({
            format: "yyyy-mm-dd",
            autoclose: true
        });
    })

    $('body').on('click', '#submit', function(e) {
        e.preventDefault();
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#tanggal2_tampil').text($('#tanggal2').val());
        $('#loader-container').toggleClass('d-block')
        $('#topten_rj').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_toptenRJ.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#topten_rj').html(data);
                $('#loader-container').toggleClass('d-block')
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'proses_toptenRI.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#topten_ri').html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'proses_toptenIGD.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#topten_igd').html(data);
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })
</script>