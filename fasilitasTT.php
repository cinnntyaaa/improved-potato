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
        <h1 class="h3 mb-4 text-gray-800">RL 1.3 Fasilitas Tempat Tidur Rawat Inap</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export13.php" id="cari" method="post" class="form-inline">
                    <!-- <h5 class="m-0 font-weight-bold text-primary">Pilih Tanggal :</h5>
                    <div class="form-group mx-sm-3">
                        <input id="tanggal" name="tanggal" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" required />
                    </div>
                    <h5 class="m-0 font-weight-bold text-primary">s/d</h5>
                    <div class="form-group mx-sm-3">
                        <input id="tanggal2" name="tanggal2" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" required />
                    </div>
                    <button id="submit" type="submit" class="btn btn-primary">Cari</button> -->
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
                    <!-- <p style="color:black; font-weight:bolder; font-size:larger">Tanggal : <span id="tanggal_tampil"></span> s/d <span id="tanggal2_tampil"></span></p> -->
                    <table class="table table-bordered table-fixed" cellspacing="0" style="align-content: center; color:black;">
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="2">No.</th>
                                <th rowspan="2">Jenis Pelayanan</th>
                                <th rowspan="2">Jumlah TT</th>
                                <th colspan="4">Perincian Tempat Tidur Per-Kelas</th>
                            </tr>
                            <tr>
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
                                <th uncollapse="">7</th>
                            </tr>
                        </thead>
                        <tbody id="ttRI">
                            <?php
                            include "koneksii2.php";
                            $no = 1;
                            $sql = "CALL RL_1_3";
                            $outp = array();
                            // Execute multi query
                            if (mysqli_multi_query($conn, $sql)) {
                                do {
                                    // Store first result set
                                    if ($result = mysqli_store_result($conn)) {
                                        $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                                        // Fetch one and one row
                                    }
                                } while (mysqli_next_result($conn));
                                foreach ($outp[0] as $data) {
                                    echo "
                                    <tr>
                                    <td style='text-align: center;'>" . $no . "</td>
                                    <td>" . $data['unit'] . "</td>
                                    <td style='text-align: right;'>" . $data['sum_tt'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
                                    </tr>";
                                    $no++;
                                }
                                foreach ($outp[1] as $data) {
                                    echo "
                                    <tr>
                                    <td style='text-align: center;'>" . $no . "</td>
                                    <td>" . $data['unit'] . "</td>
                                    <td style='text-align: right;'>" . $data['sum_tt'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
                                    </tr>";
                                    $no++;
                                }
                                foreach ($outp[2] as $data) {
                                    echo "
                                    <tr>
                                    <td style='text-align: center;'>" . $no . "</td>
                                    <td>" . $data['unit'] . "</td>
                                    <td style='text-align: right;'>" . $data['sum_tt'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
                                    </tr>";
                                    $no++;
                                }
                                foreach ($outp[3] as $data) {
                                    echo "
                                    <tr>
                                    <td style='text-align: center;'>" . $no . "</td>
                                    <td>" . $data['unit'] . "</td>
                                    <td style='text-align: right;'>" . $data['sum_tt'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
                                    </tr>";
                                    $no++;
                                }
                                foreach ($outp[4] as $data) {
                                    echo "
                                    <tr>
                                    <td style='text-align: center;'>" . $no . "</td>
                                    <td>" . $data['unit'] . "</td>
                                    <td style='text-align: right;'>" . $data['sum_tt'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
                                    <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
                                    </tr>";
                                    $no++;
                                }
                                echo "
                                <tr>
                                <td style='text-align: center;'>99</td>
                                <td>TOTAL</td>
                                <td id='jumlah' style='text-align: right;'></td>
                                <td id='jumlah2' style='text-align: right;'></td>
                                <td id='jumlah3' style='text-align: right;'></td>
                                <td id='jumlah4' style='text-align: right;'></td>
                                <td id='jumlah5' style='text-align: right;'></td>
                                </tr>";
                            }
                            ?>
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
        $('#ttRI').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_fasilitasTT.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#ttRI').html(data);
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
        $("body #gigi tr")
            .not(":last")
            .each(function(e) {
                var cekAngka = parseInt($(this).find("td:eq(2)").text())
                var angkaKonversi = isNaN(cekAngka) ? 0 : cekAngka;
                jumlah += angkaKonversi;
            });
        $("#jumlah").text(jumlah);
    }
    hitungJumlah();
</script>