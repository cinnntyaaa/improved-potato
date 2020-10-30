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
        <h1 class="h3 mb-4 text-gray-800">RL 3.9 Pelayanan Rehabilitasi Medik</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="#" id="cari" method="post" class="form-inline">
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
                    <table class="table table-bordered table-fixed" cellpadding="2" cellspacing="0" style="align-content: center; color:black;">
                        <!-- <span style="color:black;">A. Pengadaan Obat</span> -->
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Jenis Tindakan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="rehabmedik1">
                            <tr>
                                <td>1</td>
                                <td colspan="2" style="font-weight: bold;">Medis</td>
                            </tr>
                            <tr>
                                <td>1.1</td>
                                <td>Gait Analyzer</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.2</td>
                                <td>EMG</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.3</td>
                                <td>Uro Dinamic</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.4</td>
                                <td>Side Back</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.5</td>
                                <td>E N Tree</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.6</td>
                                <td>Spyrometer</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.7</td>
                                <td>Static Bicycle</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.8</td>
                                <td>Tread Mill</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.9</td>
                                <td>Body Platysmograf</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>1.10</td>
                                <td>Lain-lain</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td colspan="2" style="font-weight: bold;">Fisioterapi</td>
                            </tr>
                            <tr>
                                <td>2.1</td>
                                <td>Latihan Fisik</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.2</td>
                                <td>Aktinoterapi</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.3</td>
                                <td>Elektroterapi</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.4</td>
                                <td>Hidroterapi</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.5</td>
                                <td>Traksi Lumbal & Cervical</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>2.6</td>
                                <td>Lain-lain</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td colspan="2" style="font-weight: bold;">Okupasiterapi</td>
                            </tr>
                            <tr>
                                <td>3.1</td>
                                <td>Snoosien Room</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.2</td>
                                <td>Sensori Integrasi</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.3</td>
                                <td>Latihan Aktivitas Kehidupan Sehari-hari</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.4</td>
                                <td>Proper Body Mekanik</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.5</td>
                                <td>Pembuatan Alat Lontar & Adaptasi Alat</td>
                                <td></td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table table-bordered table-fixed" cellpadding="2" cellspacing="0" style="align-content: center; color:black;">
                        <!-- <span style="color:black;">A. Pengadaan Obat</span> -->
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>Jenis Tindakan</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        <tbody id="rehabmedik2">
                            <tr>
                                <td>3.6</td>
                                <td>Analisa Persiapan Kerja</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.7</td>
                                <td>Latihan Relaksasi</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.8</td>
                                <td>Analisa dan Intervensi, Persepsi, Kognitif, Psikomotor</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>3.9</td>
                                <td>Lain-lain</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td colspan="2" style="font-weight: bold;">Terapi Wicara</td>
                            </tr>
                            <tr>
                                <td>4.1</td>
                                <td>Fungsi Bicara</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4.2</td>
                                <td>Fungsi Bahasa/Laku</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4.3</td>
                                <td>Fungsi Menelan</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>4.4</td>
                                <td>Lain-lain</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td colspan="2" style="font-weight: bold;">Psikologi</td>
                            </tr>
                            <tr>
                                <td>5.1</td>
                                <td>Psikologi Anak</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5.2</td>
                                <td>Psikologi Dewasa</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>5.3</td>
                                <td>Lain-lain</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td colspan="2" style="font-weight: bold;">Sosial Media</td>
                            </tr>
                            <tr>
                                <td>6.1</td>
                                <td>Evaluasi Lingkungan Rumah</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6.2</td>
                                <td>Evaluasi Ekonomi</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6.3</td>
                                <td>Evaluasi Pekerjaan</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>6.4</td>
                                <td>Lain-lain</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td colspan="2" style="font-weight: bold;">Ortotik Prostetik</td>
                            </tr>
                            <tr>
                                <td>7.1</td>
                                <td>Pembuatan Alat Bantu</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7.2/td>
                                <td>Pembuatan Alat Anggota Tiruan</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>7.3</td>
                                <td>Lain-lain</td>
                                <td></td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td colspan="2" style="font-weight: bold;">Kunjungan Rumah</td>
                            </tr>
                            <tr>
                                <td>99</td>
                                <td>Total</td>
                                <td></td>
                            </tr>
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
        $('#kegiatan-radiologi').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_kegradiologi.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#kegiatan-radiologi').html(data);
                $('#loader-container').toggleClass('d-block');
                hitungJumlah()
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })

    function hitungJumlah() {
        var jumlah1 = 0;
        $("body #kegiatan-radiologi tr")
            .not(":last")
            .each(function(e) {
                jumlah1 += parseInt($(this).find("td:eq(2)").text());
            });
        $("#jumlah1").text(jumlah1);
    }
    hitungJumlah();
</script>