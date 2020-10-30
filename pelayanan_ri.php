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
        <h1 class="h3 mb-4 text-gray-800">RL 3.1 Kegiatan Pelayanan Rawat Inap</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export13.php" id="cari" method="post" class="form-inline">
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
                    <table class="table table-bordered table-fixed" cellspacing="0" style="align-content: center; color:black;">
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Jenis Pelayanan</th>
                                <th rowspan="2">Pasien Masuk</th>
                                <th rowspan="2">Pasien Keluar Hidup</th>
                                <th colspan="2">Pasien Keluar Mati</th>
                                <th rowspan="2">Jumlah Lama Dirawat</th>
                                <th rowspan="2">Jumlah Hari Perawatan</th>
                                <th colspan="4">Rincian Hari Perawatan Per Kelas</th>
                            </tr>
                            <tr>
                                <th>< 48 Jam</th>
                                <th>≥ 48 Jam</th>
                                <th>I</th>
                                <th>II</th>
                                <th>III</th>
                                <th>Kelas Khusus</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th>5</th>
                                <th>6</th>
                                <th>7</th>
                                <th>8</th>
                                <th>9</th>
                                <th>10</th>
                                <th>11</th>
                                <th uncollapse="">12</th>
                            </tr>
                        </thead>
                        <tbody id="rawatinap">

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
        $('#rawatinap').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_pelayananRI.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#rawatinap').html(data);
                $('#loader-container').toggleClass('d-block');
                hitungJumlah()
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })
    function hitungJumlah() {
        var jumlah = 0;
        var jumlah2 = 0;
        var jumlah3 = 0;
        var jumlah4 = 0;
        var jumlah5 = 0;
        var jumlah6 = 0;
        var jumlah7 = 0;
        var jumlah8 = 0;
        var jumlah9 = 0;
        var jumlah10 = 0;
        $("body #rawatinap tr")
            .not(":last")
            .each(function(e) {
                var cekAngka = parseInt($(this).find("td:eq(2)").text())
                cekAngka2 = parseInt($(this).find("td:eq(3)").text());
                cekAngka3 = parseInt($(this).find("td:eq(4)").text());
                cekAngka4 = parseInt($(this).find("td:eq(5)").text());
                cekAngka5 = parseInt($(this).find("td:eq(6)").text());
                cekAngka6 = parseInt($(this).find("td:eq(7)").text());
                cekAngka7 = parseInt($(this).find("td:eq(8)").text());
                cekAngka8 = parseInt($(this).find("td:eq(9)").text());
                cekAngka9 = parseInt($(this).find("td:eq(10)").text());
                cekAngka10 = parseInt($(this).find("td:eq(11)").text());
                var angkaKonversi = isNaN(cekAngka) ? 0 : cekAngka;
                jumlah += angkaKonversi;
                jumlah2 += angkaKonversi;
                jumlah3 += angkaKonversi;
                jumlah4 += angkaKonversi;
                jumlah5 += angkaKonversi;
                jumlah6 += angkaKonversi;
                jumlah7 += angkaKonversi;
                jumlah8 += angkaKonversi;
                jumlah9 += angkaKonversi;
                jumlah10 += angkaKonversi;
            });
        $("#jumlah").text(jumlah);
        $("#jumlah2").text(jumlah2);
        $("#jumlah3").text(jumlah3);
        $("#jumlah4").text(jumlah4);
        $("#jumlah5").text(jumlah5);
        $("#jumlah6").text(jumlah6);
        $("#jumlah7").text(jumlah7);
        $("#jumlah8").text(jumlah5);
        $("#jumlah9").text(jumlah6);
        $("#jumlah10").text(jumlah7);
    }
    hitungJumlah();
</script>