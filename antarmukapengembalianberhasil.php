<?php 

session_start();

if (isset($_SESSION['username'])) {

?>

<!DOCTYPE html>
<html>
	<head>
		<title>login</title>
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
			<div class="rightHeader buttonMenu green">
				<a href="logout.php"><img src="img/logoLogout.png" alt="Logout"/>
					<div>Logout</div></a>
			</div>
		</div>
		<div id="main">
			<div id="wrapper4">
				<h1>Pengembalian Berhasil</h1>
				<table border="collapse" class="left border">
					<tr>
						<td class="specialTd">Id Anggota</td>
						<td><?php echo $_SESSION['idAnggota']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">Nama</td>
						<td><?php echo $_SESSION['namaAnggota']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">tanggal harus kembali</td>
						<td><?php echo $_SESSION['tanggalHarusKembali']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">tanggal kembali</td>
						<td><?php echo $_SESSION['tanggalKembali']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">Selisih</td>
						<td><?php echo $_SESSION['selisihHari']; ?></td>
					</tr>
					<tr>
						<td class="specialTd">Denda</td>
						<td><?php echo $_SESSION['jumlahDenda']; ?></td>
					</tr>
				</table>
			<a href="#">	<div class="back">
					<div class="text">Lanjut</div>
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