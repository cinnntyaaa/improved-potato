<?php require "./template/template_verifikator/header.php" ?>
<main>
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
</main>
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
<?php require "template/template_verifikator/footer.php" ?>