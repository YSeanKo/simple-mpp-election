<?php
	include("db/dbc.php");
	session_start();
	if(isset($_POST['tambah'])) {
		$key=$_POST['addkey'];
		
		$queryExist=mysqli_query($conn, "SELECT id FROM jcalon jc WHERE jc.id_pelajar='$key'");
		
		if (mysqli_num_rows($queryExist) == 1) //record exists in jcalon
		{
			$_SESSION['add_errors'] = array("&nbsp;&nbsp;Ralat. Pelajar sudah ada dalam senarai calon.");
		}
		
		else{
			$query=mysqli_query($conn, "SELECT jp.id FROM uthm_smp.jpelajar jp WHERE jp.id='$key'");	
		
			if(mysqli_num_rows($query) == 1) { //Record exists in jpelajar
				while($row=mysqli_fetch_array($query))
				  $cid = $row['id'];
				
				//Query insert pelajar into table calon
				$sql = "INSERT INTO jcalon (id_pelajar, jumlah_undi)
				VALUES ($cid, 0)";
				mysqli_query($conn, $sql) or die(mysqli_error());
				$_SESSION['add_errors'] = array("&nbsp;&nbsp;Pencalonan berjaya.");
				
			}
			
			else{
				$_SESSION['add_errors'] = array("&nbsp;&nbsp;Ralat. Pencalonan tidak berjaya.");
			}
		}
		
		header("location:urus-calon.php");
		exit();
	}
?>