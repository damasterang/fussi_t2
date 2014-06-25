<?php 

	session_start();

	if (isset($_SESSION['username'])) {

 ?>

<!DOCTYPE html>
<html>
	<head>
		<title>admin</title>
		<link rel="stylesheet" type="text/css" href="css/newStyle.css">
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
			<div class="rightHeader buttonMenu purple">
				<a href="logout.php"><img src="img/logoLogout.png" alt="Logout"/>
					<div>Logout</div></a>
			</div>
		</div>
		<div id="main">
			<div id="wrapper3">
				<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
				<a href="antarmukapeminjaman.php" class="optionAdmin">Peminjaman Koleksi</a>
				<a href="antarmukapengembalian.php" class="optionAdmin">Pengembalian Koleksi</a>
				<a href="#" class="optionAdmin">Data Anggota</a>
				<a href="#" class="optionAdmin">Data Koleksi</a>
				<a href="#" class="optionAdmin">Cari Anggota</a>
				<a href="#" class="optionAdmin">Cari Koleksi</a>
			</div>
		</div>
	</body>
</html>

<?php } else {
		header('location:antarmukalogin.php?errorMsg=3');
		exit();
	}

?>