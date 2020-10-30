<?php
include "koneksii.php";
$id_antrian = isset($_POST['id_antrian']);
if ($id_antrian) {
    $sql = "UPDATE antrian set status = 'Telah Dipanggil' where id_antrian = " . $_POST['id_antrian'];
    $query = mysqli_query($conn, $sql);
    $status = mysqli_affected_rows($conn);
    if ($status) {
        echo '<script>alert("Nomor Antrian Ini Sudah Dilayani"); document.location="panggilantrian_pend.php";</script>';
    } else {
        echo '<script>alert("Nomor Antrian Gagal Diselesaikan");</script>';
    }
}
?>