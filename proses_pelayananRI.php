<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL RL_3_1 ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        // $disc = ($data['disc'] == 0.00 ? '-' : $data["disc"]);
        foreach ($outp[0] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['unit'] . "</td>
            <td style='text-align: right;'>" . $data['in'] . "</td>
            <td style='text-align: right;'>" . $data['out'] . "</td>
            <td style='text-align: right;'>" . $data['gone_less'] . "</td>
            <td style='text-align: right;'>" . $data['gone_more'] . "</td>
            <td style='text-align: right;'>" . $data['LDR'] . "</td>
            <td style='text-align: right;'>" . $data['HPR'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[1] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['unit'] . "</td>
            <td style='text-align: right;'>" . $data['in'] . "</td>
            <td style='text-align: right;'>" . $data['out'] . "</td>
            <td style='text-align: right;'>" . $data['gone_less'] . "</td>
            <td style='text-align: right;'>" . $data['gone_more'] . "</td>
            <td style='text-align: right;'>" . $data['LDR'] . "</td>
            <td style='text-align: right;'>" . $data['HPR'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[2] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['unit'] . "</td>
            <td style='text-align: right;'>" . $data['in'] . "</td>
            <td style='text-align: right;'>" . $data['out'] . "</td>
            <td style='text-align: right;'>" . $data['gone_less'] . "</td>
            <td style='text-align: right;'>" . $data['gone_more'] . "</td>
            <td style='text-align: right;'>" . $data['LDR'] . "</td>
            <td style='text-align: right;'>" . $data['HPR'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[3] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['unit'] . "</td>
            <td style='text-align: right;'>" . $data['in'] . "</td>
            <td style='text-align: right;'>" . $data['out'] . "</td>
            <td style='text-align: right;'>" . $data['gone_less'] . "</td>
            <td style='text-align: right;'>" . $data['gone_more'] . "</td>
            <td style='text-align: right;'>" . $data['LDR'] . "</td>
            <td style='text-align: right;'>" . $data['HPR'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
            </tr>";
            $no++;
        }
        foreach ($outp[4] as $data) {
            echo "
            <tr>
            <td style='text-align: center;'>" . $no . "</td>
            <td>" . $data['unit'] . "</td>
            <td style='text-align: right;'>" . $data['in'] . "</td>
            <td style='text-align: right;'>" . $data['out'] . "</td>
            <td style='text-align: right;'>" . $data['gone_less'] . "</td>
            <td style='text-align: right;'>" . $data['gone_more'] . "</td>
            <td style='text-align: right;'>" . $data['LDR'] . "</td>
            <td style='text-align: right;'>" . $data['HPR'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_1'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_2'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_3'] . "</td>
            <td style='text-align: right;'>" . $data['kelas_khusus'] . "</td>
            </tr>";
            $no++;
        }
        // echo "
        // <tr>
        // <td style='text-align: center;'>99</td>
        // <td>TOTAL</td>
        // <td id='jumlah' style='text-align: right;'></td>
        // <td id='jumlah2' style='text-align: right;'></td>
        // <td id='jumlah3' style='text-align: right;'></td>
        // <td id='jumlah4' style='text-align: right;'></td>
        // <td id='jumlah5' style='text-align: right;'></td>
        // <td id='jumlah6' style='text-align: right;'></td>
        // <td id='jumlah7' style='text-align: right;'></td>
        // <td id='jumlah8' style='text-align: right;'></td>
        // <td id='jumlah9' style='text-align: right;'></td>
        // <td id='jumlah10' style='text-align: right;'></td>
        // </tr>";
    }
}

mysqli_close($conn);
