<!-- delete akun petugas -->
<?php
include "koneksii.php";
$del = $_GET['del'];
$sql = "delete from petugas where id_petugas='$del' ";
$query = mysqli_query($conn, $sql);
if ($query) {
?>
	<script>
		alert("Data Berhasil Dihapus");
		document.location = 'akunpetugas_admin.php'
	</script>
<?php
}
?>
<!-- delete_poliklinik -->
<?php
include "koneksii.php";
$del = $_GET['del'];
$sql = "delete from poliklinik where id_poliklinik='$del' ";
$query = mysqli_query($conn, $sql);
if ($query) {
?>
	<script>
		alert("Data Berhasil Dihapus");
		document.location = 'poliklinik_admin.php'
	</script>
<?php
}
?>
<!-- delete jamkes -->
<?php
include "koneksii.php";
$del = $_GET['del'];
$sql = "delete from jamkes where id_jamkes='$del' ";
$query = mysqli_query($conn, $sql);
if ($query) {
?>
	<script>
		alert("Data Berhasil Dihapus");
		document.location = 'jamkes_admin.php'
	</script>
<?php
}
?>