<?php
	include("db/dbc.php");
	session_start();
	if(isset($_POST['buang'])) {
		$key=$_POST['delkey'];
		
		//Query calon
		$queryExist=mysqli_query($conn, "SELECT id FROM jcalon jc WHERE jc.id='$key'");
		
		if (mysqli_num_rows($queryExist) == 1) //record exists in jcalon
		{
			//Query delete calon
			$sql = "DELETE FROM jcalon WHERE id='$key'";
			mysqli_query($conn, $sql) or die(mysqli_error());
			$_SESSION['del_errors'] = array("&nbsp;&nbsp;Berjaya. Pelajar sudah dikeluarkan dari senarai calon.");
		}
		
		else{
			$_SESSION['del_errors'] = array("&nbsp;&nbsp;Ralat. Pelajar tiada dalam senarai calon.");
		}
		
		header("location:urus-calon.php");
		exit();
	}
?>