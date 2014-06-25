<?php 

session_start();

if (isset($_SESSION['username'])) {

?>
<!DOCTYPE html>
<html>
	<head>
		<title>login</title>
		<link rel="stylesheet" type="text/css" href="css/newStyle.css">
		<script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
		<script type="text/javascript" src="js/myJs.js"></script>
	</head>
	<body>
		<div id="header">
			<div class="logo">
				<img src="img/logoUns.png" alt="Logo UNS"/>
				<div>Perpustakaan Universitas Sebelas Maret</div>
			</div>
			<div class="rightHeader buttonMenu orange">
				<a href="antarmukaindex.php"><img src="img/logoHome.png" alt="Home"/>
					<div>home</div></a>
			</div>
			<div class="rightHeader buttonMenu green">
				<a href="logout.php"><img src="img/logoLogout.png" alt="Logout"/>
					<div>Logout</div></a>
			</div>
		</div>
		<div id="main">
			<div id="wrapper2">
				<h1>Pengembalian Koleksi</h1>
				<form action="process.php?a=pengembalian" method="POST">
					<table border="collapse">
						<tr>
							<td><div class="label">Id Anggota</div></td>
							<td>:</td>
							<td><input type="text" name="idAnggota" placeholder="input id anggota"/></td>
						</tr>
						<tr>
							<td><div class="label">Id Koleksi</div></td>
							<td>:</td>
							<td><input type="text" name="idKoleksi" placeholder='input id koleksi'/></td>
						</tr>
					</table>
					<div class="wrapperErrorLogin">
						<?php 

							if (isset($_GET['errorMsg'])) {
								if ($_GET['errorMsg'] == 1) {
									echo "<div class='errorLogin'>id Anggota or id collection null</div>";
								} elseif($_GET['errorMsg'] == 2){
									echo "<div class='errorLogin'>fill the form first</div>";
								} elseif($_GET['errorMsg'] == 3){
									echo "<div class='errorLogin'>your transaction is succeed</div>";
								} elseif ($_GET['errorMsg'] == 4) {
									echo "<div class='errorLogin'>error maks pinjam</div>";
								} elseif ($_GET['errorMsg'] == 5) {
									echo "<div class='errorLogin'>tidak boleh memperpanjang lagi</div>";
								} elseif ($_GET['errorMsg'] == 6) {
									echo "<div class='errorLogin'>gagal memasukan data</div>";
								} 
							}

						?>
					</div>
					<button type="submit" name="submit">Lanjut</button>
				</form>
			</div>
		</div>
	</body>
</html>

<?php 

	if (isset($_GET['errorMsg'])) {
		echo "<script type='text/javascript'>
		$('.errorLogin').fadeIn();
		$('.errorLogin').delay(5000).fadeOut();
		</script>";
	}

?>

<?php

} else {
	header("location:antarmukalogin.php?errorMsg=3");
}

?>