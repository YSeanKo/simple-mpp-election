<?php
	include("db/dbc.php");
	session_start();

	// Defining your login details into variables
	$myusername=$_POST['myusername'];
	$mypassword=$_POST['mypassword'];
	
	// MySQL injection protections
	$myusername = mysqli_real_escape_string($conn, $myusername);
	//$mypassword = mysqli_real_escape_string($conn, $mypassword);

	//Query data for login
	$sql="SELECT id, no_staf, nama_penuh, no_kp, kata_laluan FROM jpentadbir WHERE no_staf='$myusername'" or die(mysql_error());
	$result=mysqli_query($conn, $sql) or die(mysqli_error());
	$user = mysqli_fetch_assoc($result);

	if(password_verify($mypassword, $user['kata_laluan'])){
		$_SESSION['id_pentadbir'] = $user['id'];
		$_SESSION['no_staf'] 	  = $user['no_staf'];
		$_SESSION['nama_penuh']   = $user['nama_penuh'];
		$_SESSION['no_kp'] 		  = $user['no_kp'];
		
		//Query status_pengundian
		$sql="SELECT * FROM jflag jf WHERE jf.id=0" or die(mysqli_error());
		$result=mysqli_query($conn, $sql) or die(mysqli_error());
		
		$stat = mysqli_fetch_assoc($result);

		//Save status_pengundian in SESSION
		$_SESSION['status_pengundian'] = $stat['status_pengundian'];
		
		header("location:home.php");
	}
	//If the username or password is wrong, you will receive this message below.
	else {
		$_SESSION['errors'] = array("&nbsp;&nbsp;ID Staf atau Kata Laluan tidak tepat.");
		header("Location:index.php");
	}
?>