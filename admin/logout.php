<?php 
	//Start session
	session_start();
	
	//Destroy all session variables 
	//session_destroy();
	unset($_SESSION['id_pentadbir']);
	unset($_SESSION['no_staf']);
	unset($_SESSION['nama_penuh']);
	unset($_SESSION['no_kp']);

	header("location:index.php");
?>
