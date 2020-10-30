<?php
require "template/template_verifikator/header.php";
$tanggal = $_POST['tanggal'];
$tanggal2 = $_POST['tanggal2'];
$klinik = $_POST['klinik'];
$id = $_POST['id'];
?>
<script type="text/javascript">
    function batalkan() {
        const param = document.getElementsByName("id");
        const btn_batal = document.getElementById("batal_btn");

        exchanger(param[1].value, "batal1.php", function(res) {
            if (res > 0) {
                console.log(res + " query1 berhasil diubah.");

                exchanger(param[1].value, "batal2.php", function(ros) {
                    if (ros > 0) {
                        console.log(ros + " query2 berhasil diubah.");
                        alert("data berhasil dibatalkan");

                        btn_batal.disabled = true;
                    } else {
                        alert("Gagal ubah pulang simrs");
                    }
                });

            } else {
                alert("Tidak ada data yang di ubah.");
            }
        });
    }

    function exchanger(idk, alamat, callback) {
        var xhr;
        if (window.XMLHttpRequest) {
            xhr = new XMLHttpRequest();
        } else {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }

        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                callback(xhr.responseText);
            }
        }

        xhr.onerror = function() {
            callback("404 Network Unavailable..!");
        }

        xhr.open("POST", alamat, true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.send("idkunjungan=" + idk);
    }
</script>
<main>
    <!-- Begin Page Content -->
    <div class="container-fluid">

        <!-- Page Heading -->
        <form action="validasi2.php" method="post">
            <button class="btn btn-primary m-2" type="submit">Kembali</button>
            <input type="hidden" name="tanggal" value="<?php echo $tanggal; ?>">
            <input type="hidden" name="tanggal2" value="<?php echo $tanggal2; ?>">
            <input type="hidden" name="klinik" value="<?php echo $klinik; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
        </form>

        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
                        <thead style="text-align: center;">
                            <tr>
                                <th>No.</th>
                                <th>No. RM</th>
                                <th>Nama</th>
                                <th>Unit Pelayanan</th>
                                <th>Status</th>
                                <th>Proses</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include "koneksii2.php";
                            $no = 1;
                            $sql = "SELECT b.kunjungan_id AS 'idkunj', c.no_rm AS 'rm', c.nama AS 'nama',
                                        CONCAT ('<li>', GROUP_CONCAT(d.nama SEPARATOR '</li><li>'),'</li>') AS 'unit',
                                        CONCAT('<li>', GROUP_CONCAT(
                                        IF(b.dilayani > 0,' Sudah Dilayani',' Belum dilayani') SEPARATOR '</li><li>'),'</li>') AS 'status',
                                        a.batal as 'batal'
                                        FROM `b_kunjungan` a
                                        INNER JOIN b_ms_pasien c ON c.id = a.pasien_id
                                        LEFT JOIN b_pelayanan b ON b.kunjungan_id = a.id
                                        INNER JOIN b_ms_unit d ON d.id = b.unit_id
                                        WHERE a.id = " . $_POST['idkunj'] . "";
                            $query = mysqli_query($conn, $sql);
                            while ($data = mysqli_fetch_array($query)) {
                                $disabled = ($data['batal'] == 1 ? 'disabled' : '');
                                echo "
                                                <tr>
                                                <td style='text-align: center;'>" . $no . "</td>
                                                <td>" . $data['rm'] . "</td>
                                                <td>" . $data['nama'] . "</td>
                                                <td>" . $data['unit'] . "</td>
                                                <td>" . $data['status'] . "</td>
                                                <td style='text-align: center;'>
                                                <form action='' method='post'>
                                                <input id='batal_btn' type='button' onclick='batalkan()' value='Batalkan Kunjungan' class='btn btn-primary' $disabled/>
                                                <input type='hidden' name='id' value='" . $data['idkunj'] . "'/></form></td>
                                                </tr>";
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->
</main>
<?php require "template/template_verifikator/footer.php" ?>