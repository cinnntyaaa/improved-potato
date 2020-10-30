<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="TopTenDiagnosa ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($tanggal2)) . '.xls"');
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
    $sql = "CALL RL_5_3_4_topTen ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        <span style="color:black; font-weight:bolder; font-size:larger">Daftar 10 Besar Penyakit RJ</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th rowspan="2">No. Urut</th>
                    <th rowspan="2">Kode ICD 10</th>
                    <th rowspan="2">Deskripsi</th>
                    <th colspan="2">Kasus Baru Menurut Jenis Kelamin</th>
                    <th rowspan="2">Jumlah Kasus Baru(4+5)</th>
                    <th rowspan="2">Jumlah Kunjungan</th>
                </tr>
                <tr>
                    <th>LK</th>
                    <th>PR</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th uncollapse="">7</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($outp[0] as $data) {
                    echo "
                        <td>" . $no . "</td>
                        <td>" . $data['icd'] . "</td>
                        <td>" . $data['desc'] . "</td>
                        <td>" . $data['men_new'] . "</td>
                        <td>" . $data['women_new'] . "</td>
                        <td>" . $data['sum_new'] . "</td>
                        <td>" . $data['sum_all'] . "</td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <span style="color:black; font-weight:bolder; font-size:larger">Daftar 10 Besar Penyakit RI</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">

                <tr>
                    <th rowspan="2">No. Urut</th>
                    <th rowspan="2">Kode ICD 10</th>
                    <th rowspan="2">Deskripsi</th>
                    <th colspan="2">Pasien Keluar Hidup Menurut Jenis Kelamin</th>
                    <th colspan="2">Pasien Keluar Mati Menurut Jenis Kelamin</th>
                    <th rowspan="2">Total (Hidup & Mati)</th>
                </tr>
                <tr>
                    <th>LK</th>
                    <th>PR</th>
                    <th>LK</th>
                    <th>PR</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th uncollapse="">8</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($outp[1] as $data) {
                    echo "
                        <tr>
                        <td>" . $no . "</td>
                        <td>" . $data['icd'] . "</td>
                        <td>" . $data['desc'] . "</td>
                        <td>" . $data['men_live'] . "</td>
                        <td>" . $data['women_live'] . "</td>
                        <td>" . $data['men_gone'] . "</td>
                        <td>" . $data['women_gone'] . "</td>
                        <td>" . $data['sum_all'] . "</td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <span style="color:black; font-weight:bolder; font-size:larger">Daftar 10 Besar Penyakit IGD</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>ICD</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
            <?php
            foreach ($outp[2] as $data) {
                echo "
                    <tr>
                    <td>" . $no . "</td>
                    <td>" . $data['icd'] . "</td>
                    <td>" . $data['desc'] . "</td>
                    <td>" . $data['sum_all'] . "</td>
                    </tr>";
                $no++;
            }
        }


        mysqli_close($conn);
            ?>
            </tbody>
        </table>

</body>

</html>