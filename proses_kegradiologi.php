<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL RL_3_7 ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        echo "
            <tr>
            <td colspan='3'>RADIODIAGNOSTIK</td>
            </tr>";
        foreach ($outp as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['Foto Tanpa Bahan Kontras'] . "</td>
            <td style='text-align: right;'>" . $data['sum_all'] . "</td>
            </tr>";
            $no++;
        }
        
        echo "
        <tr>
        <td style='text-align: center;'>99</td>
        <td>TOTAL</td>
        <td id='jumlah' style='text-align: right;'>0</td>
        </tr>";
    }
}

mysqli_close($conn);
