<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
include "koneksii2.php";
if (strlen($tanggal) < 1 || strlen($tanggal2) < 1) {
    echo "<script>alert('Pilih Format Tanggal Yang Benar')</script>";
} else {
    $sql = "CALL pxRegion_Kunjungan ('" . $tanggal . "', '" . $tanggal2 . "');";
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
        echo "
        <table class='table table-bordered table-fixed' cellspacing='0' style='align-content: center; color:black;'>
        <thead style='text-align: center;'>
            <tr>
            <th style='border:none; text-align:left !important'>Rawat Jalan</th>
            </tr>
            <tr>
                <th>Unit</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>";
        foreach ($outp[0] as $data) {
            echo "
            <tr>
            <td>" . $data['unit'] . "</td>
            <td>" . $data['desa'] . "</td>
            <td>" . $data['kecamatan'] . "</td>
            <td>" . $data['kabupaten'] . "</td>
            <td>" . $data['provinsi'] . "</td>
            <td style='text-align: right;'>" . $data['sum_rj'] . "</td>
            </tr>";
        }
        echo "
        <table class='table table-bordered table-fixed' cellspacing='0' style='align-content: center; color:black;'>
        <thead style='text-align: center;'>
            <tr>
            <th style='border:none; text-align:left !important'>Rawat Inap</th>
            </tr>
            <tr>
                <th>Unit</th>
                <th>Desa</th>
                <th>Kecamatan</th>
                <th>Kabupaten</th>
                <th>Provinsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>";
        foreach ($outp[1] as $data) {
            echo "
            <tr>
            <td>" . $data['unit'] . "</td>
            <td>" . $data['desa'] . "</td>
            <td>" . $data['kecamatan'] . "</td>
            <td>" . $data['kabupaten'] . "</td>
            <td>" . $data['provinsi'] . "</td>
            <td style='text-align: right;'>" . $data['sum_ri'] . "</td>
            </tr>";
        }
        echo "
        <tr>
        <td colspan='2' style='text-align: center; font-weight:bolder'>TOTAL</td>
        <td id='jumlah1' style='text-align: right;'></td>
        </tr>";
    }
}

mysqli_close($conn);
