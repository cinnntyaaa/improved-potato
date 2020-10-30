<?php require "./template/template_verifikator/header.php" ?>
<main>
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Dashboard</h1>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary">Daftar Antrian Poliklinik Tanggal <?= date('d-m-Y', time()); ?></h6>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
            <thead style="text-align: center;">
              <tr>
                <th>Nama Poliklinik</th>
                <th>Jumlah Pasien</th>
                <th>Belum Dilayani</th>
                <th>Sudah Dilayani</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include "koneksii.php";
              $sql = "SELECT 
                      b.nama_poliklinik AS 'Klinik', COUNT(*) AS 'Jumlah', (COUNT(*)-IFNULL(c.Jumlah,0)) AS 'Belum',
                      IFNULL(c.Jumlah,0) AS 'Sudah' FROM `antrian` a 
                      INNER JOIN poliklinik b ON b.id_poliklinik = a.poliklinik_id_poliklinik
                      LEFT JOIN (
                        SELECT d.id_poliklinik, COUNT(*) AS 'Jumlah' FROM poliklinik d INNER JOIN antrian e ON e.poliklinik_id_poliklinik = d.id_poliklinik
                        WHERE e.tanggal LIKE DATE_FORMAT(NOW(),'%Y-%m-%d') AND e.`status` LIKE 'Telah Dipanggil' GROUP BY(e.poliklinik_id_poliklinik)
                      ) c ON c.id_poliklinik = b.id_poliklinik 
                      WHERE a.tanggal LIKE DATE_FORMAT(NOW(),'%Y-%m-%d')
                      GROUP BY(a.poliklinik_id_poliklinik);";
              $query = mysqli_query($conn, $sql);
              while ($data = mysqli_fetch_array($query)) {
                echo "
                <tr>
                  <td>" . $data['Klinik'] . "</td>
                  <td style='text-align: right;'>" . $data['Jumlah'] . "</td>
                  <td style='text-align: right;'>" . $data['Belum'] . "</td>
                  <td style='text-align: right;'>" . $data['Sudah'] . "</td>
                </tr>";
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