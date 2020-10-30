<?php
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
header("Content-type: application/vnd-ms-excel");
header('Content-Disposition: attachment; filename="MorbiditasRI ' . date('Ymd', strtotime($tanggal)) . '-' . date('Ymd', strtotime($tanggal2)) . '.xls"');
header("Pragma: no-cache");
header("Expires: 0");
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

</head>

<body id="page-top">
    <?php
    include "koneksii2.php";

    $no = 1;
    $sql = "CALL RL_4_A ('" . $tanggal . "', '" . $tanggal2 . "');";
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
    ?>
        <span style="color:black; font-weight:bolder;">RL 4A Morbiditas Pasien Rawat Inap</span>
        <table border="1" width="100%">
            <thead style="text-align: center;">
                <tr>
                    <th rowspan="3">No. Urut</th>
                    <th rowspan="3">No. DTD</th>
                    <th rowspan="3">No. Daftar Terperinci</th>
                    <th rowspan="3">Golongan Sebab Penyakit</th>
                    <th colspan="18">Jumlah Pasien Hidup dan Mati Menurut Golongan Umur & Jenis Kelamin</th>
                    <th colspan="2">Pasien Keluar (Hidup & Mati) Menurut Jenis Kelamin</th>
                    <th rowspan="3">Jumlah Pasien Keluar Hidup (23 + 24)</th>
                    <th rowspan="3">Jumlah Pasien Keluar Mati</th>
                </tr>
                <tr>
                    <th colspan="2">0-6hr</th>
                    <th colspan="2">7-28hr</th>
                    <th colspan="2">28hr-<1th</th> <th colspan="2">1-4th</th>
                    <th colspan="2">5-14th</th>
                    <th colspan="2">15-24th</th>
                    <th colspan="2">25-44th</th>
                    <th colspan="2">45-64th</th>
                    <th colspan="2">>65th</th>
                    <th rowspan="2">LK</th>
                    <th rowspan="2">PR</th>
                </tr>
                <tr>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                    <th>L</th>
                    <th>P</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th>2</th>
                    <th>3</th>
                    <th>4</th>
                    <th>5</th>
                    <th>6</th>
                    <th>7</th>
                    <th>8</th>
                    <th>9</th>
                    <th>10</th>
                    <th>11</th>
                    <th>12</th>
                    <th>13</th>
                    <th>14</th>
                    <th>15</th>
                    <th>16</th>
                    <th>17</th>
                    <th>18</th>
                    <th>19</th>
                    <th>20</th>
                    <th>21</th>
                    <th>22</th>
                    <th>23</th>
                    <th>24</th>
                    <th>25</th>
                    <th uncollapse="">26</th>
                </tr>
            </thead>
            <tbody id="morbid_RI">
            <?php
            foreach ($outp as $data) {
                echo "
                    <tr>
                    <td>" . $no . "</td>
                    <td>" . $data['dtd'] . "</td>
                    <td class='icd'>" . $data['icd'] . "</td>
                    <td>" . $data['gol'] . "</td>
                    <td style='text-align: right'>" . $data['men_7'] . "</td>
                    <td style='text-align: right'>" . $data['women_7'] . "</td>
                    <td style='text-align: right'>" . $data['men_28'] . "</td>
                    <td style='text-align: right'>" . $data['women_28'] . "</td>
                    <td style='text-align: right'>" . $data['men_1'] . "</td>
                    <td style='text-align: right'>" . $data['women_1'] . "</td>
                    <td style='text-align: right'>" . $data['men_4'] . "</td>
                    <td style='text-align: right'>" . $data['women_4'] . "</td>
                    <td style='text-align: right'>" . $data['men_14'] . "</td>
                    <td style='text-align: right'>" . $data['women_14'] . "</td>
                    <td style='text-align: right'>" . $data['men_24'] . "</td>
                    <td style='text-align: right'>" . $data['women_24'] . "</td>
                    <td style='text-align: right'>" . $data['men_44'] . "</td>
                    <td style='text-align: right'>" . $data['women_44'] . "</td>
                    <td style='text-align: right'>" . $data['men_64'] . "</td>
                    <td style='text-align: right'>" . $data['women_64'] . "</td>
                    <td style='text-align: right'>" . $data['men_65'] . "</td>
                    <td style='text-align: right'>" . $data['women_65'] . "</td>
                    <td style='text-align: right'>" . $data['sum_men'] . "</td>
                    <td style='text-align: right'>" . $data['sum_women'] . "</td>
                    <td style='text-align: right'>" . $data['sum_live'] . "</td>
                    <td style='text-align: right'>" . $data['sum_gone'] . "</td>
                    </tr>";
                $no++;
            }
        }
        mysqli_close($conn);
            ?>
            </tbody>
        </table>

</body>

</html>