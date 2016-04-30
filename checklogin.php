<?php
	include("admin/db/dbc.php");
	session_start();

	// Defining your login details into variables
	$myusername=$_POST['myusername'];
	$mypassword=$_POST['mypassword'];
	
	// MySQL injection protections - \n, \r, \, ', " etc
	$myusername = mysqli_real_escape_string($conn, $myusername);
	//$mypassword = mysqli_real_escape_string($conn, $mypassword);
	//TODO: allow case insensitive username
	
	$tbl_name="jpelajar"; // Table name

	//Query status_pengundian
	$sql="SELECT status_pengundian FROM jflag" or die(mysqli_error());
	$result_status=mysqli_query($conn, $sql) or die(mysqli_error());

	//If pengundian ditutup, disallow login
	$stat = mysqli_fetch_assoc($result_status);
	if($stat['status_pengundian'] == 0)
	{
		$_SESSION['errors'] = array("&nbsp;&nbsp;Pengundian telah ditutup.");
		header("location:index.php");	
		exit();
	}

	//Query data for login
	$sql="SELECT id, no_matrik, kata_laluan, status_undi FROM uthm_smp.jpelajar WHERE no_matrik='$myusername'" or die(mysql_error());
	$result=mysqli_query($conn, $sql) or die(mysqli_error());
	$user = mysqli_fetch_assoc($result);
	
	if(password_verify($mypassword, $user['kata_laluan'])){		

		if($user['status_undi'] == 1){
			
			$_SESSION['errors'] = array("&nbsp;&nbsp;Akaun mempunyai status sudah mengundi.");
			header("location:index.php");	
			exit();
		}
		else{
			$_SESSION['id_pengguna'] = $user['id'];
			header("location:home.php");	
			exit();
		}
	}
	//If the username or password is wrong, you will receive this message below.
	else {
		$_SESSION['errors'] = array("&nbsp;&nbsp;No. Kad Pelajar atau Kata Laluan tidak tepat.");
		header("location:index.php");	
		exit();
	}
?>