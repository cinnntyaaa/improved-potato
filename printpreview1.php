<?php
$tanggal = $_GET['t1'];
$tanggal2 = $_GET['t2'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Verifikator</title>
    <link rel="icon" type="image/png" href="img/logomuh.png">
    <script src="vendor/jquery/jquery.min.js"></script>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}
th {
    text-align: center !important;
}
td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
@media print {
   body { font-size: 8pt }
 }
</style>
</head>

<body id="page-top">
    <?php
    include "koneksii2.php";

    $no = 1;
    $sql = "CALL RL_3_13 ('" . $tanggal . "', '" . $tanggal2 . "');";
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
    ?>
        <span style="color:black; font-weight:bolder; font-size:larger">RL 3.13 PENGADAAN OBAT, PENULISAN DAN PELAYANAN RESEP</span><br>
        <span style="color:black; font-weight:bolder; font-size:large">A. Pengadaan Obat</span>
        <table width="80%">
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Golongan Obat</th>
                    <th>Jumlah Item Obat</th>
                    <th>Jumlah Item Obat yang Tersedia di RS</th>
                    <th>Jumlah Item Obat Formulatorium Tersedia di RS</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th uncollapse="">5</th>
                </tr>
            </thead>
            <tbody id="pengadaan-obat">
                <?php
                foreach ($outp as $key => $subArray) {
                    if ($key < 3) {
                        foreach ($subArray as $key => $data) {
                            echo "
                            <tr>
                            <td style='text-align: center;'>" . $no . "</td>
                            <td>" . $data['item_gol'] . "</td>
                            <td style='text-align: right;'>" . $data['sum_item'] . "</td>
                            <td style='text-align: right;'>" . $data['sum_all'] . "</td>
                            <td style='text-align: right;'>" . $data['sum_formula'] . "</td>
                            </tr>";
                            $no++;
                        }
                    }
                }
                echo "
            <tr>
            <td style='text-align: center;'>99</td>
            <td>TOTAL</td>
            <td id='jumlah4' style='text-align: right;'></td>
            <td id='jumlah5' style='text-align: right;'></td>
            <td id='jumlah6' style='text-align: right;'></td>
            </tr>";
                ?>
            </tbody>
        </table>
        <span style="color:black; font-weight:bolder; font-size:large">B. Penulisan dan Pelayanan Resep</span>
        <table width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th>No.</th>
                    <th>Golongan Obat</th>
                    <th>Jumlah Item Obat</th>
                    <th>Jumlah Item Obat yang Tersedia di RS</th>
                    <th>Jumlah Item Obat Formulatorium Tersedia di RS</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th uncollapse="">5</th>
                </tr>
            </thead>
            <tbody id="penulisan-resep">
                <?php
                foreach ($outp as $key => $subArray) {
                    if ($key > 2) {
                        foreach ($subArray as $key => $data) {
                            echo "
                        <tr>
                        <td style='text-align: center;'>" . $no . "</td>
                        <td>" . $data['item_gol'] . "</td>
                        <td style='text-align: right;'>" . $data['sum_rj'] . "</td>
                        <td style='text-align: right;'>" . $data['sum_igd'] . "</td>
                        <td style='text-align: right;'>" . $data['sum_ri'] . "</td>
                        </tr>";
                            $no++;
                        }
                    }
                }
                echo "
            <tr>
            <td style='text-align: center;'>99</td>
            <td>TOTAL</td>
            <td id='jumlah4' style='text-align: right;'></td>
            <td id='jumlah5' style='text-align: right;'></td>
            <td id='jumlah6' style='text-align: right;'></td>
            </tr>";
                ?>
            </tbody>
        </table>
    <?php
        mysqli_close($conn);
    }
    ?>

    <script>
        function hitungJumlah2() {
            var jumlah4 = 0;
            var jumlah5 = 0;
            var jumlah6 = 0;
            $("body #pengadaan-obat tr")
                .not(":last")
                .each(function(e) {
                    jumlah4 += parseInt($(this).find("td:eq(2)").text());
                    jumlah5 += parseInt($(this).find("td:eq(3)").text());
                    jumlah6 += parseInt($(this).find("td:eq(4)").text());
                });
            $("#jumlah4").text(jumlah4);
            $("#jumlah5").text(jumlah5);
            $("#jumlah6").text(jumlah6);
        }
        hitungJumlah2();
    </script>
</body>

</html>