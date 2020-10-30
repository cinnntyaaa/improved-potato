<?php
include "koneksii.php";
if (isset($_POST['tanggal']) && isset($_POST['tanggal2'])) {
    $tanggal = $_POST['tanggal'];
    $tanggal2 = $_POST['tanggal2'];

    if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
        echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
    } else {
        $no = 1;
        $sql = "SELECT a.poliklinik_id_poliklinik AS 'id',
        b.nama_poliklinik AS 'Klinik', COUNT(*) AS 'Jumlah', (COUNT(*)-IFNULL(c.Jumlah,0)) AS 'Belum', IFNULL(c.Jumlah,0) AS 'Sudah', 
        (COUNT(*)-IFNULL(SUM(f.BAYAR),0)) AS 'Bayar', IFNULL(i.Jumlah,0) AS 'Batal'
        FROM `laporan` a 
        INNER JOIN poliklinik b ON b.id_poliklinik = a.poliklinik_id_poliklinik
        LEFT JOIN (
        SELECT e.id_poliklinik, e.nama_poliklinik, COUNT(d.id_antrian) AS 'Jumlah' 
        FROM laporan d INNER JOIN poliklinik e ON e.id_poliklinik = d.poliklinik_id_poliklinik
        WHERE d.`status` LIKE 'Telah Dipanggil' AND d.tanggal BETWEEN '" . $tanggal . "' AND '" . $tanggal2 . "'
        GROUP BY(d.poliklinik_id_poliklinik)
        ) c ON c.id_poliklinik = b.id_poliklinik
        LEFT JOIN (
        SELECT h.NO_KUNJUNGAN AS 'NO_KUNJUNGAN', COUNT(g.ID_LUNAS) AS 'BAYAR'
        FROM kasir.lunas g INNER JOIN kasir.kunjungan h ON g.ID_LUNAS = h.ID_LUNAS 
        WHERE g.INVALID_LUNAS != 1 GROUP BY(g.ID_LUNAS) ORDER BY g.ID_LUNAS DESC
        ) f ON f.NO_KUNJUNGAN = a.no_kunjungan
        LEFT JOIN (
        SELECT k.id_poliklinik, k.nama_poliklinik, COUNT(j.id_antrian) AS 'Jumlah' 
        FROM laporan j INNER JOIN poliklinik k ON k.id_poliklinik = j.poliklinik_id_poliklinik
        WHERE j.batal = 1 AND j.`status` LIKE 'Belum Dipanggil' AND j.tanggal BETWEEN '" . $tanggal . "' AND '" . $tanggal2 . "'
        GROUP BY(j.poliklinik_id_poliklinik)
        ) i ON i.id_poliklinik = b.id_poliklinik
        WHERE a.tanggal BETWEEN '" . $tanggal . "' AND '" . $tanggal2 . "'
        GROUP BY(a.poliklinik_id_poliklinik);";
        $query = mysqli_query($conn, $sql);
        while ($data = mysqli_fetch_array($query)) {
            $disabled = ($data['Klinik'] === 'Pendaftaran Rawat Jalan' ? 'disabled' : '');
            echo "
                <tr>
                <td>" . $no . "</td>
                <td>" . $data['Klinik'] . "</td>
                <td style='text-align: right; color: green; font-weight: bold;'>" . $data['Jumlah'] . "</td>
                <td style='text-align: right;'>" . $data['Belum'] . "</td>
                <td style='text-align: right;'>" . $data['Sudah'] . "</td>
                <td style='text-align: right; color: red; font-weight: bold;'>" . $data['Bayar'] . "</td>
                <td style='text-align: right; color: orange; font-weight: bold;'>" . $data['Batal'] . "</td>
                <td><form action='validasi_spi.php' method='post'><input id='submit' type='submit' value='Lihat' class='btn btn-primary' $disabled/><input type='hidden' name='id' value='" . $data["id"] . "'/><input type='hidden' name='tanggal' value='".$tanggal."'><input type='hidden' name='tanggal2' value='".$tanggal2."'><input type='hidden' name='klinik' value='" . $data["Klinik"] . "'></form></td>
                </tr>";
            $no++;
        }
    }
}
