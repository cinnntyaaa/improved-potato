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
if ($_SESSION['level'] !== "Admin" and $_SESSION['level'] === "Petugas RJ") {
?>
  <script>
    document.location = 'dashboard_petugasrj.php';
  </script>
<?php
} else if ($_SESSION['level'] !== "Admin" and $_SESSION['level'] === "Perawat RJ") {
?>
  <script>
    document.location = 'dashboard_perawatrj.php';
  </script>
<?php
} else if ($_SESSION['level'] !== "Admin" and $_SESSION['level'] === "Verifikator") {
?>
  <script>
    document.location = 'dashboard_verifikator.php';
  </script>
<?php
}
?>
<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
include "koneksii.php";
$upd = $_GET['upd'];
$sql = "select * from jamkes where id_jamkes='$upd' ";
$query = mysqli_query($conn, $sql);
$hasil = mysqli_fetch_array($query);
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
        <div class="sidebar-brand-text mx-3">Admin</div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="dashboard_admin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Dashboard </span></a>
      </li>

      <!-- Nav Item - Ganti Password -->
      <li class="nav-item">
        <a class="nav-link" href="gantipassword_admin.php">
          <i class="fas fa-users-cog"></i>
          <span>Ganti Password</span></a>
      </li>

      <!-- Nav Item - Akun Petugas -->
      <li class="nav-item">
        <a class="nav-link" href="akunpetugas_admin.php">
          <i class="fas fa-user"></i>
          <span>Data Akun Petugas</span></a>
      </li>

      <!-- Nav Item - Poliklinik -->
      <li class="nav-item active">
        <a class="nav-link" href="poliklinik_admin.php">
          <i class="fas fa-clinic-medical"></i>
          <span>Data Poliklinik</span></a>
      </li>

      <!-- Nav Item - JamKes -->
      <li class="nav-item">
        <a class="nav-link" href="jamkes_admin.php">
          <i class="fas fa-medkit"></i>
          <span>Data Jaminan Kesehatan</span></a>
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
          <h1 class="h3 mb-4 text-gray-800">Edit Jaminan Kesehatan</h1>

          <div class="row">
            <div class="col-lg-9">
              <form name='update' method='post' action='<?php $_SERVER['PHP_SELF']; ?>' enctype="multipart/form-data">
                <div class="form-group row">
                  <label for="InputUsername" class="col-sm-2 col-form-label">ID Jaminan Kesehatan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="id" id="id" value='<?php echo $hasil['id_jamkes']; ?>' readonly>
                  </div>
                </div>
                <div class="form-group row">
                  <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Jaminan Kesehatan</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="nama" id="nama" value="<?= $hasil['nama_jamkes']; ?>">
                  </div>
                </div>
                <div class="form-group row">
                  <div class="col-sm-10">
                    <button type="submit" name="ubah" class="btn btn-primary">Ubah</button>
                    <a href="jamkes_admin.php" name="keluar" class="btn btn-primary">Keluar</a>
                  </div>
                </div>
              </form>
              <?php
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $id_jamkes = $_POST['id'];
                $nama_jamkes = $_POST['nama'];
                $ubah = $_POST['ubah'];
                $sql = "update jamkes set nama_jamkes='$nama_jamkes' where id_jamkes='$id_jamkes'";
                $query = mysqli_query($conn, $sql);
                if ($query) {
                  echo '<script>alert("Berhasil menyimpan data."); document.location="jamkes_admin.php?id_jamkes=' . $id_jamkes . '";</script>';
                } else {
                  echo '<div class="alert alert-warning">Gagal melakukan proses edit data.</div>';
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

</body>

</html>