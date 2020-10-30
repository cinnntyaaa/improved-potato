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
<style>
    .icd {
        white-space: normal !important;
        word-break: break-all;
    }
</style>
<main>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 mb-4 text-gray-800">RL 4B Data Keadaan Morbiditas Pasien Rawat Jalan</h1>
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <form action="export5.php" id="cari" method="post" class="form-inline">
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
                    <table class="table table-bordered table-fixed" id="morbidRJ" cellspacing="0" style="align-content: center; color:black;">
                        <!-- <span style="color:black; font-weight:bolder; font-size:larger">Top 10 Diagnoses RJ</span> -->
                        <thead style="text-align: center;">
                            <tr>
                                <th rowspan="3">No. Urut</th>
                                <th rowspan="3">No. DTD</th>
                                <th rowspan="3">No. Daftar Terperinci</th>
                                <th rowspan="3">Golongan Sebab Penyakit</th>
                                <th colspan="18">Jumlah Pasien Kasus Menurut Golongan Umur & Jenis Kelamin</th>
                                <th colspan="2">Kasus Baru Menurut Jenis Kelamin</th>
                                <th rowspan="3">Jumlah Kasus Baru (23 + 24)</th>
                                <th rowspan="3">Jumlah Kunjungan</th>
                            </tr>
                            <tr>
                                <th colspan="2">0-6hr</th>
                                <th colspan="2">7-28hr</th>
                                <th colspan="2">28hr-<1th</th> <th colspan="2">1-4th</th>
                                <th colspan="2">5-14th</th>
                                <th colspan="2">15-24th</th>
                                <th colspan="2">25-44th</th>
                                <th colspan="2">45-64th</th>
                                <th colspan="2">>65th</th>
                                <th rowspan="2">LK</th>
                                <th rowspan="2">PR</th>
                            </tr>
                            <tr>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
                                <th>L</th>
                                <th>P</th>
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
                                <th>12</th>
                                <th>13</th>
                                <th>14</th>
                                <th>15</th>
                                <th>16</th>
                                <th>17</th>
                                <th>18</th>
                                <th>19</th>
                                <th>20</th>
                                <th>21</th>
                                <th>22</th>
                                <th>23</th>
                                <th>24</th>
                                <th>25</th>
                                <th uncollapse="">26</th>
                            </tr>
                        </thead>
                        <tbody id="morbid_rj">

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
        $('#morbid_rj').html('');
        var tanggal1 = $('#tanggal').val()
        var tanggal2 = $('#tanggal2').val()
        console.log(tanggal1, tanggal2)
        $.ajax({
            url: 'proses_morbidRJ.php',
            type: 'POST',
            data: {
                tanggal: tanggal1,
                tanggal2: tanggal2
            },
            dataType: 'html',
            success: function(data) {

                $('#morbid_rj').html(data);
                $('#loader-container').toggleClass('d-block')
            },
            error: function() {
                alert("Something went wrong!");
            }
        });
    })
</script>