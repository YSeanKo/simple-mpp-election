<?php
	include("admin/db/dbc.php");
	session_start();

	// Defining your login details into variables
	$myusername=$_POST['myusername'];
	$mypassword=$_POST['mypassword'];
	
	// MySQL injection protections - \n, \r, \, ', " etc
	$myusername = mysqli_real_escape_string($conn, $myusername);
	$mypassword = mysqli_real_escape_string($conn, $mypassword);
	//$encrypted_mypassword=md5($mypassword); //MD5 Hash for security
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
	$sql="SELECT * FROM $tbl_name WHERE no_matrik='$myusername' and kata_laluan='$mypassword'" or die(mysql_error());
	$result=mysqli_query($conn, $sql) or die(mysqli_error());

	// Checking result rows
	$count=mysqli_num_rows($result);
	// If username and password is a match, the count will be 1

	if($count==1){		
		$user = mysqli_fetch_assoc($result);

		if($user['status_undi'] == 1)
		{
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