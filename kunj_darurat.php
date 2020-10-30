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
        <h1 class="h3 mb-4 text-gray-800">RL 3.2 Kunjungan Rawat Darurat</h1>
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
                                <th colspan="2">Total Pasien</th>
                                <th colspan="3">Tindak Lanjut Pelayanan</th>
                                <th rowspan="2">Mati di IGD</th>
                                <th rowspan="2">DOA</th>
                            </tr>
                            <tr>
                                <th>Rujukan</th>
                                <th>Non Rujukan</th>
                                <th>Dirawat</th>
                                <th>Dirujuk</th>
                                <th>Pulang</th>
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
                                <th uncollapse="">9</th>
                            </tr>
                        </thead>
                        <tbody id="darurat">

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
        $('#darurat').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_kunjdarurat.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#darurat').html(data);
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
        $("body #darurat tr")
            .not(":last")
            .each(function(e) {
                jumlah += parseInt($(this).find("td:eq(2)").text());
                jumlah2 += parseInt($(this).find("td:eq(3)").text());
                jumlah3 += parseInt($(this).find("td:eq(4)").text());
                jumlah4 += parseInt($(this).find("td:eq(5)").text());
                jumlah5 += parseInt($(this).find("td:eq(6)").text());
                jumlah6 += parseInt($(this).find("td:eq(7)").text());
                jumlah7 += parseInt($(this).find("td:eq(8)").text());
            });
        $("#jumlah").text(jumlah);
        $("#jumlah2").text(jumlah2);
        $("#jumlah3").text(jumlah3);
        $("#jumlah4").text(jumlah4);
        $("#jumlah5").text(jumlah5);
        $("#jumlah6").text(jumlah6);
        $("#jumlah7").text(jumlah7);
    }
    hitungJumlah();

    // function hitungJumlah() {
    //     var jumlah = 0;
    //     $("body #gigi tr")
    //         .not(":last")
    //         .each(function(e) {
    //             var cekAngka = parseInt($(this).find("td:eq(2)").text())
    //             var angkaKonversi = isNaN(cekAngka) ? 0 : cekAngka;
    //             jumlah += angkaKonversi;
    //         });
    //     $("#jumlah").text(jumlah);
    // }
    // hitungJumlah();
</script>