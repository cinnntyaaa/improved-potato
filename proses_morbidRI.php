<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
$no = 1;
$sql = "CALL RL_4_A ('" . $tanggal . "', '" . $tanggal2 . "');";
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
    foreach ($outp as $data) {
        echo "
                                                        <tr>
                                                        <td>" . $no . "</td>
                                                        <td>" . $data['dtd'] . "</td>
                                                        <td class='icd'>" . $data['icd'] . "</td>
                                                        <td>" . $data['gol'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_7'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_7'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_28'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_28'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_1'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_1'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_4'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_4'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_14'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_14'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_24'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_24'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_44'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_44'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_64'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_64'] . "</td>
                                                        <td style='text-align: right'>" . $data['men_65'] . "</td>
                                                        <td style='text-align: right'>" . $data['women_65'] . "</td>
                                                        <td style='text-align: right'>" . $data['sum_men'] . "</td>
                                                        <td style='text-align: right'>" . $data['sum_women'] . "</td>
                                                        <td style='text-align: right'>" . $data['sum_live'] . "</td>
                                                        <td style='text-align: right'>" . $data['sum_gone'] . "</td>
                                                        </tr>";
        $no++;
    }
}

mysqli_close($conn);
