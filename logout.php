<?php 
	//Start session
	session_start();
	
	//Destroy all session variables 
	//session_destroy();
	unset($_SESSION['id_pengguna']);
	
	header("location:index.php");
?>
