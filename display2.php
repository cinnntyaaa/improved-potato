<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <title>RSI Muhammadiyah Sumberrejo</title>
    <link rel="icon" type="image/png" href="img/logomuh.png">

    <script type="text/JavaScript">
        function AutoRefresh( t ) {
    setTimeout("location.reload(true);", t);
    }
    </script>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            background-image: linear-gradient(to top, #abbaab, #ffffff);
            background-attachment: fixed;
            height: auto
        }

        table,
        td,
        th {
            font-size: 28px;
            column-rule-style: bold !important;
            border: 3px solid black !important;
            font-weight: bold;
        }

        th {
            text-align: center;
            background-color: #ffffff;
            color: black;
        }

        td {
            text-transform: uppercase;
        }

        tr:nth-child(odd) {
            background-color: #1f4287;
            color: white;
        }

        tr:nth-child(even) {
            background-color: white;
            color: #1f4287;
        }

        .roww {
            display: flex;
            flex-direction: row;
            align-items: center;
            align-content: center;
            padding: 10px 10px 15px 10px;
            justify-content: center;
        }

        .main {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            padding-left: 10px;
            font-size: 22px;
            color: black;

        }

        img {
            border-radius: 50%;
            width: 30px;
        }
    </style>
</head>


<body onload="JavaScript:AutoRefresh(3000);">
    <div class='roww'>
        <img src="img/rsi.jpg" alt="rsi">
        <div class='main'>
            <a>LAYAR ANTRIAN RUMAH SAKIT ISLAM MUHAMMADIYAH SUMBERREJO</a>
        </div>
    </div>
    <div class="container">
        <div class="row" style="margin-right: -125px; margin-left: -125px;">
            <div class="table-responsive-lg col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Poliklinik</th>
                            <th scope="col">No. Antrian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksii.php";
                        $no = 1;
                        $sql = "SELECT IFNULL(b.tanggal, DATE_FORMAT(NOW(),'%Y-%m-%d')), a.nama_poliklinik, a.kode_poliklinik,
                        IFNULL((SELECT MAX(c.nomor_antrian) FROM antrian c WHERE c.status LIKE 'Telah Dipanggil' AND c.poliklinik_id_poliklinik = a.id_poliklinik),0) as nomor_antrian 
                        FROM poliklinik a 
                        LEFT JOIN antrian b ON a.id_poliklinik = b.poliklinik_id_poliklinik
                        GROUP BY(a.id_poliklinik) 
                        ORDER BY(a.nama_poliklinik) ASC LIMIT 9";
                        $query = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                            echo "
                            <tr>
                            <td>" . $data['nama_poliklinik'] . "</td>
                            <td style='text-align: center;'>" . ($data['nomor_antrian'] == 0 ? "" : $data['kode_poliklinik']) . " " . ($data['nomor_antrian'] == 0 ? "-" : $data['nomor_antrian']) . "</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="table-responsive col-md-6">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">Poliklinik</th>
                            <th scope="col">No. Antrian</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include "koneksii.php";
                        $no = 1;
                        $sql = "SELECT IFNULL(b.tanggal, DATE_FORMAT(NOW(),'%Y-%m-%d')), a.nama_poliklinik, a.kode_poliklinik,
                        IFNULL((SELECT MAX(c.nomor_antrian) FROM antrian c WHERE c.status LIKE 'Telah Dipanggil' AND c.poliklinik_id_poliklinik = a.id_poliklinik),0) as nomor_antrian 
                        FROM poliklinik a 
                        LEFT JOIN antrian b ON a.id_poliklinik = b.poliklinik_id_poliklinik
                        GROUP BY(a.id_poliklinik) 
                        ORDER BY(a.nama_poliklinik) ASC LIMIT 9,20";
                        $query = mysqli_query($conn, $sql);
                        while ($data = mysqli_fetch_array($query)) {
                            echo "
                            <tr>
                            <td>" . $data['nama_poliklinik'] . "</td>
                            <td style='text-align: center;'>" . ($data['nomor_antrian'] == 0 ? "" : $data['kode_poliklinik']) . " " . ($data['nomor_antrian'] == 0 ? "-" : $data['nomor_antrian']) . "</td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
</body>

</html>