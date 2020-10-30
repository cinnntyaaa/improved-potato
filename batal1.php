<?php
include "koneksii.php";
$idk = $_POST['idkunjungan'];
$sql= "UPDATE laporan SET batal = 1 WHERE no_kunjungan = '".$idk."'";
$query = mysqli_query($conn, $sql);
$data = mysqli_affected_rows($conn);
echo $data;
// echo $idk;
