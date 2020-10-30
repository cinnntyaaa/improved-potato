<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="KeluargaBerencana ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($tanggal2)) . '.xls"');
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
    $sql = "CALL RL_3_12 ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        <span style="color:black; font-weight:bolder; font-size:larger">RL 3.12 Kegiatan Keluarga Berencana</span><br>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Metoda</th>
                    <th colspan="2">Konseling</th>
                    <th colspan="4">KB Baru dengan Cara Masuk</th>
                    <th colspan="3">KB Baru dengan Kondisi</th>
                    <th rowspan="2">Kunjungan Ulang</th>
                    <th colspan="2">Keluhan Efek Samping</th>
                </tr>
                <tr>
                    <th>ANC</th>
                    <th>Pasca Persalinan</th>
                    <th>Bukan Rujukan</th>
                    <th>Rujukan R. Inap</th>
                    <th>Rujukan R. Jalan</th>
                    <th>Total</th>
                    <th>Pasca Persalinan/Nifas</th>
                    <th>Abortus</th>
                    <th>Lainnya</th>
                    <th>Jumlah</th>
                    <th>Dirujuk</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th uncollapse="">14</th>
                </tr>
            </thead>
            <tbody id="kelg-berencana">
                <?php
                foreach ($outp as $key => $subArray) {
                    foreach ($subArray as $key => $data) {
                        echo "
                            <tr>
                            <td style='text-align: center;'>" . $no . "</td>
                            <td>" . $data['metoda'] . "</td>
                            <td style='text-align: right;'>" . $data['anc'] . "</td>
                            <td style='text-align: right;'>" . $data['pasca'] . "</td>
                            <td style='text-align: right;'>" . $data['non_rujuk'] . "</td>
                            <td style='text-align: right;'>" . $data['ri_rujuk'] . "</td>
                            <td style='text-align: right;'>" . $data['rj_rujuk'] . "</td>
                            <td style='text-align: right;'>" . $data['sum_total'] . "</td>
                            <td style='text-align: right;'>" . $data['pasca_salin'] . "</td>
                            <td style='text-align: right;'>" . $data['abortus'] . "</td>
                            <td style='text-align: right;'>" . $data['lain'] . "</td>
                            <td style='text-align: right;'>" . $data['ulang'] . "</td>
                            <td style='text-align: right;'>" . $data['jumlah'] . "</td>
                            <td style='text-align: right;'>" . $data['dirujuk'] . "</td>
                            </tr>";
                        $no++;
                    }
                }
                echo "
                <tr>
                <td style='text-align: center;'>99</td>
                <td>TOTAL</td>
                <td id='jumlah1' style='text-align: right;'>=SUM(C5:C" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah2' style='text-align: right;'>=SUM(D5:D" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah3' style='text-align: right;'>=SUM(E5:E" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah4' style='text-align: right;'>=SUM(F5:F" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah5' style='text-align: right;'>=SUM(G5:G" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah6' style='text-align: right;'>=SUM(H5:H" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah7' style='text-align: right;'>=SUM(I5:I" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah8' style='text-align: right;'>=SUM(J5:J" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah9' style='text-align: right;'>=SUM(K5:K" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah10' style='text-align: right;'>=SUM(L5:L" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah11' style='text-align: right;'>=SUM(M5:M" . (5 + (count($outp) - 1)) . ")</td>
                <td id='jumlah12' style='text-align: right;'>=SUM(N5:N" . (5 + (count($outp) - 1)) . ")</td>
                </tr>";
                ?>
            </tbody>
        </table>
    <?php
        mysqli_close($conn);
    }
    ?>
    <!-- <td id='jumlah1' style='text-align: right;'>=SUM(C4:C" . (4 + (count($outp) - 1)) . ")</td> -->

</body>

</html>