<?php include_once 'connect.php'; ?>

<?php
	
	
	session_start();

	session_unset();

	session_destroy();

	header("location:antarmukaindex.php");

?>