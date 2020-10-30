<?php
error_reporting(0);
session_start();
if (!isset($_SESSION["username"])) {
?>
    <script>
        alert("Silakan Coba Lagi!");
        document.location = 'login.php';
    </script>
<?php
}
if ($_SESSION['level'] !== "Perawat RJ" and $_SESSION['level'] === "Petugas RJ") {
?>
    <script>
        document.location = 'dashboard_petugasrj.php';
    </script>
<?php
} else if ($_SESSION['level'] !== "Perawat RJ" and $_SESSION['level'] === "Admin") {
?>
    <script>
        document.location = 'dashboard_admin.php';
    </script>
<?php
} else if ($_SESSION['level'] !== "Perawat RJ" and $_SESSION['level'] === "Verifikator") {
?>
    <script>
        document.location = 'dashboard_verifikator.php';
    </script>
<?php
}

$id_antrian = $_POST['id_antrian'];
$no_antrian = $_POST['no_antrian'];
$no_pelayanan;
if (isset($_POST['no_pelayanan'])) {
    $no_pelayanan = $_POST['no_pelayanan'];
}


?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Apotek RJ</title>
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
                <div class="sidebar-brand-text mx-3">Apotek RJ</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_apotekrj.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Antrian -->
            <li class="nav-item active">
                <a class="nav-link" href="panggil_apotekrj.php">
                    <i class="fas fa-users"></i>
                    <span>Antrian</span></a>
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
                    <h1 class="h3 mb-4 text-gray-800">Nomor Antrian: <font color="navy"><?php echo $no_antrian; ?></font>
                    </h1>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Panggil Antrian, <?php echo " ID: " . $id_antrian . " Tanggal: " . date("d-m-Y"); ?></h6>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form id="panggil-antrian" action="" method="post">
                                    <input type="hidden" name="id_antrianpanggil" value="<?php echo $id_antrian; ?>">
                                    <input type="hidden" name="id_antrian" value="<?php echo $id_antrian; ?>">
                                    <input type="hidden" name="no_antrian" value="<?php echo $no_antrian; ?>">
                                    <button class="btn btn-primary btn-lg m-2" type="submit" id="panggil">Panggil</button><br>
                                </form>

                                <button class="btn btn-primary btn-lg m-2" onclick="location.href='panggil_apotekrj.php'" type="button">Lewati</button>

                                <form action="selesaiapotekrj.php" id="selesai" method="post">
                                    <button class="btn btn-primary btn-lg m-2" id="selesai2" type="submit">Selesai</button>
                                    <input type="hidden" name="id_antrian" value="<?php echo $id_antrian; ?>">
                                    <input type="hidden" name="no_pelayanan" value="<?php echo $no_pelayanan; ?>">
                                </form>
                            </div>
                            <?php
                            include "koneksii.php";
                            $id_antrianpanggil = isset($_POST['id_antrianpanggil']);
                            if ($id_antrianpanggil) {
                                $sql = "INSERT into audible set antrian_id_antrian = " . $_POST['id_antrianpanggil'];
                                $query = mysqli_query($conn, $sql);
                                $status = mysqli_affected_rows($conn);
                                if ($status) {
                                    echo '<script>alert("Berhasil memanggil");</script>';
                                } else {
                                    echo '<script>alert("Gagal memanggil");</script>';
                                }
                            }
                            ?>
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

    <script>
        $('#selesai').on('submit', function() {
            $.ajax({
                url: "selesaiapotekrj.php", //the page containing php script
                type: "POST", //request type
                success: function(result) {},
                error: function() {
                    alert("Something went wrong!");
                }
            });
        })
    </script>

</body>

</html>