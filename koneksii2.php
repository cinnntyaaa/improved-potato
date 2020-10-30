<?php 
// $conn = mysqli_connect("192.168.2.250","cintya","1234","db_sim_rs");
$conn = mysqli_connect("192.168.1.224","root","simrs2013","db_sim_rs");
// $conn = mysqli_connect("localhost","root","","db_sim_rs");
// Check connection
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
