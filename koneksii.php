<?php 
// $conn = mysqli_connect("192.168.2.250","cintya","1234","dbantrian");
$conn = mysqli_connect("192.168.1.221","root","ROOT","dbantrian");
// $conn = mysqli_connect("localhost","root","","dbantrian");
// $conn = mysqli_connect("localhost","root","ROOT","dbantrian");
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}

?>