<?php
session_start();
include "koneksii.php";
$no = 1;
$sql = "SELECT a.no_pelayanan, a.id_antrian, b.id_poliklinik, b.nama_poliklinik,
                                      CONCAT(b.kode_poliklinik,a.nomor_antrian) AS no_antrian, a.tanggal, a.status
                                      FROM antrian a INNER JOIN poliklinik b ON b.id_poliklinik = a.poliklinik_id_poliklinik
                                      WHERE a.poliklinik_id_poliklinik = " . $_SESSION['poliklinik'] . " AND tanggal = DATE_FORMAT(NOW(),'%Y-%m-%d')
                                      AND a.status like 'Belum Dipanggil'
                                      ORDER BY nomor_antrian ASC";

$query = mysqli_query($conn, $sql);
while ($data = mysqli_fetch_array($query)) {
    echo "
        <tr>
            <td style='text-align: center;'>$no</td>
            <td>" . $data["nama_poliklinik"] . "</td>
            <td>" . $data["no_antrian"] . "</td>
            <td>" . $data["tanggal"] . "</td>
            <td>" . $data["status"] . "</td>
            <td style='text-align: center;'><form action='panggilantrianpoli.php' method='post'><input type='hidden' name='id_antrian' value='" . $data["id_antrian"] . "'/><input type='hidden' name='no_antrian' value='" . $data["no_antrian"] . "'/><input type='hidden' name='no_pelayanan' value='" . $data["no_pelayanan"] . "'><input class='btn btn-primary' type='submit' value='Panggil'/></form></td>
        </tr>";
    $no++;
}
