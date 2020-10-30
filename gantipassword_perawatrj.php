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
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">


    <title>Admin</title>
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
                <div class="sidebar-brand-text mx-3">Perawat RJ</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item">
                <a class="nav-link" href="dashboard_perawatrj.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Nav Item - Ganti Password -->
            <li class="nav-item active">
                <a class="nav-link" href="gantipassword_perawatrj.php">
                    <i class="fas fa-users-cog"></i>
                    <span>Ganti Password</span></a>
            </li>

            <!-- Nav Item - Antrian -->
            <li class="nav-item">
                <a class="nav-link" href="panggilantrian_poli.php">
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
                    <div class="col-lg-12">
                        <!-- Basic Card Example -->
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-primary" style="text-align: center;">Ganti Password</h6>
                            </div>
                            <div class="card-body" style="align-self: center;">
                                <a href="#" class="btn btn-danger btn-icon-split" data-toggle="modal" data-target="#changeModal">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-exchange-alt"></i>
                                    </span>
                                    <span class="text">Ganti Password Akun</span>
                                </a>
                            </div>
                        </div>


                    </div>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Modal Change Pw -->
            <div class="modal fade" id="changeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Ganti Password?</h5>
                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">×</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form name='changepw' method='post' action="" enctype="multipart/form-data">
                                <div class="form-group">
                                    <input type="password" class="form-control" id="password" name="password" aria-describedby="emailHelp" placeholder="Masukkan Password">
                                </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                    </form>
                    <?php
                    include "koneksii.php";
                    if (isset($_POST['simpan'])) {
                        if (!empty($_POST['password'])) {
                            $password = md5($_POST['password']);
                            $sql = "update petugas set pass='" . $password . "' where username like '" . $_SESSION['username'] . "'";
                            $query = mysqli_query($conn, $sql);
                            if ($query) {
                                echo '<script>alert("Password Telah Berhasil Diganti");</script>';
                            }
                        } else {
                            echo '<script>alert("Password Tidak Boleh Kosong")</script>';
                        }
                    }
                    ?>
                </div>
            </div>

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