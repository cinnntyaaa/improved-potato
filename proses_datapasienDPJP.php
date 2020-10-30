<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL pxDPJP_Kunjungan ('" . $tanggal . "', '" . $tanggal2 . "');";
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
            <td style='text-align: center;'>".$no."</td>
            <td>" . $data['dpjp'] . "</td>
            <td style='text-align: right;'>" . $data['sum_all'] . "</td>
            </tr>";
            $no++;
        }
        echo "
        <tr>
        <td colspan='2' style='text-align: center; font-weight:bolder'>TOTAL</td>
        <td id='jumlah1' style='text-align: right;'></td>
        </tr>";
    }
}

mysqli_close($conn);
