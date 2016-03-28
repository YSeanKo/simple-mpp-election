<?php
	include("db/dbc.php");
	session_start();
	if(isset($_POST['creset'])) {
		
		//Query calon
		$queryExist=mysqli_query($conn, "SELECT id FROM jcalon jc");
		
		if (mysqli_num_rows($queryExist) > 1) //record exists in jcalon
		{
			//Query delete all calon
			$sql = "DELETE FROM jcalon";
			mysqli_query($conn, $sql) or die(mysqli_error());
			$_SESSION['creset_errors'] = array("&nbsp;&nbsp;Berjaya. Senarai calon telah direset.");
		}
		
		else{
			$_SESSION['creset_errors'] = array("&nbsp;&nbsp;Ralat. Tiada pelajar dalam senarai calon.");
		}
		
		header("location:urus-calon.php");
		exit();
	}
?>