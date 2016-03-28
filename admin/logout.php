<?php 
	//Start session
	session_start();
	
	//Destroy all session variables 
	session_destroy();
	
	header("location:index.php");
?>
