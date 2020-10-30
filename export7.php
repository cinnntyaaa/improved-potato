<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="KegiatanRujukan ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($tanggal2)) . '.xls"');
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
    $sql = "CALL RL_3_14 ('" . $tanggal . "', '" . $tanggal2 . "');";
    $sql2 = "CALL RL_3_14_Sub ('" . $tanggal . "', '" . $tanggal2 . "');";
    $outp = array();
    $outp2 = array();
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
        <span style="color:black; font-weight:bolder;">RL 3.14 Kegiatan Rujukan</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Jenis Spesialisasi</th>
                    <th colspan="6">Rujukan</th>
                    <th colspan="3">Dirujuk</th>
                </tr>
                <tr>
                    <th>Diterima dari Puskesmas</th>
                    <th>Diterima dari Faskes Lain</th>
                    <th>Diterima dari RS Lain</th>
                    <th>Dikembalikan ke Puskesmas</th>
                    <th>Dikembalikan ke Faskes Lain</th>
                    <th>Dikembalikan ke RS Asal</th>
                    <th>Pasien Rujukan</th>
                    <th>Pasien Datang Sendiri</th>
                    <th>Diterima Kembali</th>
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
                    <th uncollapse="">11</th>
                </tr>
            </thead>
            <tbody id="rujukan">
                <?php
                foreach ($outp as $key => $subArray) {
                    foreach ($subArray as $key => $data) {
                        echo "
                        <tr>
                        <td style='text-align: center;'>" . $no . "</td>
                        <td>" . $data['jenis'] . "</td>
                        <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
                        <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
                        <td style='text-align: right;'>" . $data['rs_in'] . "</td>
                        <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
                        <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
                        <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
                        <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
                        <td style='text-align: right;'>" . $data['self_out'] . "</td>
                        <td style='text-align: right;'>" . $data['comeback'] . "</td>
                        </tr>";
                        $no++;
                    }
                }
            }
            if (mysqli_multi_query($conn, $sql2)) {
                do {
                    // Store first result set
                    if ($result = mysqli_store_result($conn)) {
                        $outp2[] = $result->fetch_all(MYSQLI_ASSOC);
                        // Fetch one and one row
                    }
                } while (mysqli_next_result($conn));
                ?>
                <table border="1" width="100%">
                    <thead style="text-align: center;">

                    </thead>
                    <tbody id="rujukan2">
                    <?php
                    foreach ($outp2 as $key => $subArray) {
                        foreach ($subArray as $key => $data) {
                            echo "
                        <tr>
                        <td style='text-align: center;'>" . $no . "</td>
                        <td>" . $data['jenis'] . "</td>
                        <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
                        <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
                        <td style='text-align: right;'>" . $data['rs_in'] . "</td>
                        <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
                        <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
                        <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
                        <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
                        <td style='text-align: right;'>" . $data['self_out'] . "</td>
                        <td style='text-align: right;'>" . $data['comeback'] . "</td>
                        </tr>";
                            $no++;
                        }
                    }

                    echo "
            <tr>
            <td style='text-align: center;'>99</td>
            <td>TOTAL</td>
            <td id='jumlah1' style='text-align: right;'>=SUM(C5:C" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah2' style='text-align: right;'>=SUM(D5:D" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah3' style='text-align: right;'>=SUM(E5:E" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah4' style='text-align: right;'>=SUM(F5:F" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah5' style='text-align: right;'>=SUM(G5:G" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah6' style='text-align: right;'>=SUM(H5:H" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah7' style='text-align: right;'>=SUM(I5:I" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah8' style='text-align: right;'>=SUM(J5:J" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            <td id='jumlah9' style='text-align: right;'>=SUM(K5:K" . (5 + (count($outp) + count($outp2) - 1)) . ")</td>
            </tr>";
                }
                mysqli_close($conn);
                    ?>
                    </tbody>
                </table>

</body>

</html>