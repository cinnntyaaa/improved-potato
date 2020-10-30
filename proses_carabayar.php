<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
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
