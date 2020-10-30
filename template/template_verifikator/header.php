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
if ($_SESSION['level'] !== "Verifikator" and $_SESSION['level'] === "Petugas RJ") {
?>
    <script>
        document.location = 'dashboard_petugasrj.php';
    </script>
<?php
} else if ($_SESSION['level'] !== "Verifikator" and $_SESSION['level'] === "Perawat RJ") {
?>
    <script>
        document.location = 'dashboard_perawatrj.php';
    </script>
<?php
} else if ($_SESSION['level'] !== "Verifikator" and $_SESSION['level'] === "Admin") {
?>
    <script>
        document.location = 'dashboard_admin.php';
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

    <title>Verifikator</title>
    <link rel="icon" type="image/png" href="img/logomuh.png">
    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <!-- datepicker & loader -->
    <link rel="stylesheet" href="css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="css/loader.css">
    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <div id="loader-container">
            <div id="loader" class="d-block"></div>
        </div>
        <?php require "sidebar.php" ?>
        <?php require "navbar.php" ?>