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
        <h1 class="h3 mb-4 text-gray-800">RL 5.1 dan 5.2</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export3.php" id="cari" method="post" class="form-inline">
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
                        <button id="print" onclick="printContent('tabel2')" class="btn btn-primary">Print</button>
                    </div>
                </form>

            </div>
            <div class="card-body">
                <div class="table-responsive" id="tabel2">
                    <p style="color:black; font-weight:bolder; font-size:larger">Tanggal : <span id="tanggal_tampil"></span> s/d <span id="tanggal2_tampil"></span></p>
                    <p style="color:black; font-weight:bolder; font-size:larger">RL 5.1 Pengunjung Rumah Sakit</span></p>
                    <table class="table table-bordered" id="pengunjung_lamabaru" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Jenis Kegiatan</th>
                                <th>Jumlah</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                            </tr>
                        </thead>
                        <tbody id="pengunjung_rs">

                        </tbody>
                    </table>
                    <p style="color:black; font-weight:bolder; font-size:larger">RL 5.2 Kunjungan Rawat Jalan</span></p>
                    <table class="table table-bordered" id="kun_rj" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Jenis Kegiatan</th>
                                <th>Jumlah</th>
                            </tr>
                            <tr>
                                <th>1</th>
                                <th>2</th>
                                <th>3</th>
                            </tr>
                        </thead>
                        <tbody id="kunjungan_rj">

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
        $('#pengunjung_rs').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_pengunjungrs.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#pengunjung_rs').html(data);
                $('#loader-container').toggleClass('d-block')
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
        $.ajax({
            url: 'proses_kunjunganrs.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#kunjungan_rj').html(data);
                hitungJumlah()
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })

    function hitungJumlah() {
        var jumlah1 = 0;
        $("body #kunjungan_rj tr")
            .not(":last")
            .each(function(e) {
                jumlah1 += parseInt($(this).find("td:eq(2)").text());
            });
        $("#jumlah1").text(jumlah1);
    }
    hitungJumlah();
</script>