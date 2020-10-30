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
    <script type="text/javascript">
        function batalkan() {
            const param = document.getElementsByName("id");
            const btn_batal = document.getElementById("batal_btn");

            exchanger(param[1].value, "batal1.php", function(res) {
                if (res > 0) {
                    console.log(res + " query1 berhasil diubah.");

                    exchanger(param[1].value, "batal2.php", function(ros) {
                        if (ros > 0) {
                            console.log(ros + " query2 berhasil diubah.");
                            alert("data berhasil dibatalkan");

                            btn_batal.disabled = true;
                        } else {
                            alert("Gagal ubah pulang simrs");
                        }
                    });

                } else {
                    alert("Tidak ada data yang di ubah.");
                }
            });
        }

        function exchanger(idk, alamat, callback) {
            var xhr;
            if (window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else {
                xhr = new ActiveXObject("Microsoft.XMLHTTP");
            }

            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    callback(xhr.responseText);
                }
            }

            xhr.onerror = function() {
                callback("404 Network Unavailable..!");
            }

            xhr.open("POST", alamat, true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send("idkunjungan=" + idk);
        }
    </script>

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
                    <form action="validasi_spi.php" method="post">
                        <button class="btn btn-primary m-2" type="submit">Kembali</button>
                        <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
                        <input type="hidden" name="tanggal2" value="<?php echo $tanggal2; ?>">
                        <input type="hidden" name="klinik" value="<?php echo $klinik; ?>">
                        <input type="hidden" name="id" value="<?php echo $id; ?>">
                    </form>

                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                                    <thead style="text-align: center;">
                                        <tr>
                                            <th>No.</th>
                                            <th>No. RM</th>
                                            <th>Nama</th>
                                            <th>Unit Pelayanan</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include "koneksii2.php";
                                        $no = 1;
                                        $sql = "SELECT b.kunjungan_id AS 'idkunj', c.no_rm AS 'rm', c.nama AS 'nama',
                                        CONCAT ('<li>', GROUP_CONCAT(d.nama SEPARATOR '</li><li>'),'</li>') AS 'unit',
                                        CONCAT('<li>', GROUP_CONCAT(
                                        IF(b.dilayani > 0,' Sudah Dilayani',' Belum dilayani') SEPARATOR '</li><li>'),'</li>') AS 'status',
                                        a.batal as 'batal'
                                        FROM `b_kunjungan` a
                                        INNER JOIN b_ms_pasien c ON c.id = a.pasien_id
                                        LEFT JOIN b_pelayanan b ON b.kunjungan_id = a.id
                                        INNER JOIN b_ms_unit d ON d.id = b.unit_id
                                        WHERE a.id = " . $_POST['idkunj'] . "";
                                        $query = mysqli_query($conn, $sql);
                                        while ($data = mysqli_fetch_array($query)) {
                                            echo "
                                                <tr>
                                                <td style='text-align: center;'>" . $no . "</td>
                                                <td>" . $data['rm'] . "</td>
                                                <td>" . $data['nama'] . "</td>
                                                <td>" . $data['unit'] . "</td>
                                                <td>" . $data['status'] . "</td>
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