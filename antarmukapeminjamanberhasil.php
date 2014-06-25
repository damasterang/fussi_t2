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
			<div id="wrapper4">
				<h1>Peminjaman Berhasil</h1>
				<table border="collapse" class="left border">
					<tr>
						<td class="specialTd">Id Koleksi</td>
						<td><?php echo $_SESSION['idKoleksi']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">Judul Koleksi</td>
						<td><?php echo $_SESSION['judulKoleksi']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">Id Anggota</td>
						<td><?php echo $_SESSION['idAnggota']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">Nama</td>
						<td><?php echo $_SESSION['namaAnggota']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">tanggal pinjam</td>
						<td><?php echo $_SESSION['tanggalPinjam']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">tanggal harus kembali</td>
						<td><?php echo $_SESSION['tanggalHarusKembali']; ?></td>
					</tr>
				</table>  
			<a href="#">	<div class="back">
					<div class="text">Pinjam</div>
					<img id="arrowBack" src="img/arrowBack.png" alt="arrow"/>
				</div>	</a>
			</div>
		</div>
	</body>
</html>

<?php 
} else {
	header("location:login.php?errorMsg=3");
}

?>