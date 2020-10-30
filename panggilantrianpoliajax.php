<?php
include "koneksii.php";
$id_antrianpanggil = isset($_POST['id_antrianpanggil']);
if ($id_antrianpanggil) {
    $sql = "INSERT into audible set antrian_id_antrian = " . $_POST['id_antrianpanggil'];
    $query = mysqli_query($conn, $sql);
    $status = mysqli_affected_rows($conn);
    if ($status != 0) {
        echo 1;
    } else {
        echo 0;
    }
}
