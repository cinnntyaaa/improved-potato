<?php require "template/template_verifikator/header.php" ?>
<main>
  <!-- Begin Page Content -->
  <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Rekapitulasi</h1>
    <div class="card shadow mb-4">
      <div class="card-header py-3">
        <form action="" id="cari" method="post" class="form-inline">
          <h5 class="m-0 font-weight-bold text-primary">Daftar Antrian Poliklinik Tanggal</h5>
          <div class="form-group mx-sm-3">
            <input id="tanggal" name="tanggal" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" />
          </div>
          <h5 class="m-0 font-weight-bold text-primary">s/d</h5>
          <div class="form-group mx-sm-3">
            <input id="tanggal2" name="tanggal2" type="text" class="form-control" placeholder="Tanggal" style="text-align: center;" autocomplete="off" />
          </div>
          <button id="submit" type="submit" class="btn btn-primary">Cari</button>
        </form>
        <!--Tambahin ini juga-->
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0" style="width:100%; align-content: center; color:black;">
            <thead style="text-align: center;">
              <tr>
                <th>No.</th>
                <th>Nama Poliklinik</th>
                <th>Jumlah Pasien</th>
                <th>Belum Dipanggil</th>
                <th>Telah Dipanggil</th>
                <th>Belum Bayar</th>
                <th>Batal Periksa</th>
                <th>Proses</th>
              </tr>
            </thead>
            <tbody id="body-content">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  <!-- /.container-fluid -->

  </div>
</main>
<!-- End of Main Content -->
<?php require "template/template_verifikator/footer.php" ?>
<!-- // tambahan ini -->
<script>
  $(function() {
    $('#tanggal').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
  })

  $(function() {
    $('#tanggal2').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    });
  })

  $('#cari').on('submit', function(e) {
    e.preventDefault();
    $('#loader-container').toggleClass('d-block')
    $('#body-content').html('');
    var tanggal1 = $('#tanggal').val()
    var tanggal2 = $('#tanggal2').val()
    console.log(tanggal1, tanggal2)
    $.ajax({
      url: 'proses_rekapitulasi.php',
      type: 'POST',
      data: {
        tanggal: tanggal1,
        tanggal2: tanggal2
      },
      dataType: 'html',
      success: function(data) {

        $('#body-content').html(data);
        $('#loader-container').toggleClass('d-block')
        //Moved the hide event so it waits to run until the prior event completes
        //It hide the spinner immediately, without waiting, until I moved it here
        // $('#loading_spinner').hide();
      },
      error: function() {
        alert("Something went wrong!");
      }
    });
  })
</script>