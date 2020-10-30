<?php
require "template/template_verifikator/header.php";
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
$klinik = $_POST['klinik'];
$id = $_POST['id'];
?>
<main>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <h1 class="h3 text-gray-800">Nama Poli : <?php echo $klinik; ?></h1>
        <h6 style="font-weight:600">-> Kolom Nomor yang berwarna <span style="color:red">Merah</span> = Pasien Belum Bayar<br>
            -> Kolom No. Antrian yang berwarna <span style="color:orange">Orange</span> = Pasien Batal Periksa</h6>
        <button class="btn btn-primary m-2" onclick="window.location.replace('rekapitulasi.php');" type="button">Kembali</button>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>No. Antrian</th>
                                <th>Status</th>
                                <th>Jaminan</th>
                                <th>Proses</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                            include "koneksii.php";
                            $no = 1;
                            $sql = "SELECT a.no_kunjungan AS 'idkunjungan', a.pasien_id_pasien AS 'id', f.BAYAR AS 'id_lunas', f.NO_KUNJUNGAN AS 'no_kunjungan',
                                        CONCAT(b.kode_poliklinik,a.nomor_antrian) AS 'nomor',
										IF (a.`status` LIKE 'Belum%', 'Belum Dipanggil', 'Telah Dipanggil') AS 'status',
                                        IF(c.nama_jamkes LIKE 'Umum%','UMUM',c.nama_jamkes) AS 'jaminan', a.batal AS 'batal'
                                        FROM `laporan` a
                                        INNER JOIN poliklinik b ON b.id_poliklinik = a.poliklinik_id_poliklinik
                                        INNER JOIN jamkes c ON c.id_jamkes = a.id_jamkes
                                        LEFT JOIN(
                                        SELECT h.NO_KUNJUNGAN AS 'NO_KUNJUNGAN', g.ID_LUNAS AS 'BAYAR'
                                        FROM kasir.lunas g INNER JOIN kasir.kunjungan h ON g.ID_LUNAS = h.ID_LUNAS 
                                        WHERE g.INVALID_LUNAS != 1 
                                        ) f ON f.NO_KUNJUNGAN = a.no_kunjungan
                                        WHERE a.poliklinik_id_poliklinik = " . $_POST['id'] . " AND a.tanggal BETWEEN '" . $tanggal . "' AND '" . $tanggal2 . "' ";
                            $query = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($query)) {
                                $orange = ($data['batal'] == 1 ? '#FF4500' : '');
                                $red = ($data['id_lunas'] == null ? '#FF0000' : '');
                                echo "
                                                <tr>
                                                <td style='text-align:center;'><span style='color:$red'>" . $no . "</span></td>
                                                <td><span style='color:$orange;'>" . $data['nomor'] . "</span></td>
                                                <td>" . ($data['status'] == 'Belum Dipanggil' ? "<span style='color:red;'>" . $data['status'] . "</span>" : "<span style='color:green;'>" . $data['status'] . "</span>") . "</td>
                                                <td>" . $data['jaminan'] . "</td>
                                                <td style='text-align: center;'><form action='batalkan.php' method='post'><input id='submit' type='submit' value='Lihat' class='btn btn-primary'/><input type='hidden' name='idkunj' value='" . $data["idkunjungan"] . "'/><input type='hidden' name='id' value='" . $id . "'/><input type='hidden' name='tanggal' value='" . $tanggal . "'><input type='hidden' name='tanggal2' value='" . $tanggal2 . "'><input type='hidden' name='klinik' value='" . $klinik . "'></form></td>
                                                </tr>";
                                $no++;
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