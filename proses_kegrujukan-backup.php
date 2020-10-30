<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL RL_3_14 ('" . $tanggal . "', '" . $tanggal2 . "');";
    $sql2 = "CALL RL_3_14_Sub ('" . $tanggal . "', '" . $tanggal2 . "');";
    $outp = array();
    $outp2 = array();
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
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[1] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[2] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[3] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[4] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[5] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
    }
    if (mysqli_multi_query($conn, $sql2)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                $outp2[] = $result->fetch_all(MYSQLI_ASSOC);
                // Fetch one and one row
            }
        } while (mysqli_next_result($conn));
        foreach ($outp2[0] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp2[1] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp2[2] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp2[3] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp2[4] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp2[5] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp2[6] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp2[7] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['jenis'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_in'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_in'] . "</td>
            <td style='text-align: right;'>" . $data['rs_in'] . "</td>
            <td style='text-align: right;'>" . $data['puskesmas_retur'] . "</td>
            <td style='text-align: right;'>" . $data['faskes_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rs_retur'] . "</td>
            <td style='text-align: right;'>" . $data['rujuk_out'] . "</td>
            <td style='text-align: right;'>" . $data['self_out'] . "</td>
            <td style='text-align: right;'>" . $data['comeback'] . "</td>
            </tr>";
            $no++;
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
        </tr>";
    }
}

mysqli_close($conn);
