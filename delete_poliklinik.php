<!-- delete_poliklinik -->
<?php
include "koneksii.php";
// $del = $_GET['del'];
$sql = "DELETE FROM antrian WHERE tanggal < DATE_FORMAT(NOW(), '%Y-%m-%d')";
// $sql = "delete from petugas where id_poliklinik='$del' ";
$query = mysqli_query($conn,$sql);
if($query){
	?>
	<script>alert("Data Berhasil Dihapus");
	document.location='inforeset_petugasrj.php'</script>
	<?php
}
?>