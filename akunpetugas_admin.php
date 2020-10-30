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
include "koneksii.php";
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
      <li class="nav-item active">
        <a class="nav-link" href="akunpetugas_admin.php">
          <i class="fas fa-user"></i>
          <span>Data Akun Petugas</span></a>
      </li>

      <!-- Nav Item - Poliklinik -->
      <li class="nav-item">
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
          <div class="row">
            <div class="col-lg-12">
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">
                Tambah
              </button>
              <!-- <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal"> Tambah </a> -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Data Akun Petugas</h6>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-bordered" id="table_id" width="100%" cellspacing="0">
                      <thead style="text-align:center;">
                        <tr>
                          <th scope="col">No.</th>
                          <th scope="col">ID Petugas</th>
                          <th scope="col">Username</th>
                          <th scope="col">Nama Petugas</th>
                          <th scope="col">Poliklinik</th>
                          <th scope="col">Level</th>
                          <th scope="col">Aksi</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        include "koneksii.php";
                        $no = 1;
                        $sql = "SELECT a.id_petugas AS 'id', a.username AS 'user', a.nama_petugas AS 'nama',
                                      IF(a.poliklinik < 1, CONCAT('Admin'), b.nama_poliklinik) AS 'klinik', a.level AS 'level'
                                      FROM petugas a left JOIN poliklinik b
                                      ON a.poliklinik = b.id_poliklinik";
                        $query = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                          echo "
                                          <tr>
                                            <td style='text-align:center;'>$no</td>
                                            <td>$data[id]</td>
                                            <td>$data[user]</td>
                                            <td>$data[nama]</td>
                                            <td>$data[klinik]</td>
                                            <td>$data[level]</td>
                                            <td style='text-align:center;'>
                                            <a href='delete_admin.php?del=$data[id]'>Hapus</a> 
                                            | 
                                            <a href='update_akunpetugas.php?upd=$data[id]'>Ubah
                                            </td>
                                          </tr> ";
                          $no++;
                        }
                        ?>
                      <tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->

      <!-- Modal -->
      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Tambah Petugas</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form name='insert' method='post' action="" enctype="multipart/form-data">
                <div class="form-group">
                  <input type="text" class="form-control" id="user" name="user" aria-describedby="emailHelp" placeholder="Masukkan Username" required>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control" id="nama" name="nama" aria-describedby="emailHelp" placeholder="Masukkan Nama Petugas" required>
                  <!-- <small id="emailHelp" class="form-text text-muted">Password akan <i>default</i> 123456</small> -->
                </div>
                <div class="form-group">Pilih Poliklinik :
                  <select name="nama_poliklinik" class="form-control" required>
                    <option>Admin</option>
                    <?php
                    include "koneksii.php";
                    $sql = "select * from poliklinik order by nama_poliklinik;";
                    $query = mysqli_query($conn, $sql);
                    ?>
                    <?php if (mysqli_num_rows($query) > 0) { ?>
                      <?php while ($row = mysqli_fetch_array($query)) { ?>
                        <option><?php echo $row['nama_poliklinik'] ?></option>
                      <?php } ?>
                    <?php } ?>
                  </select>
                </div>
                <div class="form-group">
                  <input type="password" class="form-control" name="password" aria-describedby="emailHelp" placeholder="Password" required>
                </div>
                <div class="form-group">Pilih Level :
                  <select name="level" class="form-control" required>
                    <option>Admin</option>
                    <option>Petugas RJ</option>
                    <option>Perawat RJ</option>
                    <option>Verifikator</option>
                  </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Keluar</button>
              <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </div>
            </form>
            <?php
            error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED);
            include "koneksii.php";
            if (isset($_POST['simpan'])) {
              $username  = $_POST['user'];
              $nama_petugas  = $_POST['nama'];
              $poliklinik  = $_POST['nama_poliklinik'];
              $pass  = md5($_POST['password']);
              $level  = $_POST['level'];

              $simpan  = $_POST['simpan'];

              $sql = "INSERT INTO petugas(id_petugas, username, nama_petugas, poliklinik, pass, level)
            VALUES('$id_petugas', '$username', '$nama_petugas', '$poliklinik', '$pass', '$level')";
              $query = mysqli_query($conn, $sql);

              if ($query) {
                echo '<script>alert("Berhasil menambahkan data."); document.location="akunpetugas_admin.php";</script>';
              } else {
                echo '<div class="alert alert-warning">Gagal melakukan proses tambah data.</div>';
              }
            }
            ?>
          </div>
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


</body>
<!-- untuk hapus -->

</html>