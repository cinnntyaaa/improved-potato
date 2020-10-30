<?php
error_reporting(0);
session_start();

if ($_SESSION["level"] == "Admin") {
	header("Location: dashboard_admin.php");
} else if ($_SESSION["level"] == "Petugas RJ") {
	header("Location: dashboard_petugasrj.php");
} else if ($_SESSION["level"] == "Perawat RJ") {
	header("Location: dashboard_perawatrj.php");
} else if ($_SESSION["level"] == "Verifikator") {
	header("Location: dashboard_verifikator.php");
} else if ($_SESSION["level"] == "SPI") {
	header("Location: dashboard_spi.php");
} else if ($_SESSION["level"] == "Apotek RJ") {
	header("Location: dashboard_apotekrj.php");
}
include "koneksii.php";
?>
<!DOCTYPE html>
<html>

<head>
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="styleee.css">
	<link rel="icon" type="image/png" href="img/logomuh.png">

</head>

<body>
	<div class='row'>
		<img src="img/rsi.jpg" alt="rsi">
		<div class='main'>
			<a>Rumah Sakit Islam<br>Muhammadiyah Sumberrejo</a>
		</div>
	</div>
	<div class="kotak_login">
		<form name="login" action="login.php" method="post">
			<input type="text" name="username" class="form_login" placeholder="Username" required>
			<input type="password" name="password" class="form_login" placeholder="Password" required>
			<input type="submit" class="tombol_login" value="LOGIN" name="submit">
			<br />
		</form>
	</div>
	<?php
	$username = $_POST['username'];
	$password = md5($_POST['password']);
	$submit = $_POST['submit'];
	if ($submit) {
		$sql = "select * from petugas where username='$username' and pass='$password'";
		$query = mysqli_query($conn, $sql);
		$hasil = mysqli_fetch_array($query);
		if ($hasil['level'] == "Admin") {
			$_SESSION['username'] = $hasil[username];
			$_SESSION['level'] = $hasil[level];
			$_SESSION['poliklinik'] = $hasil[poliklinik];

	?>
			<script>
				// alert("Anda Login Sebagai Admin");
				document.location = 'dashboard_admin.php';
			</script>
		<?php
		} else if ($hasil['level'] == "Petugas RJ") {
			$_SESSION['username'] = $hasil[username];
			$_SESSION['level'] = $hasil[level];
			$_SESSION['poliklinik'] = $hasil[poliklinik];
		?>
			<script>
				// alert("Anda Login Sebagai Petugas RJ");
				document.location = 'dashboard_petugasrj.php';
			</script>
		<?php
		} else if ($hasil['level'] == "Perawat RJ") {
			$_SESSION['username'] = $hasil[username];
			$_SESSION['level'] = $hasil[level];
			$_SESSION['poliklinik'] = $hasil[poliklinik];
		?>
			<script>
				// alert("Anda Login Sebagai Perawat RJ");
				document.location = 'dashboard_perawatrj.php';
			</script>
		<?php
		} else if ($hasil['level'] == "Verifikator") {
			$_SESSION['username'] = $hasil[username];
			$_SESSION['level'] = $hasil[level];
			$_SESSION['poliklinik'] = $hasil[poliklinik];
		?>
			<script>
				// alert("Anda Login Sebagai Verifikator");
				document.location = 'dashboard_verifikator.php';
			</script>
		<?php
		} else if ($hasil['level'] == "Display") {
			$_SESSION['username'] = $hasil[username];
			$_SESSION['level'] = $hasil[level];
			$_SESSION['poliklinik'] = $hasil[poliklinik];
		?>
			<script>
				// alert("Anda Login Sebagai Display");
				document.location = 'display2.php';
			</script>
		<?php
		} else if ($hasil['level'] == "Apotek RJ") {
			$_SESSION['username'] = $hasil[username];
			$_SESSION['level'] = $hasil[level];
			$_SESSION['poliklinik'] = $hasil[poliklinik];
		?>
			<script>
				// alert("Anda Login Sebagai Display");
				document.location = 'dashboard_apotekrj.php';
			</script>
		<?php
		}  else if ($hasil['level'] == "SPI") {
			$_SESSION['username'] = $hasil[username];
			$_SESSION['level'] = $hasil[level];
			$_SESSION['poliklinik'] = $hasil[poliklinik];
		?>
			<script>
				// alert("Anda Login Sebagai Display");
				document.location = 'dashboard_spi.php';
			</script>
		<?php 
		} else {
		?>
			<script>
				alert("Silakan Coba Lagi!");
				document.location = 'login.php';
			</script>
	<?php
		}
	}
	?>
</body>

</html>