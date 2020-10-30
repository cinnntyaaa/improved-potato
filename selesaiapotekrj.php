<?php
include "koneksii.php";
$id_antrian = $_POST['id_antrian'];

if ($id_antrian) {
    $sql = "INSERT INTO apotekrj (antrian_id_antrian, tanggal) values (".$id_antrian.", DATE_FORMAT(NOW(), '%Y-%m-%d'))";
    $query = mysqli_query($conn, $sql);
    $status = mysqli_affected_rows($conn);
    if ($status) {
        echo '<script>alert("Telah Dilayani Apotek RJ"); document.location="panggil_apotekrj.php";</script>';
    } else {
        echo '<script>alert("Gagal Diselesaikan"); document.location="panggil_apotekrj.php";</script>';
    }
}
?>