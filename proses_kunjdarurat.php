<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL RL_3_2 ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        foreach ($outp[0] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>Bedah</td>
            <td style='text-align: right;'>" . $data['rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['non_rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['dirawat'] . "</td>
            <td style='text-align: right;'>" . $data['dirujuk'] . "</td>
            <td style='text-align: right;'>" . $data['pulang'] . "</td>
            <td style='text-align: right;'>" . $data['meninggal'] . "</td>
            <td style='text-align: right;'>" . $data['doa'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[1] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>Non Bedah</td>
            <td style='text-align: right;'>" . $data['rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['non_rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['dirawat'] . "</td>
            <td style='text-align: right;'>" . $data['dirujuk'] . "</td>
            <td style='text-align: right;'>" . $data['pulang'] . "</td>
            <td style='text-align: right;'>" . $data['meninggal'] . "</td>
            <td style='text-align: right;'>" . $data['doa'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[2] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>Kebidanan</td>
            <td style='text-align: right;'>" . $data['rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['non_rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['dirawat'] . "</td>
            <td style='text-align: right;'>" . $data['dirujuk'] . "</td>
            <td style='text-align: right;'>" . $data['pulang'] . "</td>
            <td style='text-align: right;'>" . $data['meninggal'] . "</td>
            <td style='text-align: right;'>" . $data['doa'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[3] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>Anak</td>
            <td style='text-align: right;'>" . $data['rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['non_rujuk'] . "</td>
            <td style='text-align: right;'>" . $data['dirawat'] . "</td>
            <td style='text-align: right;'>" . $data['dirujuk'] . "</td>
            <td style='text-align: right;'>" . $data['pulang'] . "</td>
            <td style='text-align: right;'>" . $data['meninggal'] . "</td>
            <td style='text-align: right;'>" . $data['doa'] . "</td>
            </tr>";
            $no++;
        }
        echo "
        <tr>
        <td style='text-align: center;'>99</td>
        <td>TOTAL</td>
        <td id='jumlah' style='text-align: right;'></td>
        <td id='jumlah2' style='text-align: right;'></td>
        <td id='jumlah3' style='text-align: right;'></td>
        <td id='jumlah4' style='text-align: right;'></td>
        <td id='jumlah5' style='text-align: right;'></td>
        <td id='jumlah6' style='text-align: right;'></td>
        <td id='jumlah7' style='text-align: right;'></td>
        </tr>";
    }
}

mysqli_close($conn);
