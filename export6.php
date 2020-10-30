<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="CaraBayar ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($tanggal2)) . '.xls"');
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
    $sql = "CALL RL_3_15 ('" . $tanggal . "', '" . $tanggal2 . "');";
    $outp = array();
    // Execute multi query
    if (mysqli_multi_query($conn, $sql)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                $outp = $result->fetch_all(MYSQLI_ASSOC);
                // Fetch one and one row
            }
        } while (mysqli_next_result($conn));
    ?>
        <span style="color:black; font-weight:bolder;">RL 3.15 Cara Bayar</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th rowspan="2">No.</th>
                    <th rowspan="2">Cara Pembayaran</th>
                    <th colspan="2">Pasien Rawat Inap</th>
                    <th rowspan="2">Jumlah Pasien Rawat Jalan</th>
                    <th colspan="3">Jumlah Pasien Rawat Jalan</th>
                </tr>
                <tr>
                    <th>Jumlah Pasien Keluar</th>
                    <th>Jumlah Lama Dirawat</th>
                    <th>Laboratorium</th>
                    <th>Radiologi</th>
                    <th>Lain-lain</th>
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
            <tbody id="cara_bayar">
            <?php
            $newArray = $outp;
            unset($newArray[array_search(1, $outp, true)]);
            $keys = $newArray[1];
            unset($keys['id']);
            unset($keys['nama']);
            $hasil = array();
            foreach ($keys as $key => $value) {
                $hasil[$key] = intval(array_sum(array_column($newArray, $key)));
            }

            $newArray2 = $outp;
            $keys2 = $newArray2[0];
            unset($keys2['id']);
            unset($keys2['nama']);
            $hasil2 = array();
            foreach ($keys2 as $key => $value) {
                $hasil2[$key] = intval(array_sum(array_column($newArray2, $key)));
            }

            $umum = $outp[array_search(1, $outp, true)];
            echo "
                <tr>
                <td>1</td>
                <td>Membayar Sendiri</td>
                <td>" . $umum['sum_out'] . "</td>
                <td>" . $umum['sum_stay'] . "</td>
                <td>" . $umum['sum_rj'] . "</td>
                <td>" . $umum['sum_lab'] . "</td>
                <td>" . $umum['sum_rad'] . "</td>
                <td>" . $umum['sum_lain'] . "</td>
                </tr>
                <tr>
                <td>2</td>
                <td>Asuransi :</td>
                <td colspan='6'></td>
                </tr>
                <tr>
                <td>2.1</td>
                <td>Asuransi Pemerintah</td>
                <td>" . $hasil['sum_out'] . "</td>
                <td>" . $hasil['sum_stay'] . "</td>
                <td>" . $hasil['sum_rj'] . "</td>
                <td>" . $hasil['sum_lab'] . "</td>
                <td>" . $hasil['sum_rad'] . "</td>
                <td>" . $hasil['sum_lain'] . "</td>
                </tr>
                <tr>
                <td>2.2</td>
                <td>Asuransi Swasta</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                <td>3</td>
                <td>Keringanan (Cost Sharing)</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                <td>4</td>
                <td>Gratis :</td>
                <td colspan='6'></td>
                </tr>
                <tr>
                <td>4.1</td>
                <td>Kartu Sehat</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                <td>4.2</td>
                <td>Keterangan Tidak Mampu</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                <td>4.3</td>
                <td>Lain-lain</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                <tr>
                <td>99</td>
                <td>TOTAL</td>
                <td>" . $hasil2['sum_out'] . "</td>
                <td>" . $hasil2['sum_stay'] . "</td>
                <td>" . $hasil2['sum_rj'] . "</td>
                <td>" . $hasil2['sum_lab'] . "</td>
                <td>" . $hasil2['sum_rad'] . "</td>
                <td>" . $hasil2['sum_lain'] . "</td>
                </tr>
                
                ";
        }
        mysqli_close($conn);
            ?>
            </tbody>
        </table>

</body>

</html>