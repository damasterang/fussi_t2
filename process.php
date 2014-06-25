<?php
		
	
	include "function.php";


	if ($_GET['a'] == 'login') {

		if (isset($_POST['username']) && isset($_POST['password'])) {
			
			$username = $_POST['username'];
			$password = $_POST['password'];

			if ($username == '' || $password == '') {
				header('location: antarmukalogin.php?errorMsg=2');
				exit();
			}

			session_start();

			$cek = loginPustakawan($username, $password);

			if ($cek >= 1) {
				$level = getDataLevel($username, $password);
				$idPustakawan = getDataIdPustakawan($username, $password);
				$_SESSION['level'] = $level;
				$_SESSION['idPustakawan'] = $idPustakawan;
				$_SESSION['username'] = $username;
				if ($_SESSION['level'] == 'admin') {
					header("location:antarmukaadmin.php");	
				} else {
					header("location:antarmukasuperadmin.php");	
				}
			} else {
				header('location: antarmukalogin.php?errorMsg=1');
			}
			
		} else {
			header('location: antarmukalogin.php?errorMsg=2');
		}
	} elseif ($_GET['a'] == 'peminjaman') {
		
		if (isset($_POST['idAnggota']) && isset($_POST['idKoleksi'])) {

			$idAnggota = $_POST['idAnggota'];
			$idKoleksi = $_POST['idKoleksi'];

			if ($idAnggota == '' || $idKoleksi == '') {
				header('location: antarmukapeminjaman.php?errorMsg=2');
				exit();
			}

			session_start();

			$cekMahasiswa 	= getVal('anggota', 'idAnggota' , $idAnggota);
			$cekKoleksi 	= getVal('koleksi', 'idKoleksi' , $idKoleksi);

			// echo "$cekMahasiswa";

			if ($cekMahasiswa > 0) {
				if ($cekKoleksi > 0) {

					$cekMaksPeminjaman = cekMaksPeminjaman($idAnggota);

					if ($cekMaksPeminjaman <= 5) {

						updatePinjamKoleksi($idKoleksi);
						
						$cekSudahDikembalikan = cekSudahDikembalikan($idAnggota, $idKoleksi);

						if ($cekSudahDikembalikan == 0) {
											
								$perpanjangan = 1;

								$date = date('Y-m-j');
								$newDate = calculateDate($date);
								
								$masukan = masukanPeminjaman($idAnggota, $idKoleksi, $_SESSION['idPustakawan'], $date, $newDate, $perpanjangan);
								if ($masukan) {
									$_SESSION['idAnggota'] = $idAnggota;
									$_SESSION['namaAnggota'] = getData('anggota','nama','idAnggota',$idAnggota);
									$_SESSION['idKoleksi'] = $idKoleksi;
									$_SESSION['judulKoleksi'] = getData('koleksi','judulAnggota','idKoleksi',$idKoleksi);
									$_SESSION['tanggalPinjam'] = $date;
									$_SESSION['tanggalHarusKembali'] = $newDate;
									header('location:antarmukapeminjamanberhasil.php');
								} else {
									header('location:antarmukapeminjaman.php?errorMsg=7'); //error memasukan data
								}
								
							} else {

								$idPeminjaman = getIdPeminjaman($idAnggota, $idKoleksi);
								$cekMaksPerpanjangan = cekMaksPerpanjangan($idPeminjaman);
								echo $cekMaksPerpanjangan;

								if ($cekMaksPerpanjangan < 3) {

									// if ($cekMaksPerpanjangan == '') {
									// 	$cekMaksPerpanjangan = 0;
									// }

									
									$perpanjangan = $cekMaksPerpanjangan+1;
									echo $perpanjangan;

									$date = date('Y-m-j');
									$newDate = calculateDate($date);
									
									$updatePerpanjangan = updatePerpanjangan($newDate, $perpanjangan, $idPeminjaman);
									if ($updatePerpanjangan) {
										$_SESSION['idAnggota'] = $idAnggota;
										$_SESSION['namaAnggota'] = getData('anggota','nama','idAnggota',$idAnggota);
										$_SESSION['idKoleksi'] = $idKoleksi;
										$_SESSION['judulKoleksi'] = getData('koleksi','judulKoleksi','idKoleksi',$idKoleksi);
										$_SESSION['tanggalPinjam'] = $date;
										$_SESSION['tanggalHarusKembali'] = $newDate;
										header('location:antarmukapeminjamanberhasil.php');
									} else {
										header('location:antarmukapeminjaman.php?errorMsg=6'); //error memasukan data
									}
								} else {
									header('location:antarmukapeminjaman.php?errorMsg=5'); //error tidak boleh memperpanjang lagi	
								}
								
							}
							
						} else {
							header('location:antarmukapeminjaman.php?errorMsg=4'); //error maks pinjam
						}

					} else {
						header("location:antarmukapeminjaman.php?errorMsg=1");	
					}

				} else {
					header("location:antarmukapeminjaman.php?errorMsg=1");
				}

			} else {
				header("location:antarmukapeminjaman.php?errorMsg=1");
			}

		} elseif ($_GET['a'] == 'pengembalian') {
			if (isset($_POST['idAnggota']) && isset($_POST['idKoleksi'])){
				$idAnggota = $_POST['idAnggota'];
				$idKoleksi = $_POST['idKoleksi'];

				if ($idAnggota == '' || $idKoleksi == '') {
					header('location: antarmukapengembalian.php?errorMsg=2');
					exit();
				}

				$cekSudahDikembalikan = cekSudahDikembalikan($idAnggota, $idKoleksi);

				if ($cekSudahDikembalikan > 0) {
					$date = strtotime(date('Y-m-j'));
					$idPeminjaman = getIdPeminjaman($idAnggota, $idKoleksi);
					$tanggalHarusKembali = getData('peminjaman','tanggalHarusKembali','idPeminjaman',$idPeminjaman);
					$tanggalHarusKembali = strtotime($tanggalHarusKembali);
					$selisihDetik = ($date-$tanggalHarusKembali);
					$selisihHari = $selisihDetik / 86400;
					if ($selisihHari < 1) {
						$jumlahDenda = 0;
						$selisihHari = 0;
						echo "tanpa denda";
					} else {
						$denda = getDenda();
						$jumlahDenda = $selisihHari * $denda;
					}

					updatePinjamPengembalian($idAnggota, $idKoleksi);

					masukanPengembalian($idPeminjaman, date('Y-m-d'), $jumlahDenda);

					session_start();

					$_SESSION['idAnggota'] = $idAnggota;
					$_SESSION['namaAnggota'] = getData('anggota','nama','idAnggota',$idAnggota);
					$_SESSION['tanggalHarusKembali'] = date('d-m-Y', $tanggalHarusKembali);
					$_SESSION['tanggalKembali'] = date('d-m-Y');
					// echo $_SESSION['tanggalKembali'];
					$_SESSION['selisihHari'] = $selisihHari;
					$_SESSION['jumlahDenda'] = $jumlahDenda;
					header('location: 	antarmukapengembalianberhasil.php');
				} else {
					header('location: antarmukapengembalian.php?errorMsg=3'); //sudah dikembalikan
					exit();
				}

			} else {
				header("location:antarmukapengembalian.php?errorMsg=1");
			}
		} else {
			header("location:antarmukalogin.php?errorMsg=1");
		}

?>