<?php require "template/template_verifikator/header.php" ?>
<!-- <script>
    function printContent(el) {
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#tanggal2_tampil').text($('#tanggal2').val());
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }
</script> -->
<main>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">RL 3.13 Pengadaan Obat, Penulisan dan Pelayanan Resep</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export8.php" id="cari" method="post" class="form-inline">
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
                        <button id="print" class="btn btn-primary">Print</button>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive" id="tabel">
                    <p style="color:black; font-weight:bolder; font-size:larger">Tanggal : <span id="tanggal_tampil"></span> s/d <span id="tanggal2_tampil"></span></p>
                    <table class="table table-bordered table-fixed" id="obat" cellspacing="0" style="align-content: center; color:black;">
                        <span style="color:black;">A. Pengadaan Obat</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Golongan Obat</th>
                                <th>Jumlah Item Obat</th>
                                <th>Jumlah Item Obat yang Tersedia di RS</th>
                                <th>Jumlah Item Obat Formulatorium Tersedia di RS</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th uncollapse="">5</th>
                            </tr>
                        </thead>
                        <tbody id="pengadaan-obat">

                        </tbody>
                    </table>
                    <table class="table table-bordered table-fixed" id="resep" cellspacing="0" style="align-content: center; color:black;">
                        <span style="color:black;">B. Penulisan dan Pelayanan Resep</span>
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Golongan Obat</th>
                                <th>Rawat Jalan</th>
                                <th>IGD</th>
                                <th>Rawat Inap</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                                <th>4</th>
                                <th uncollapse="">5</th>
                            </tr>
                        </thead>
                        <tbody id="penulisan-resep">

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

    $('body').on('click', '#print', function(e) {
        e.preventDefault();
        var tanggal1 = $('#tanggal').val();
        var tanggal2 = $('#tanggal2').val();
        if (tanggal1 == '' || tanggal2 == '') {
            alert('Ga ada isinya!');
            return false;
        }
        window.open('printpreview1.php?t1=' + tanggal1 + '&t2=' + tanggal2 + '');
    })

    $('body').on('click', '#submit', function(e) {
        e.preventDefault();
        $('#tanggal_tampil').text($('#tanggal').val());
        $('#tanggal2_tampil').text($('#tanggal2').val());
        $('#loader-container').toggleClass('d-block')
        $('#pengadaan-obat').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_pengadaanobat.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#pengadaan-obat').html(data);
                $('#loader-container').toggleClass('d-block');
                hitungJumlah()
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'proses_penulisanresep.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#penulisan-resep').html(data);
                hitungJumlah2()
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })

    function hitungJumlah() {
        var jumlah1 = 0;
        var jumlah2 = 0;
        var jumlah3 = 0;
        $("body #pengadaan-obat tr")
            .not(":last")
            .each(function(e) {
                jumlah1 += parseInt($(this).find("td:eq(2)").text());
                jumlah2 += parseInt($(this).find("td:eq(3)").text());
                jumlah3 += parseInt($(this).find("td:eq(4)").text());
            });
        $("#jumlah1").text(jumlah1);
        $("#jumlah2").text(jumlah2);
        $("#jumlah3").text(jumlah3);
    }
    hitungJumlah();

    function hitungJumlah2() {
        var jumlah4 = 0;
        var jumlah5 = 0;
        var jumlah6 = 0;
        $("body #penulisan-resep tr")
            .not(":last")
            .each(function(e) {
                jumlah4 += parseInt($(this).find("td:eq(2)").text());
                jumlah5 += parseInt($(this).find("td:eq(3)").text());
                jumlah6 += parseInt($(this).find("td:eq(4)").text());
            });
        $("#jumlah4").text(jumlah4);
        $("#jumlah5").text(jumlah5);
        $("#jumlah6").text(jumlah6);
    }
    hitungJumlah2();
</script>