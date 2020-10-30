<?php
include "koneksii2.php";
$idk = $_POST['idkunjungan'];
$sql= "UPDATE b_kunjungan SET batal = 1, pulang = 1, tgl_pulang = NOW() WHERE id = '".$idk."';";
$query = mysqli_query($conn, $sql);
$data = mysqli_affected_rows($conn);
echo $data;
// echo $idk;
