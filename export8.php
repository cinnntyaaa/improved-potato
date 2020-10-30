<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="PengadaanObat ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($tanggal2)) . '.xls"');
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
    $sql = "CALL RL_3_13 ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        <span style="color:black; font-weight:bolder; font-size:larger">RL 3.13 Pengadaan Obat, Penulisan dan Pelayanan Resep</span><br>
        <span style="color:black; font-weight:bolder;">A. Pengadaan Obat</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Golongan Obat</th>
                    <th>Jumlah Item Obat</th>
                    <th>Jumlah Item Obat yang Tersedia di RS</th>
                    <th>Jumlah Item Obat Formulatorium Tersedia di RS</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th uncollapse="">5</th>
                </tr>
            </thead>
            <tbody id="pengadaan-obat">
                <?php
                foreach ($outp as $key => $subArray) {
                    if ($key < 3) {
                        foreach ($subArray as $key => $data) {
                            echo "
                            <tr>
                            <td style='text-align: center;'>" . $no . "</td>
                            <td>" . $data['item_gol'] . "</td>
                            <td style='text-align: right;'>" . $data['sum_item'] . "</td>
                            <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                            <td style='text-align: right;'>" . $data['sum_formula'] . "</td>
                            </tr>";
                            $no++;
                        }
                    }
                }
                echo "
            <tr>
            <td style='text-align: center;'>99</td>
            <td>TOTAL</td>
            <td id='jumlah1' style='text-align: right;'>=SUM(C5:C" . (5 + (count($outp) - 1)) . ")</td>
            <td id='jumlah1' style='text-align: right;'>=SUM(D5:D" . (5 + (count($outp) - 1)) . ")</td>
            <td id='jumlah1' style='text-align: right;'>=SUM(E5:E" . (5 + (count($outp) - 1)) . ")</td>
            </tr>";
                ?>
            </tbody>
        </table>
        <span style="color:black; font-weight:bolder;">B. Penulisan dan Pelayanan Resep</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Golongan Obat</th>
                    <th>Jumlah Item Obat</th>
                    <th>Jumlah Item Obat yang Tersedia di RS</th>
                    <th>Jumlah Item Obat Formulatorium Tersedia di RS</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th uncollapse="">5</th>
                </tr>
            </thead>
            <tbody id="penulisan-resep">
                <?php
                foreach ($outp as $key => $subArray) {
                    if ($key > 2) {
                        foreach ($subArray as $key => $data) {
                            echo "
                        <tr>
                        <td style='text-align: center;'>" . $no . "</td>
                        <td>" . $data['item_gol'] . "</td>
                        <td style='text-align: right;'>" . $data['sum_rj'] . "</td>
                        <td style='text-align: right;'>" . $data['sum_igd'] . "</td>
                        <td style='text-align: right;'>" . $data['sum_ri'] . "</td>
                        </tr>";
                            $no++;
                        }
                    }
                }
                echo "
            <tr>
            <td style='text-align: center;'>99</td>
            <td>TOTAL</td>
            <td id='jumlah4' style='text-align: right;'>=SUM(C12:C" . (12 + (count($outp) - 1)) . ")</td>
            <td id='jumlah5' style='text-align: right;'>=SUM(D12:D" . (12 + (count($outp) - 1)) . ")</td>
            <td id='jumlah6' style='text-align: right;'>=SUM(E12:E" . (12 + (count($outp) - 1)) . ")</td>
            </tr>";
                ?>
            </tbody>
        </table>
    <?php
        mysqli_close($conn);
    }
    ?>


</body>

</html>