<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $no = 1;
    $sql = "CALL RL_3_8 ('" . $tanggal . "', '" . $tanggal2 . "');";
    $sql2 = "CALL RL_3_8_Sub ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        echo "
        <td>" . $no . "</td>
        <td>Pembekuan, masa</td>
        <td>" . $outp[1][0]['sum_all'] . "</td>
        ";
        $no++;
        // foreach ($outp as $key => $subArray) {
        // $hematologi = [
        //     'Eosinofil',
        //     'Eritrosit',
        //     'Leukosit',
        //     'Leukosit, hitung jumlah1',
        //     'Limfosit',
        //     'Morfologi',
        //     'Trombosit'
        // ];
        // foreach ($outp[0] as $key => $data) {
        //     echo "
        //             <tr>
        //             <td style='text-align: center;'>" . $no . "</td>
        //             <td>" . $hematologi[$key] . "</td>
        //             <td style='text-align: right;'>" . $data['sum_all'] . "</td>
        //             </tr>";
        //     $no++;
        // }

        foreach ($outp[1] as $data) {
            echo "
                    <tr>
                    <td style='text-align: center;'>" . $no . "</td>
                    <td>" . $data['hemostatis'] . "</td>
                    <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                    </tr>";
            $no++;
        }
        foreach ($outp[2] as $data) {
            echo "
                    <tr>
                    <td style='text-align: center;'>" . $no . "</td>
                    <td>" . $data['lain'] . "</td>
                    <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                    </tr>";
            $no++;
        }
        foreach ($outp[3] as $data) {
            echo "
                    <tr>
                    <td style='text-align: center;'>" . $no . "</td>
                    <td>" . $data['kimia_klinik'] . "</td>
                    <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                    </tr>";
            $no++;
        }
        foreach ($outp[4] as $data) {
            echo "
                    <tr>
                    <td style='text-align: center;'>" . $no . "</td>
                    <td>" . $data['karbohidrat'] . "</td>
                    <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                    </tr>";
            $no++;
        }
        // }
    }
    if (mysqli_multi_query($conn, $sql2)) {
        do {
            // Store first result set
            if ($result = mysqli_store_result($conn)) {
                $outp2[] = $result->fetch_all(MYSQLI_ASSOC);
                // Fetch one and one row
            }
        } while (mysqli_next_result($conn));
        // foreach ($outp2 as $key => $subArray) {
        foreach ($outp2[0] as $data) {
            echo "
                <tr>
                <td style='text-align: center;'>" . $no . "</td>
                <td>" . $data['lipid'] . "</td>
                <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                </tr>";
            $no++;
        }
        foreach ($outp2[1] as $data) {
            echo "
                <tr>
                <td style='text-align: center;'>" . $no . "</td>
                <td>" . $data['enzim'] . "</td>
                <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                </tr>";
            $no++;
        }
        foreach ($outp2[2] as $data) {
            echo "
                <tr>
                <td style='text-align: center;'>" . $no . "</td>
                <td>" . $data['elektrolit'] . "</td>
                <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                </tr>";
            $no++;
        }
        foreach ($outp2[3] as $data) {
            echo "
                <tr>
                <td style='text-align: center;'>" . $no . "</td>
                <td>" . $data['organ'] . "</td>
                <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                </tr>";
            $no++;
        }
        foreach ($outp2[4] as $data) {
            echo "
                <tr>
                <td style='text-align: center;'>" . $no . "</td>
                <td>" . $data['hormon'] . "</td>
                <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                </tr>";
            $no++;
        }
        // }
        echo "
        <tr>
        <td style='text-align: center;'>99</td>
        <td>TOTAL</td>
        <td id='jumlah1' style='text-align: right;'></td>
        </tr>";
    }
}

mysqli_close($conn);
