<?php
include "koneksii.php";
$id_antrian = $_POST['id_antrian'];
$no_pelayanan = $_POST['no_pelayanan'];

$sql = "UPDATE antrian set status = 'Telah Dipanggil' where id_antrian = " . $_POST['id_antrian'];
$query = mysqli_query($conn, $sql);
$status = mysqli_affected_rows($conn);
if ($status > 0) {
    $conn->close();
    include "koneksii2.php";

    $sql2 = "UPDATE b_pelayanan SET visibility = 1 WHERE id = " . $no_pelayanan . ";";
    $query2 = mysqli_query($conn, $sql2);
    $status2 = mysqli_affected_rows($conn);
    if ($status2 > 0) {
        echo "<script>alert('Nomor Antrian Berhasil Diselesaikan'); document.location='panggilantrian_poli.php';</script>";
    } else {
        $conn->close();
        include "koneksii.php";

        $sql3 = "UPDATE antrian set status = 'Belum Dipanggil' where id_antrian = " . $_POST['id_antrian'];
        // echo $sql3;
        $query3 = mysqli_query($conn, $sql3);
        $status3 = mysqli_affected_rows($conn);
        // echo $status3;
        if ($status3 > 0) {
            echo "<script>alert('Gagal Menyelesaikan Antrian Silahkan Kontak Administrator Kode 01'); document.location='panggilantrian_poli.php';</script>";
        } else {
            echo "<script>alert('Gagal Menyelesaikan Antrian Silahkan Kontak Administrator Kode 02'); document.location='panggilantrian_poli.php';</script>";
        }
    }
} else {
    echo "<script>alert('Nomor Antrian Gagal1 Diselesaikan'); document.location='panggilantrian_poli.php';</script>";
}
