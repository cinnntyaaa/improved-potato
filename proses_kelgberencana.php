<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
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
    }
        echo "
        <tr>
        <td style='text-align: center;'>99</td>
        <td>TOTAL</td>
        <td id='jumlah1' style='text-align: right;'>1</td>
        <td id='jumlah2' style='text-align: right;'>2</td>
        <td id='jumlah3' style='text-align: right;'></td>
        <td id='jumlah4' style='text-align: right;'></td>
        <td id='jumlah5' style='text-align: right;'></td>
        <td id='jumlah6' style='text-align: right;'></td>
        <td id='jumlah7' style='text-align: right;'></td>
        <td id='jumlah8' style='text-align: right;'></td>
        <td id='jumlah9' style='text-align: right;'></td>
        <td id='jumlah10' style='text-align: right;'></td>
        <td id='jumlah11' style='text-align: right;'></td>
        <td id='jumlah12' style='text-align: right;'></td>
        </tr>";
}

mysqli_close($conn);
