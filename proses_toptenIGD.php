<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
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
    foreach ($outp[2] as $data) {
        echo "
                                                        <tr>
                                                        <td>" . $no . "</td>
                                                        <td>" . $data['icd'] . "</td>
                                                        <td>" . $data['desc'] . "</td>
                                                        <td style='text-align: right'>" . $data['sum_all'] . "</td>
                                                        </tr>";
        $no++;
    }
}

mysqli_close($conn);
