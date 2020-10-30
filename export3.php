<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="KunjunganRS ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($tanggal2)) . '.xls"');
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
    $sql = "CALL RL_5_1_2 ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        <span style="color:black; font-weight:bolder">RL 5.1 Pengunjung Rumah Sakit</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Jenis Kegiatan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody id="pengunjung_rs">
                <?php
                foreach ($outp[0] as $data) {
                    echo "
                        <tr>
                        <td style='text-align: center'>" . $no . "</td>
                        <td>" . $data['desc'] . "</td>
                        <td style='text-align: right'>" . $data['sum_all'] . "</td>
                        </tr>";
                    $no++;
                }
                ?>
            </tbody>
        </table>
        <span style="color:black; font-weight:bolder;">RL 5.2 Kunjungan Rawat Jalan</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Jenis Kegiatan</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody id="kunjungan_rj">
            <?php
            foreach ($outp[1] as $data) {
                echo "
                        <tr>
                        <td style='text-align: center'>" . $no . "</td>
                        <td>" . $data['nama'] . "</td>
                        <td style='text-align: right'>" . $data['sum_all'] . "</td>
                        </tr>";
                $no++;
            }
            echo "
            <tr>
            <td style='text-align: center;'>99</td>
            <td>TOTAL</td>
            <td id='jumlah1' style='text-align: right;'>=SUM(C7:C" . (7 + (count($outp[1]) - 1)) . ")</td>
            </tr>";
        }
        mysqli_close($conn);
            ?>
            </tbody>
        </table>

</body>

</html>