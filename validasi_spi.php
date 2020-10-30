<?php
session_start();
if (!isset($_SESSION["username"])) {
?>
    <script>
        alert("Silakan Coba Lagi!");
        document.location = 'login.php';
    </script>
<?php
}
if ($_SESSION['level'] !== "SPI" and $_SESSION['level'] === "Petugas RJ") {
?>
    <script>
        document.location = 'dashboard_petugasrj.php';
    </script>
<?php
} else if ($_SESSION['level'] !== "SPI" and $_SESSION['level'] === "Perawat RJ") {
?>
    <script>
        document.location = 'dashboard_perawatrj.php';
    </script>
<?php
} else if ($_SESSION['level'] !== "SPI" and $_SESSION['level'] === "Admin") {
?>
    <script>
        document.location = 'dashboard_admin.php';
    </script>
<?php
}

$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
$klinik = $_POST['klinik'];
$id = $_POST['id'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Verifikator</title>
    <link rel="icon" type="image/png" href="img/logomuh.png">

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">SPI</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_spi.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Ganti Password -->
            <li class="nav-item">
                <a class="nav-link" href="gantipassword_spi.php">
                    <i class="fas fa-users-cog"></i>
                    <span>Ganti Password</span></a>
            </li>

            <!-- Nav Item - Rekapitulasi -->
            <li class="nav-item active">
                <a class="nav-link" href="rekapitulasi2.php">
                    <i class="fas fa-users"></i>
                    <span>Rekapitulasi</span></a>
            </li>

            <!-- Nav Item - Logout -->
            <li class="nav-item">
                <a class="nav-link logout" href="logout.php">
                    <i class="fas fa-power-off"></i>
                    <span>Log Out</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Logo -->
                    <img src="img/rsi.jpg" alt="rsi" style="width:5%">
                    <p>&nbsp</p>
                    <h5 class="m-0  text-primary">Rumah Sakit Islam Muhammadiyah Sumberrejo</h5>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 text-gray-800">Nama Poli : <?php echo $klinik; ?></h1>
                    <h6 style="font-weight:600">-> Kolom Nomor yang berwarna <span style="color:red">Merah</span> = Pasien Belum Bayar<br>
                        -> Kolom No. Antrian yang berwarna <span style="color:orange">Orange</span> = Pasien Batal Periksa</h6>
                    <button class="btn btn-primary m-2" onclick="window.location.replace('rekapitulasi2.php');" type="button">Kembali</button>
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
                                                <td style='text-align:center;'><span style='color:$red;'>" . $no . "</span></td>
                                                <td><span style='color:$orange;'>" . $data['nomor'] . "</span></td>
                                                <td>" . ($data['status'] == 'Belum Dipanggil' ? "<span style='color:red;'>" . $data['status'] . "</span>" : "<span style='color:green;'>" . $data['status'] . "</span>") . "</td>
                                                <td>" . $data['jaminan'] . "</td>
                                                <td style='text-align: center;'><form action='batal_spi.php' method='post'><input id='submit' type='submit' value='Lihat' class='btn btn-primary'/><input type='hidden' name='idkunj' value='" . $data["idkunjungan"] . "'/><input type='hidden' name='id' value='" . $id . "'/><input type='hidden' name='tanggal' value='" . $tanggal . "'><input type='hidden' name='tanggal2' value='" . $tanggal2 . "'><input type='hidden' name='klinik' value='" . $klinik . "'></form></td>
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

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; RSI Muhammadiyah Sumberrejo</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>

</body>

</html>