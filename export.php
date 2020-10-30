<?php
$tanggal = $_POST['tanggal'];
$unit = $_POST['unit'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="LaporanHarianRI ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($unit)) . '.xls"');
header("Pragma: no-cache");
header("Expires: 0");
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

</head>

<body id="page-top">
    <?php
    include "koneksii2.php";

    $no = 1;
    $sql = "CALL sensusHarianRI ($unit, '" . $tanggal . "');";
    $outp = array();
    // Execute multi query
    if (mysqli_multi_query($conn, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                $outp[] = $result->fetch_all(MYSQLI_ASSOC);
                // Fetch one and one row
            }
        } while (mysqli_next_result($conn));
    ?>
        <p style="color:black; font-weight:bolder; font-size:larger">Tanggal : <?php echo $tanggal ?></p>
        <p style="color:black; font-weight:bolder; font-size:larger">Unit : <?= $unit ?></p>
        <table border="1" width="100%">
            <span style="color:black;">A. Pasien Awal : </span>
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Sex</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Kelas</th>
                    <th>Jaminan</th>
                    <th>DPJP</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody id="pasien_awal_body">
                <?php
                foreach ($outp[0] as $data) {
                    echo "
                    <tr>
                    <td>" . $no . "</td>
                    <td>" . $data['tanggal'] . "</td>
                    <td>" . $data['norm'] . "</td>
                    <td>" . $data['nama'] . "</td>
                    <td>" . $data['sex'] . "</td>
                    <td>" . $data['usia'] . "</td>
                    <td>" . $data['alamat'] . "</td>
                    <td>" . $data['kelas'] . "</td>
                    <td>" . $data['jaminan'] . "</td>
                    <td>" . $data['dpjp'] . "</td>
                    <td>" . $data['icd'] . "</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <table border="1" width="100%">
            <span style="color:black">B. Pasien Masuk :</span>
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Sex</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Kelas</th>
                    <th>Jaminan</th>
                    <th>DPJP</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody id="pasien_masuk_body">
                <?php
                foreach ($outp[1] as $data) {
                    echo "
                    <tr>
                    <td>" . $no . "</td>
                    <td>" . $data['tanggal'] . "</td>
                    <td>" . $data['norm'] . "</td>
                    <td>" . $data['nama'] . "</td>
                    <td>" . $data['sex'] . "</td>
                    <td>" . $data['usia'] . "</td>
                    <td>" . $data['alamat'] . "</td>
                    <td>" . $data['kelas'] . "</td>
                    <td>" . $data['jaminan'] . "</td>
                    <td>" . $data['dpjp'] . "</td>
                    <td>" . $data['icd'] . "</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <table border="1" width="100%">
            <span style="color:black">C. Pasien Pindahan :</span>
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Sex</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Kelas</th>
                    <th>Jaminan</th>
                    <th>DPJP</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody id="pasien_pindahan_body">
                <?php
                foreach ($outp[2] as $data) {
                    echo "
                <tr>
                <td>" . $no . "</td>
                <td>" . $data['tanggal'] . "</td>
                <td>" . $data['norm'] . "</td>
                <td>" . $data['nama'] . "</td>
                <td>" . $data['sex'] . "</td>
                <td>" . $data['usia'] . "</td>
                <td>" . $data['alamat'] . "</td>
                <td>" . $data['kelas'] . "</td>
                <td>" . $data['jaminan'] . "</td>
                <td>" . $data['dpjp'] . "</td>
                <td>" . $data['icd'] . "</td>
                </tr>";
                    $no++;
                }

                ?>
            </tbody>
        </table>
        <table border="1" width="100%">
            <span style="color:black">D. Pasien Pindah :</span>
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Tanggal</th>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Sex</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Unit</th>
                    <th>Kelas</th>
                    <th>Jaminan</th>
                    <th>DPJP</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody id="pasien_pindah_body">
                <?php
                foreach ($outp[3] as $data) {
                    echo "
                    <tr>
                    <td>" . $no . "</td>
                    <td>" . $data['tanggal'] . "</td>
                    <td>" . $data['norm'] . "</td>
                    <td>" . $data['nama'] . "</td>
                    <td>" . $data['sex'] . "</td>
                    <td>" . $data['usia'] . "</td>
                    <td>" . $data['alamat'] . "</td>
                    <td>" . $data['unit'] . "</td>
                    <td>" . $data['kelas'] . "</td>
                    <td>" . $data['jaminan'] . "</td>
                    <td>" . $data['dpjp'] . "</td>
                    <td>" . $data['icd'] . "</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <table border="1" width="100%">
            <span style=color:black>E. Pasien Pulang :</span>
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Tanggal Masuk</th>
                    <th>No. RM</th>
                    <th>Nama</th>
                    <th>Sex</th>
                    <th>Usia</th>
                    <th>Alamat</th>
                    <th>Cara Pulang</th>
                    <th>Keadaan Pulang</th>
                    <th>Kelas</th>
                    <th>Jaminan</th>
                    <th>DPJP</th>
                    <th>Diagnosa</th>
                </tr>
            </thead>
            <tbody id="pasien_pulang_body">
                <?php
                foreach ($outp[4] as $data) {
                    echo "
                    <tr>
                    <td>" . $no . "</td>
                    <td>" . $data['tanggal'] . "</td>
                    <td>" . $data['norm'] . "</td>
                    <td>" . $data['nama'] . "</td>
                    <td>" . $data['sex'] . "</td>
                    <td>" . $data['usia'] . "</td>
                    <td>" . $data['alamat'] . "</td>
                    <td>" . $data['cara'] . "</td>
                    <td>" . $data['keadaan'] . "</td>
                    <td>" . $data['kelas'] . "</td>
                    <td>" . $data['jaminan'] . "</td>
                    <td>" . $data['dpjp'] . "</td>
                    <td>" . $data['icd'] . "</td>
                    </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
    <?php

        mysqli_close($conn);
    }
    ?>


</body>

</html>